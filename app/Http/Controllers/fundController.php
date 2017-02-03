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

    public function update(Request $r, $id){
        $field_name = $r->field_name;
        $fund_id = $id;
        $field_value = $r->value;
        $fund = fund::find($fund_id);

        if($field_name!= "organization" && $field_name!="field" && $field_name!= "category"){
            $fund->update([$field_name => $field_value]);
//            return a part of view we need to reload
            return redirect('/fund/1');
        }

        if($field_name == "organization"){
            $fund->organization_id = $field_value;
            $fund->organization()->dissociate();
            $fund->organization()->associate(organization::find($field_value));
        } elseif ($field_name == "field"){
            $fund->fields()->detach();
            foreach ($field_value as $field)
                $fund->fields()->attach(field::find($field));
        } elseif ($field_name == "category") {
            $fund->tags()->detach();
            foreach ($field_value as $category)
                $fund->tags()->attach(tag::find($category));
        }
        // return the part of page needed to reload
        $fund->save();
        return redirect('/fund/1');
    }
}
