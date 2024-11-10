<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Weather;
use Carbon\Factory;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    //
    public function index()
    {
        $charts = Weather::getH43Chart('precipitationmm');
        
        return view('charts.index');
    }
}
