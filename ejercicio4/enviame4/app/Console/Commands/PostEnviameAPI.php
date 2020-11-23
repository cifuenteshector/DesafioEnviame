<?php

namespace App\Console\Commands;

use App\Http\Controllers\ApiController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Exception;

class PostEnviameAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enviameapi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consumo de API enviame';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function fire(){
        
        
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{
            
            $enviame = new ApiController();
            $enviame->PostEnviame();
        }catch (Exception $e) {
            Log::info('error en archivo: ' . $e->getFile());
            Log::info('error en linea : ' . $e->getLine());
            Log::info('error: ' . $e->getMessage());
        }
    }
}
