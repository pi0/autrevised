<?php

namespace App\Http\Controllers;

use App\field;
use App\fund;
use App\organization;
use App\tag;
use Illuminate\Http\Request;

class fundController extends Controller
{
    public function add(Request $r){
        $fund = new fund();
        $fund->name = $r->name;
        $fund->rating = $r->rating;
        $fund->organization_id = $r->organization;
        $fund->farsi = $r->farsi;
        $fund->description = $r->description;
        $fund->save();
        foreach ($r->fields as $field)
            $fund->fields()->attach(field::find($field));
        foreach ($r->categories as $category)
            $fund->tags()->attach(tag::find($category));
        $fund->organization()->associate(organization::find($r->organization));
        dd($fund);
        return redirect('/addFund');
    }


    public function show($id){
        $funds = fund::find($id);
        $categories = $funds->tags->all();
        $organizations = $funds->organization;
        $country = $organizations->country;
        $fields = $funds->fields->all();
        return view('fundShow')->with(compact('funds', 'categories', 'organizations', 'country', 'fields'));
    }
}
