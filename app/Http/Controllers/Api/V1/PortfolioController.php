<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\StorePortfolioRequest;
use App\Http\Requests\UpdatePortfolioRequest;
use App\Http\Resources\PortfolioResource;
use App\Models\Portfolio;
use App\Services\PortfolioService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PortfolioController extends ApiController
{
    public function __construct(private readonly PortfolioService $service) {}

    public function index(Request $request): JsonResponse
    {
        $result = $this->service->findSince(
            $request->get('since', '1970-01-01'),
            (int) $request->get('limit', 50)
        );

        return response()->json([
            'data' => PortfolioResource::collection($result['items']),
            'since' => $request->get('since'),
            'has_more' => $result['has_more'],
        ]);
    }

    public function store(StorePortfolioRequest $request): JsonResponse
    {
        $portfolio = $this->service->create((int) $request->user()->id, $request->validated());

        return response()->json(['data' => new PortfolioResource($portfolio)], 201);
    }

    public function update(UpdatePortfolioRequest $request, Portfolio $portfolio): JsonResponse
    {
        $portfolio = $this->service->update($portfolio, $request->validated());

        return response()->json(['data' => new PortfolioResource($portfolio)]);
    }

    public function destroy(Portfolio $portfolio): JsonResponse
    {
        $this->service->delete($portfolio);

        return response()->json(status: 204);
    }

    public function restore(int $id): JsonResponse
    {
        $portfolio = Portfolio::withTrashed()->find($id);

        if (!$portfolio) {
            return response()->json(['error' => 'Not found'], 404);
        }

        if (!$portfolio->trashed()) {
            return response()->json(['error' => 'Portfolio not deleted'], 422);
        }

        $this->service->restore($portfolio);

        return response()->json(['data' => new PortfolioResource($portfolio)]);
    }
}
