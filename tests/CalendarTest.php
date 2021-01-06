<?php

use App\Models\Planet;
use App\Models\Calendar\EquallyDistributedCalendar;
use App\Models\Calendar\GregorianCalendar;


class CalendarTest extends TestCase
{
    /**
     * @return void
     */
    public function testGregorian()
    {
        $calendar = new GregorianCalendar();
        $calendar->addDate('2018-07-12');
        $calendar->addMonths(2);
        $this->assertEquals($calendar->date,  '2019-10-13');

        $calendar = new GregorianCalendar();
        $calendar->addDate('2018-07-12');
        $calendar->addDate('0002-02-01');
        $this->assertEquals($calendar->date,  '2021-10-14');
    }
    /**
     * @return void
     */
    public function testEquallyDistributed()
    {
        $calendar = new EquallyDistributedCalendar([
            'days_per_month' => 42,
            'months_per_year' => 8
        ]);

        $calendar->addDays(45);
        $calendar->addYears(2020);
        $calendar->addMonths(8);
        $this->assertEquals($calendar->date,  '2022-02-04');

        $calendar = new EquallyDistributedCalendar([
            'days_per_month' => 10,
            'months_per_year' => 3
        ]);

        $calendar->addDate('2020-6-15');
        $this->assertEquals($calendar->date,  '2023-02-06');
    }
}

