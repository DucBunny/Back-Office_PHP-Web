<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'salon_id',
        'customer_id',
        'visit_date',
        'is_cut',
        'is_color',
        'color_note',
        'is_perm',
        'perm_note',
        'memo',
        'point',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'salon_id' => 'integer',
        'customer_id' => 'integer',
        'visit_date' => 'datetime',
        'is_cut' => 'boolean',
        'is_color' => 'boolean',
        'is_perm' => 'boolean',
        'point' => 'integer',
    ];

    /**
     * Get the user that last updated the card.
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the customer that owns this card.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class); // default foreign key is 'customer_id'
    }

    /**
     * Get the salon that owns this card.
     */
    public function salon(): BelongsTo
    {
        return $this->belongsTo(Salon::class);
    }

    /**
     * Scope a query to only include active cards.
     * use: Card::active()->get();
     */
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
}
