<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gender',
        'age',
        'point',
        'notes',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'gender' => 'integer',
        'age' => 'integer',
        'point' => 'integer',
    ];

    /**
     * Get the user that last updated the customer.
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get all cards belonging to this customer.
     */
    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }

    /**
     * Get all point history for this customer.
     */
    public function pointHistory(): HasMany
    {
        return $this->hasMany(PointHistory::class)->orderBy('created_at', 'desc');
    }

    /**
     * Get all consents that this customer has agreed to. (Many-to-Many relationship)
     */
    public function consents(): BelongsToMany
    {
        return $this->belongsToMany(Consent::class, 'customer_consent')
            ->withPivot('agreed_at', 'updated_by', 'created_at', 'updated_at', 'deleted_at')
            ->withTimestamps();
    }

    /**
     * Get the last visit date for this customer.
     */
    public function getLastVisitDateAttribute()
    {
        $lastCard = $this->cards
            ->whereIn('salon_id', Auth::user()->salon_ids)
            ->sortByDesc('visit_date')
            ->first();

        return $lastCard ? $lastCard->visit_date : null;
    }

    /**
     * Get the last salon visited by this customer.
     */
    public function getLastSalonNameAttribute()
    {
        $lastCard = $this->cards
            ->whereIn('salon_id', Auth::user()->salon_ids)
            ->sortByDesc('visit_date')
            ->first();

        return $lastCard ? $lastCard?->salon?->name : null;
    }

    /**
     * Scope a query to filter customers based on request parameters.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function filterById($query, $request)
    {
        if ($request->filled('customer_id')) {
            $query->where('id', $request->customer_id);
        }
    }

    protected function filterByGender($query, $request)
    {
        if ($request->filled('gender')) {
            $query->whereIn('gender', $request->gender);
        }
    }

    protected function filterByAge($query, $request)
    {
        if ($request->has('age')) {
            $ages = collect($request->age);
            $query->where(function ($q) use ($ages) {
                $ages->each(function ($age) use ($q) {
                    if ($age == 80) {
                        $q->orWhere('age', '>=', 80);
                    } else {
                        $q->orWhereBetween('age', [$age, $age + 9]);
                    }
                });
            });
        }
    }

    protected function filterByCardCount($query, $request)
    {
        if ($request->filled('min') || $request->filled('max')) {
            $query->withCount(['cards as active_cards_count' => function ($q) {
                $q->active();
            }]);
            if ($request->filled('min')) {
                $query->having('active_cards_count', '>=', $request->min);
            }
            if ($request->filled('max')) {
                $query->having('active_cards_count', '<=', $request->max);
            }
        }
    }

    protected function filterByCategory($query, $categories)
    {
        $query->where(function ($q) use ($categories) {
            if (in_array('is_cut', $categories)) {
                $q->orWhere('is_cut', true);
            }
            if (in_array('is_color', $categories)) {
                $q->orWhere('is_color', true);
            }
            if (in_array('is_perm', $categories)) {
                $q->orWhere('is_perm', true);
            }
        });
    }

    protected function filterByVisitDate($query, $request)
    {
        if ($request->filled('visit_start')) {
            $visitStart = Carbon::createFromFormat('d/m/Y', $request->visit_start)->endOfDay()->format('Y-m-d H:i:s');
            $query->where('visit_date', '>=', $visitStart);
        }
        if ($request->filled('visit_end')) {
            $visitEnd = Carbon::createFromFormat('d/m/Y', $request->visit_end)->endOfDay()->format('Y-m-d H:i:s');
            $query->where('visit_date', '<=', $visitEnd);
        }
    }

    public function scopeFilter($query, $request)
    {
        $this->filterById($query, $request);
        $this->filterByGender($query, $request);
        $this->filterByAge($query, $request);
        $this->filterByCardCount($query, $request);

        if (
            $request->has('category')
            || $request->filled('visit_start')
            || $request->filled('visit_end')
            || $request->filled('salon_ids')
        ) {
            $query->whereHas('cards', function ($q) use ($request) {
                $q->active();

                // Filter by salon IDs if provided
                if ($request->filled('salon_ids')) {
                    $q->whereIn('salon_id', explode(',', $request->salon_ids));
                }

                if ($request->has('category')) {
                    $this->filterByCategory($q, $request->category);
                }

                $this->filterByVisitDate($q, $request);
            });
        }

        return $query;
    }
}
