<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Consent extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'status',
        'date',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
        'date' => 'date',
    ];

    /**
     * Get the user that last updated the consent.
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get all customers that have agreed to this consent. (Many-to-Many relationship)
     */
    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class, 'customer_consent')
            ->withPivot('agreed_at', 'updated_by', 'created_at', 'updated_at', 'deleted_at')
            ->withTimestamps();
    }

    /**
     * Scope a query to filter consents based on request parameters.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function filterByDate($query, $request)
    {
        if ($request->filled('date_start')) {
            $dateStart = Carbon::createFromFormat('d/m/Y H:i', $request->date_start)->format('Y-m-d H:i:s');
            $query->where('customer_consent.agreed_at', '>=', $dateStart);
        }
        if ($request->filled('date_end')) {
            $dateEnd = Carbon::createFromFormat('d/m/Y H:i', $request->date_end)->format('Y-m-d H:i:s');
            $query->where('customer_consent.agreed_at', '<=', $dateEnd);
        }
    }

    protected function filterByTitle($query, $request)
    {
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
    }

    protected function filterByCustomerId($query, $request)
    {
        if ($request->filled('customer_id')) {
            $query->where('customer_consent.customer_id', 'like', '%' . $request->customer_id . '%')
                ->where('customer_consent.deleted_at', null);
        }
    }

    public function scopeFilter($query, $request)
    {
        $this->filterByTitle($query, $request);

        return $query;
    }

    public function scopeHistoryFilter($query, $request)
    {
        $this->filterByDate($query, $request);
        $this->filterByTitle($query, $request);
        $this->filterByCustomerId($query, $request);

        return $query;
    }
}
