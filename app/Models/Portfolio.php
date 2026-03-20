<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'status',
        'images',
        'synced_at',
        'last_sync_at',
    ];

    protected $casts = [
        'images' => 'json',
        'synced_at' => 'datetime',
        'last_sync_at' => 'datetime',
    ];

    /**
     * Get the user that owns this portfolio.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get portfolio items.
     *
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(PortfolioItem::class)->orderBy('position');
    }
}
