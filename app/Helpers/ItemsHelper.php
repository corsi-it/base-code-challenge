<?php

namespace App\Helpers;

use App\Enums\StockRequestStatusEnum;
use App\Models\Item;
use App\Models\StockRequest;

class ItemsHelper
{

    public function canBeRequestedOnDate(
        Item      $item,
        int       $quantity,
        \DateTime $dateTime,
    )
    {
        $totalPositiveStockQty = StockRequest::where('status', StockRequestStatusEnum::APPROVED)
            ->where('item_id', $item->id)
            ->where('quantity', '>', 0)
            ->sum('quantity');

        $totalNegativeStockQty = intval($totalPositiveStockQty);

        $totalNegativeStockQty = StockRequest::whereNot('status', StockRequestStatusEnum::REJECTED)
            ->where('item_id', $item->id)
            ->where('quantity', '<', 0)
            ->where('start_date', '<=', $dateTime)
            ->where('end_date', '>=', $dateTime)
            ->sum('quantity');

        $totalNegativeStockQty = intval($totalNegativeStockQty);

        $totalQty = $totalPositiveStockQty + $totalNegativeStockQty;

        return $totalQty >= $quantity;
    }

    public function isInStock(Item $item, \DateTime $dateTime)
    {
        return $this->canBeRequestedOnDate($item, 1, $dateTime);
    }
}
