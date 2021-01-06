<?php

namespace App\Models\Calendar;

use Illuminate\Database\Eloquent\Model;
use App\Models\Planet;

abstract class Base extends Model
{
    public $timestamps = false;
    protected $guarded = ['id', 'calendar_type', 'calendar_id'];
    protected $append = ['date'];

    public abstract function addDays(int $days);
    public abstract function addMonths(int $months);

    public function addYears(int $years) {
        $this->years += $years;
    }
    public function addDate(string $date) {
        $date_to_add = explode('-', $date);

        $years =  $date_to_add[0];
        $months = $date_to_add[1];
        $days = $date_to_add[2];

        $this->addDays($days);
        $this->addMonths($months);
        $this->addYears($years);
    }
    protected function getDate() {
        return sprintf("%04d-%02d-%02d", $this->years+1, $this->months+1, $this->days+1);
    }

    public function getDateAttribute() {
        return $this->getDate();
    }
    public function planet()
    {
        return $this->morphOne(Planet::class, 'calendar');
    }
}   
