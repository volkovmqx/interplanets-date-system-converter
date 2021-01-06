<?php

namespace App\Console\Commands\Planets;

use Illuminate\Console\Command;

use App\Models\Planet;
use App\Models\Calendar\EquallyDistributedCalendar;
use App\Models\Calendar\GregorianCalendar;

use Illuminate\Support\Facades\Validator;


class AddCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'planets:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new planet';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->ask('What\'s the name of the planet?');
        $calendars = ['Gregorian (like Earth)', 'Equally distributed (same amount of days in all months)'];
        $calendar = $this->choice('What calendar this planet uses?', $calendars, 0);
        $is_gregorian = $calendar === 'Gregorian (like Earth)';
        
        
        if(!$is_gregorian) {
            $days_per_month = $this->ask('How many days per month?');
            $months_per_year = $this->ask('How many months per year?');
        }
        

        $validator = Validator::make([
            'name' => $name,
            'days_per_month' => $is_gregorian? null : $days_per_month,
            'months_per_year' => $is_gregorian? null : $months_per_year,
        ], [
            'name' => ['required'],
            'days_per_month' => ['nullable', 'numeric', 'min:2'],
            'months_per_year' => ['nullable', 'numeric', 'min:2'],
        ]);

        if ($validator->fails()) {
            $this->comment('Hmm, there seems to be a problem:');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

        $planet = new Planet(['name' => $name]);
        if($is_gregorian) {
            $calendar = GregorianCalendar::create();
        }
        else {
            $calendar = EquallyDistributedCalendar::create(
                [
                    'days_per_month' => $days_per_month,
                    'months_per_year' => $months_per_year
                ]
            );
        }
        $planet->calendar()->associate($calendar);
        $planet->save();
        $this->info('Perfect, a new planet has been Added');
    }
}