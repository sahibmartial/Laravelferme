<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Vaccin;
class AlertVaccin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alertvaccin:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envoi notifications de vaccins  daily aux users quand il le faut via email';

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
     * @return int
     */
    public function handle()
    {    
        $vaccin= new Vaccin();
        $vaccin->alertMailingSuivi();
        $this->info('Successfully sent daily alertvaccin to user.');
       // return 0;
    }
}
