<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class removeEmportFiles extends Command
{
    protected $signature = 'remove:files';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
      $folder  = Carbon::now()->subDays(1)->format('d-m-Y');
      $path    = storage_path('app/public/exportFiles/').$folder;
      \Log::info('I am here');  
      if(file_exists($path)) {
        array_map('unlink', glob("$path/*.*"));
        rmdir($path);
      }
    }
}
