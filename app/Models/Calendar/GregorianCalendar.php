<?php

namespace App\Models\Calendar;

use App\Models\Calendar\Base as BaseCalendar;

class GregorianCalendar extends BaseCalendar
{
    public function addMonths(int $months) {
        $date = new \DateTime($this->getDate());
        $date->modify(sprintf("+%d month", $months));
        $this->days = (int) $date->format('d') - 1;
        $this->months = (int) $date->format('m') - 1;
        $this->years = (int) $date->format('Y') - 1;
    }
    public function addDays(int $days) {
        $date = new \DateTime($this->getDate());
        $date->modify(sprintf("+%d day", $days));
        $this->days = (int) $date->format('d') - 1;
        $this->months = (int) $date->format('m') - 1;
        $this->years = (int) $date->format('Y') - 1;
    }
}   
