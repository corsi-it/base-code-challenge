<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class StockRequestsHelperTest extends TestCase
{
    public function test_get_dates_returns_array_of_dates_between_start_and_end_dates(): void
    {
        $helper = new \App\Helpers\StockRequestsHelper();
        $startDate = \DateTime::createFromFormat('Y-m-d', '2023-01-01');
        $endDate = \DateTime::createFromFormat('Y-m-d', '2023-01-05');

        $dates = $helper->getDates($startDate, $endDate);

        $this->assertCount(5, $dates);
    }

    public function test_get_dates_returns_empty_array_if_start_or_end_date_is_empty(): void
    {
        $helper = new \App\Helpers\StockRequestsHelper();
        $dates = $helper->getDates(null, null);

        $this->assertEmpty($dates);
    }
}
