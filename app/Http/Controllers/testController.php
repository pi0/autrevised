<?php

namespace App\Http\Controllers;

use App\field;
use App\fund;
use Illuminate\Http\Request;

class testController extends Controller
{
    public function show(){
        return fund::all()[1]->relatedFunds;
//        return field::all()[1]->funds;
    }
}
