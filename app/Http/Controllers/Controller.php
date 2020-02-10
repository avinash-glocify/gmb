<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function storeFile($file)
    {
        $imagename = strtotime('now').$file->getClientOriginalname();
        $folder    = Carbon::now()->format('d-m-Y');
        $path      = storage_path('app/public/formulaFiles/').$folder;

         if(!file_exists($path)) {
           mkdir($path);
         }

         $file->move($path, $imagename);
         $filePath = '/storage/formulaFiles/'.$folder.'/'.$imagename;
         return $filePath;
    }
}
