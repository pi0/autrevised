<?php

namespace App\Http\Controllers;

use App\country;
use Illuminate\Http\Request;

class countryController extends Controller
{
    public function add(Request $r){
        $name = $r->country;
        country::firstOrCreate(['name'=>$name]);
        return redirect('/addCountry');
    }

    public function delete($id){
        country::destroy($id);
        return redirect('/addCountry');
    }

    public function update($id, Request $r){
        $country = country::find($id);
        $country->name = $r->country;
        $country->save();
        return  redirect('/addCountry');

    }
}
