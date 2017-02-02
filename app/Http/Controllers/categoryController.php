<?php

namespace App\Http\Controllers;

use App\tag;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function add(Request $r){
        $parent = tag::find($r->parent);
        if($parent){
            $lastChild = $parent->children->last();
            $parentReal = $parent->real;

            if($lastChild)
            {
                $tmp = explode( '.', $lastChild->real);
                $lastRealPart = end($tmp);
                $myReal = intval($lastRealPart) + 1;
                $myFinalReal = $parentReal.".".$myReal;
                $myParentId = 0;

            } else{

                $myFinalReal = $parentReal.".1";
                $myParentId = $parent->id;
            }
        } elseif(!$parent) {
            $lastParent = tag::where('parent_id', 0)->get()->last();
            if($lastParent)
                $myReal = $lastParent->real;
            else
                $myReal = 0;
            $myFinalReal = intval($myReal) + 1;
            $myParentId = 0;
        }

        $description = $r->description;
        $tag = new tag();
        $tag->real = $myFinalReal;
        $tag->description = $description;
        if($parent)
            $tag->parent()->associate($parent, 'parent_id');
        else
        $tag->parent_id = $myParentId;
        $tag->save();
        return redirect('/addCategory');
    }

    public function delete($id){
        $this->del($id);
        return redirect('/addCategory');
    }

    private function del($id){
        $children = tag::find($id)->children;
//        dd($children);
        foreach ($children as $child)
            $this->del($child->id);
        tag::destroy($id);
        return 0;
    }

    public function update($id, Request $r){

        $parent = tag::find($r->parent);
        if($parent){
            $lastChild = $parent->children->last();
            $parentReal = $parent->real;

            if($lastChild)
            {
                $tmp = explode( '.', $lastChild->real);
                $lastRealPart = end($tmp);
                $myReal = intval($lastRealPart) + 1;
                $myFinalReal = $parentReal.".".$myReal;
                $myParentId = 0;

            } else{

                $myFinalReal = $parentReal.".1";
                $myParentId = $parent->id;
            }
        } elseif(!$parent) {
            $lastParent = tag::where('parent_id', 0)->get()->last();
            if($lastParent)
                $myReal = $lastParent->real;
            else
                $myReal = 0;
            $myFinalReal = intval($myReal) + 1;
            $myParentId = 0;
        }


        $category = tag::find($id);
        if($r->description)
            $category->description = $r->description;
        if($r->parent && $r->parent != $id)
        {
            $category->parent_id = $myParentId;
            $category->parent()->associate($parent);
            $category->real = $myFinalReal;
        }
        $category->save();
        return redirect('/addCategory');

    }
}
