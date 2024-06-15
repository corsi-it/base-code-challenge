<?php

namespace App\Helpers;

class StockRequestsHelper
{

    public function getDates(\DateTime $startDate, \DateTime $endDate)
    {
        if (empty($startDate) || empty($endDate)) {
            return [];
        }

        $dates = [];
        $currentDate = clone $startDate;
        while ($currentDate <= $endDate) {
            $dates[] = $currentDate;
            $currentDate = $currentDate->modify('+1 day');
        }
        return $dates;
    }
}
