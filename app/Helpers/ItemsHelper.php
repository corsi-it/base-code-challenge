<?php

namespace App\Helpers;

use App\Enums\StockRequestStatusEnum;
use App\Models\Item;
use App\Models\StockRequest;

class ItemsHelper
{

    public function isInStock(Item $item, \DateTime $dateTime)
    {
        // fetch count
        $totalPositiveStock = StockRequest::where('status', StockRequestStatusEnum::APPROVED)
            ->where('item_id', $item->id)
            ->where('quantity', '>', 0)
            ->sum();

        $totalNegativeStock = StockRequest::where('status', StockRequestStatusEnum::APPROVED)
            ->where('item_id', $item->id)
            ->where('quantity', '<', 0)
            ->where('start_date', '<=', $dateTime)
            ->where('end_date', '>=', $dateTime)
            ->sum();

        return $totalPositiveStock - $totalNegativeStock > 0;
    }
}
