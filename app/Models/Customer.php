<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'category',
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
        $lastCard = $this->cards->sortByDesc('visit_date')->first();
        return $lastCard ? $lastCard->visit_date : null;
    }

    /**
     * Get the last salon visited by this customer.
     */
    public function getLastSalonAttribute()
    {
        $lastCard = $this->cards->sortByDesc('visit_date')->first();
        return $lastCard ? $lastCard?->salon?->name : null;
    }
}
