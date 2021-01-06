<?php

namespace App\Console\Commands\Planets;

use Illuminate\Console\Command;
use App\Models\Planet;
use Illuminate\Support\Facades\Validator;

class GetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'planets:get {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get one planet';

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
        $id = $this->argument('id');
        $validator = Validator::make([
            'id' => $id,
        ], [
            'id' => ['exists:planets,id']
        ]);
        if ($validator->fails()) {
            $this->comment('Hmm, there seems to be a problem:');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }
        $planet = Planet::with('calendar')->find($id);
        $header = ['#', 'name',  'Added Days', 'added Months', 'added Years', 'Date', 'Calendar Type'];
        $value = [
            $planet->id,
            $planet->name,
            $planet->calendar->days,
            $planet->calendar->months,
            $planet->calendar->years,
            $planet->calendar->date,
            substr(get_class($planet->calendar) , strrpos(get_class($planet->calendar), '\\') + 1)
        ];

        $this->table( $header, [$value] );
    }
}