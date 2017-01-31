<?php

namespace App\Http\Controllers;

use App\country;
use App\organization;
use Illuminate\Http\Request;

class organizationController extends Controller
{
    public function add(Request $r){
        $name = $r->name;
        $country = country::find($r->country);
        $org = organization::firstOrCreate(['name'=>$name], ['country_id'=>$r->country]);
        $org->country()->associate($country);
        return redirect('/addOrganization');
    }

    public function delete($id){
        field::destroy($id);
        return redirect('/addField');
    }

    public function update($id, Request $r){
        $field = field::find($id);
        $field->title = $r->field;
        $field->save();
        return  redirect('/addField');

    }
}
