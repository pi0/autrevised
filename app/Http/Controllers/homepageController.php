<?php

namespace App\Http\Controllers;

use App\country;
use App\field;
use App\fund;
use App\organization;
use App\tag;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class homepageController extends Controller
{


    public function sho(){
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
        return view('2page')->with(compact('funds', 'countries', 'fields', 'categories', 'organizations', 'count'));
    }




    public function show(){
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
        return view('homepage')->with(compact('funds', 'countries', 'fields', 'categories', 'organizations', 'count'));
    }



    private function getFunds(){
        return fund::where('visible',1)->take(10)->get();
    }

    private function getCategories(){
        $tagsInOrder = new Collection();
        $tags = tag::where('parent_id', 0)->get();
        foreach ($tags as $tag)
            $tagsInOrder->merge($this->findChildren($tag, $tagsInOrder));
        return $tagsInOrder;
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

    private function findChildren(tag $tag,$collectedTags){
        $children = $tag->children;
        if(!($children->isEmpty())) {
            $collectedTags->push($tag);
            foreach ($children as $child)
                $collectedTags->merge($this->findChildren($child, $collectedTags));
        } else
            $collectedTags->push($tag);
        return $collectedTags;
    }

}
