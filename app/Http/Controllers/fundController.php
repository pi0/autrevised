<?php

namespace App\Http\Controllers;

use App\country;
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

        return redirect('/addFund');
    }

    public function newFund(Request $r){
        $fund = new fund();
        $fund->name = $r->name;
        $fund->rating = 1;
        $fund->farsi = 'این  فاند ناقص است';
        $fund->comments = 'این  فاند ناقص است';
        $fund->organization_id = organization::first()->id;
        $fund->description = 'Empty fund';
        $fund->save();
        $fund->fields()->attach(field::find(1));
        $fund->tags()->attach(tag::find(1));
        $fund->organization()->associate(organization::find(1));
        return $fund->id;
    }


    public function show($id){
        $funds = $this->getFunds();
        $countries = $this->getCountries();
        $fields = $this->getFields();
        $categories = $this->getCategories();
        $organizations = $this->getOrganizations();
        $count = [];
        $i = 1;
        foreach ($funds as $f){
            array_push($count, $i);
            $i++;
        }


        $selectedfund = fund::find($id);
        $fundCategories = $selectedfund->tags->all();
        $fundOrganizations = $selectedfund->organization;
        $fundCountries = $fundOrganizations->country;
        $fundFields = $selectedfund->fields->all();
        return view('fundEdit')->with(compact('funds', 'categories', 'organizations', 'countries', 'fields', 'selectedfund', 'fundCategories', 'fundCountries', 'fundFields', 'fundOrganizations'));
    }


    public function present($id){
        $fund = fund::find($id);
        $categories = $fund->tags->all();
        $organizations = $fund->organization;
        $countries = $organizations->country;
        $fields = $fund->fields->all();
        return view('presentFund')->with(compact('fund', 'categories', 'organizations', 'countries', 'fields'));
    }

    public function update(Request $r, $id){
        $field_name = $r->field_name;
        $fund_id = $id;
        $field_value = $r->value;
        $fund = fund::find($fund_id);

        if($field_name!= "organization" && $field_name!="field" && $field_name!= "category"){
            if($field_name == 'name' || $field_name == 'rating')
                if(!$field_value)
                    return 'no';
            $fund->update([$field_name => $field_value]);
//            return a part of view we need to reload
            return redirect('/fund/'.$fund_id);
        }

        if($field_name == "organization"){
            $fund->organization_id = $field_value;
            $fund->organization()->dissociate();
            $fund->organization()->associate(organization::find($field_value));
        } elseif ($field_name == "field"){
            if(!$field_value)
                return 'no';
            $fund->fields()->detach();
            foreach ($field_value as $field)
                $fund->fields()->attach(field::find($field));
        } elseif ($field_name == "category") {
            if(!$field_value)
                return 'no';
            $fund->tags()->detach();
            foreach ($field_value as $category)
                $fund->tags()->attach(tag::find($category));
        }
        // return the part of page needed to reload
        $fund->save();
        return redirect('/fund/'.$fund_id);
    }


    public function del(Request $r, $id){
        $fund_id = $id;
        $fund = fund::find($fund_id);
        $fund->organization()->dissociate();
        $fund->fields()->detach();
        $fund->tags()->detach();
        $fund->delete();

    }

    private function getFunds(){
        return fund::all()->take(10);
    }

    private function getCategories(){
        return tag::all();
    }

    private function getCountries(){
        return country::all();
    }

    private function getOrganizations(){
        return organization::with('country')->get();
    }

    private function getFields(){
        return field::all();
    }

}
