<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'login_id',
        'name',
        'password',
        'role',
        'device_code',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'role' => 'integer',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user that last updated the model.
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get all updated by this user.
     */
    public function updatedCustomers(): HasMany
    {
        return $this->hasMany(Customer::class, 'updated_by');
    }

    public function updatedSalons(): HasMany
    {
        return $this->hasMany(Salon::class, 'updated_by');
    }

    public function updatedCards(): HasMany
    {
        return $this->hasMany(Card::class, 'updated_by');
    }

    public function updatedConsents(): HasMany
    {
        return $this->hasMany(Consent::class, 'updated_by');
    }

    public function updatedPointHistories(): HasMany
    {
        return $this->hasMany(PointHistory::class, 'updated_by');
    }

    /**
     * Get all salons that this user is associated with. (Many-to-Many relationship)
     */
    public function salons(): BelongsToMany
    {
        return $this->belongsToMany(Salon::class, 'user_salon', 'user_id', 'salon_id')
            ->withPivot('updated_by', 'created_at', 'updated_at', 'deleted_at')
            ->withTimestamps();
    }

    /**
     * Get all salon IDs associated with the user.
     */
    public function getSalonIdsAttribute()
    {
        // If the user is an admin, return all salon IDs
        if ($this->role == 1) {
            return Salon::pluck('id')->toArray();
        }

        return $this->salons()->wherePivot('deleted_at', null)->pluck('id')->toArray();
    }

    /**
     * Scope a query to filter users based on salon IDs.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function scopeFilter($query, $request)
    {
        if ($request->filled('salon_ids')) {
            $query->whereHas('salons', function ($q) use ($request) {
                $q->whereIn('salon_id', explode(',', $request->salon_ids));
            });
        }
    }
}
