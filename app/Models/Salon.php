<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salon extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'salon_code',
        'type',
        'name',
        'furigana',
        'color_plus_point',
        'perm_plus_point',
        'address',
        'status',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'integer',
        'color_plus_point' => 'integer',
        'perm_plus_point' => 'integer',
        'status' => 'boolean',
    ];

    /**
     * Get the user that last updated the salon.
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get all users associated with the salon. (Many-to-Many relationship)
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_salon', 'salon_id', 'user_id')
            ->withPivot('created_at', 'updated_at', 'deleted_at')
            ->withTimestamps();
    }

    /**
     * Scope a query to filter salons based on request parameters.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function filterBySalonCode($query, $request)
    {
        if ($request->filled('salon_code')) {
            $query->where('salon_code', 'like', '%' . $request->salon_code . '%');
        }
    }

    protected function filterByType($query, $request)
    {
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
    }

    protected function filterByName($query, $request)
    {
        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%')
                    ->orWhere('furigana', 'like', '%' . $request->name . '%');
            });
        }
    }

    protected function filterByAddress($query, $request)
    {
        if ($request->filled('address')) {
            $query->where('address', 'like', '%' . $request->address . '%');
        }
    }

    public function scopeFilter($query, $request)
    {
        $this->filterBySalonCode($query, $request);
        $this->filterByType($query, $request);
        $this->filterByName($query, $request);
        $this->filterByAddress($query, $request);

        return $query;
    }
}
