<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\TableModel;

class AlexaTop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:alexa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull top 500 domains from Alexa and store in DB.';

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
/*
        $tableModel = new TableModel;
        $tableModel->rank = 100;
        $tableModel->name = "artisanCommand";
        $tableModel->save();
*/

        $this->comment(PHP_EOL."This is artisan alexa command".PHP_EOL);
    }
}
