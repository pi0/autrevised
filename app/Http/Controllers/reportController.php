<?php

namespace App\Http\Controllers;

use App\fund;
use App\tag;
use Barryvdh\DomPDF\PDF;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class reportController extends Controller
{
    public function show(){
      $funds = new Collection();
      foreach ($this->getCategories() as $tag){
          $tmp = $tag->funds()->with('tags', 'organization', 'fields')->orderBy('organization_id')->get();
          $fundsTmp = new Collection();
          foreach ($tmp as $fund){
              $fundsTmp->push($fund);
          }
          $funds->push(["tag"=>$tag, "funds"=>$fundsTmp]);
      }
//      $funds = $funds->all();
//      $funds = tag::funds()->with('tags', 'organization', 'fields')->get();
      return view('report')->with(compact('funds'));
//        return $funds;
    }

    private function getCategories(){
        $tagsInOrder = new Collection();
        $tags = tag::where('parent_id', 0)->get();
        foreach ($tags as $tag)
            $tagsInOrder->merge($this->findChildren($tag, $tagsInOrder));
        return $tagsInOrder;
    }

    private function findChildren(tag $tag,$collectedTags){
        $me = $tag;
        $me["is_parent"] = false;
        $children = $tag->children;
        if(!($children->isEmpty())) {
            $me["is_parent"] = true;
            $collectedTags->push($me);
            foreach ($children as $child)
                $collectedTags->merge($this->findChildren($child, $collectedTags));
        } else
            $collectedTags->push($tag);
        return $collectedTags;
    }

}
