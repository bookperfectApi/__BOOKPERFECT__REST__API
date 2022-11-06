<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;
use App\Models\log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class autoBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'autoBackup';

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
        $result = Artisan::call('backup:run --only-db');
        
        return 0;
    }
}
