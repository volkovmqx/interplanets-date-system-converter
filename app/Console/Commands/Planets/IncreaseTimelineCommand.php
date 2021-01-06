<?php

namespace App\Console\Commands\Planets;

use Illuminate\Console\Command;
use App\Models\Planet;
use Illuminate\Support\Facades\Validator;


class IncreaseTimelineCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'planets:timeline:increase {id} {amount} {--unit=days}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add to a specific planet\'s Timeline';

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
        $amount = $this->argument('amount');
        $unit = $this->option('unit');

        $amount_rule = ['numeric', 'min:1'];
        if($unit === 'date') {
            $amount_rule = ['regex:/^\d{4}-\d{2}-\d{2}$/i'];
        }

        $validator = Validator::make([
            'id' => $id,
            'amount' => $amount,
            'unit' => $unit,
        ], [
            'id' => ['exists:planets,id'],
            'amount' => $amount_rule,
            'unit' => ['required', 'in:days,months,years,date']
        ]);
        if ($validator->fails()) {
            $this->comment('Hmm, there seems to be a problem:');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

        $planet = Planet::find($id);
        $calendar = $planet->calendar;
        switch ($unit) {
            case 'days':
                $calendar->addDays($amount);
                break;
            case 'months':
                $calendar->addMonths($amount);
                break;
            case 'years':
                $calendar->addYears($amount);
                break;
            case 'date':
                $calendar->addDate($amount);
                break;
        }
        $calendar->save();
        $this->info("Planet $id timeline increased by $amount $unit");
    }
}