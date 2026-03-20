<?php

namespace App\Services;

use App\Repositories\PortfolioRepository;
use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Collection;

class PortfolioService
{
    public function __construct(private readonly PortfolioRepository $repository) {}

    /**
     * Find portfolios modified since timestamp (delta sync).
     *
     * @param string $since ISO 8601 datetime
     * @param int $limit
     * @return array
     */
    public function findSince(string $since, int $limit = 50): array
    {
        $portfolios = $this->repository->findSince($since, $limit + 1);
        $hasMore = count($portfolios) > $limit;

        return [
            'items' => $portfolios->take($limit),
            'has_more' => $hasMore,
        ];
    }

    /**
     * Create portfolio for user.
     *
     * @param int $userId
     * @param array $data
     * @return Portfolio
     */
    public function create(int $userId, array $data): Portfolio
    {
        return $this->repository->store($userId, $data);
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
        return $this->repository->update($portfolio, $data);
    }

    /**
     * Delete portfolio.
     *
     * @param Portfolio $portfolio
     * @return bool
     */
    public function delete(Portfolio $portfolio): bool
    {
        return $this->repository->delete($portfolio);
    }

    /**
     * Restore portfolio.
     *
     * @param Portfolio $portfolio
     * @return bool
     */
    public function restore(Portfolio $portfolio): bool
    {
        return $this->repository->restore($portfolio);
    }
}
