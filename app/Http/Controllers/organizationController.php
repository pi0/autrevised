<?php

namespace App\Http\Controllers;

use App\country;
use App\field;
use App\organization;
use Illuminate\Http\Request;

class organizationController extends Controller
{
    public function add(Request $r){
        $name = $r->name;
        $country = country::find($r->country);
        $org = organization::firstOrCreate(['name'=>$name, 'country_id'=>$r->country]);
        $org->country()->associate($country);
        return redirect('/addOrganization');
    }

    public function delete($id){
        $funds = organization::find($id)->funds;
        foreach ($funds as $fund)
            $fund->delete();
        organization::destroy($id);
        return redirect('/addOrganization');
    }

    public function update($id, Request $r){
        $org = organization::find($id);
        $name = $r->name;
        $country = country::find($r->country);
        $org->name = $name;
        $org->country_id = $country->id;
        $org->country()->associate($country);
        $org->save();
        return redirect('/addOrganization');

    }
}
