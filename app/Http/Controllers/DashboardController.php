<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $folder  = Carbon::now()->subDays(1)->format('d-m-Y');
        $path    = storage_path('app/public/exportFiles/').$folder;

        if(file_exists($path)) {
          array_map('unlink', glob("$path/*.*"));
          rmdir($path);
        }
      return view('dashboard');
    }
}
