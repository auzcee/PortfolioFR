<?php

namespace App\Repositories;

use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;

class PortfolioRepository
{
    /**
     * Find portfolios modified since timestamp (for delta sync).
     *
     * @param string $since ISO 8601 datetime string
     * @param int $limit Number of records to fetch
     * @return Collection
     */
    public function findSince(string $since, int $limit): Collection
    {
        return Portfolio::withTrashed()
            ->where('updated_at', '>', $since)
            ->orWhere('synced_at', '>', $since)
            ->orWhereTrashed()
            ->latest('updated_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Get portfolio by ID with soft delete support.
     *
     * @param int $id
     * @return Portfolio|null
     */
    public function findById(int $id): ?Portfolio
    {
        return Portfolio::withTrashed()->find($id);
    }

    /**
     * Store portfolio for user.
     *
     * @param int $userId
     * @param array $data
     * @return Portfolio
     */
    public function store(int $userId, array $data): Portfolio
    {
        return Portfolio::create([
            'user_id' => $userId,
            'title' => $data['title'],
            'slug' => $data['slug'],
            'description' => $data['description'] ?? null,
            'status' => $data['status'] ?? 'draft',
            'images' => $data['images'] ?? null,
            'last_sync_at' => now(),
        ]);
    }

    /**
     * Update portfolio.
     *
     * @param Portfolio $portfolio
     * @param array $data
     * @return Portfolio
     */
    public function update(Portfolio $portfolio, array $data): Portfolio
    {
        $portfolio->update([
            'title' => $data['title'] ?? $portfolio->title,
            'slug' => $data['slug'] ?? $portfolio->slug,
            'description' => $data['description'] ?? $portfolio->description,
            'status' => $data['status'] ?? $portfolio->status,
            'images' => $data['images'] ?? $portfolio->images,
            'last_sync_at' => now(),
        ]);

        return $portfolio;
    }

    /**
     * Soft delete portfolio.
     *
     * @param Portfolio $portfolio
     * @return bool
     */
    public function delete(Portfolio $portfolio): bool
    {
        return (bool) $portfolio->delete();
    }

    /**
     * Restore soft-deleted portfolio.
     *
     * @param Portfolio $portfolio
     * @return bool
     */
    public function restore(Portfolio $portfolio): bool
    {
        return (bool) $portfolio->restore();
    }

    /**
     * Get all portfolios for user.
     *
     * @param int $userId
     * @return Collection
     */
    public function getUserPortfolios(int $userId): Collection
    {
        return Portfolio::where('user_id', $userId)->get();
    }
}
