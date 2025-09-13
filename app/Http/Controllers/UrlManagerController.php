<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Yajra\DataTables\Facades\DataTables;
use App\Models\GenrateUrl;
use Carbon\Carbon;
use Validator;

class UrlManagerController extends Controller
{

    public function redirectToMainUrl($code){
        $url = GenrateUrl::where('short_url',$code)->first();
        if(!$url){
            abort(404);
        }
        $url->increment('hits');
        return redirect($url->long_url);
    }
}