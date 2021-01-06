<?php

namespace App\Models\Calendar;

use App\Models\Calendar\Base as BaseCalendar;

class EquallyDistributedCalendar extends BaseCalendar
{
    public function addMonths(int $months) {
        $new_months = ($this->months+$months) % $this->months_per_year;
        $years_to_add = ($this->months+$months-$new_months) / $this->months_per_year;
        $this->months = $new_months;
        $this->addYears($years_to_add);
    }
    public function addDays(int $days) {
        $new_days = ($this->days+$days) % ($this->days_per_month);
        $months_to_add = ($this->days+$days-$new_days) / ($this->days_per_month);
        $this->days = $new_days;
        $this->addMonths($months_to_add);
    }

}   
