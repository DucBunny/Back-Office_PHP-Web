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
        'address',
        'color_plus_point',
        'perm_plus_point',
        'status',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
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
}
