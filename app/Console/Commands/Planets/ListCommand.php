<?php

namespace App\Console\Commands\Planets;

use Illuminate\Console\Command;
use App\Models\Planet;

class ListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'planets:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List All the planets';

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
        $planets = Planet::with('calendar')->get();
        $header = ['#', 'name',  'Added Days', 'added Months', 'added Years', 'Date', 'Calendar Type'];
        $values = [];
        foreach ($planets as $planet) {
            $values[] = [
                $planet->id,
                $planet->name,
                $planet->calendar->days,
                $planet->calendar->months,
                $planet->calendar->years,
                $planet->calendar->date,
                substr(get_class($planet->calendar) , strrpos(get_class($planet->calendar), '\\') + 1)
            ];
        }

        $this->table( $header, $values );
        
    }
}