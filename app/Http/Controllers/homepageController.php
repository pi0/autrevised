<?php

namespace App\Http\Controllers;

use App\country;
use App\field;
use App\fund;
use App\organization;
use App\tag;
use Illuminate\Http\Request;

class homepageController extends Controller
{
    public function show(){
        $funds = $this->getFunds();
        $countries = $this->getCountries();
        $fields = $this->getFields();
        $categories = $this->getCategories();
        $organizations = $this->getOrganizations();
        return view('homepage')->with(compact('funds', 'countries', 'fields', 'categories', 'organizations'));
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
