<?php

namespace App\Console\Commands\Planets;

use Illuminate\Console\Command;
use App\Models\Planet;
use Illuminate\Support\Facades\Validator;

class DeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'planets:delete {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a planet';

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
        $validator = Validator::make(['id' => $id], ['id' => ['exists:planets,id']]);
        if ($validator->fails()) {
            $this->comment('Hmm, there seems to be a problem:');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }
        if($this->confirm("Are you sure you want to delte Planet#$id")) {
            Planet::find($id)->delete();
            $this->info("Planet has been deleted");
        }
    }
}