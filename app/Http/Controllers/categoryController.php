<?php

namespace App\Http\Controllers;

use App\tag;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function add(Request $r){
        $this->addCategory($r->parent, $r->description);
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
        $category = tag::find($id);
        $this->updateCategoy($parent, $r->description, $category);
        return redirect('/addCategory');

    }


    private function updateCategoy($parent, $description, $category){
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


        if($description)
            $category->description = $description;
        if($parent->id && $parent->id != $category->id)
        {
            $category->parent_id = $myParentId;
            $category->parent()->associate($parent);
            $category->real = $myFinalReal;
        }
        $category->save();
        if(count($category->children)) {
            $children = $category->children;
            $this->recursiveUpdate($children);
        }
        return 0;
    }


    private function recursiveUpdate($children){
        for($i=0; $i<count($children); $i++){
            $child = $children[$i];

            $parentReal = $child->parent->real;

            $index = $i+1;
            $child->real = $parentReal.'.'.$index;
            $child->save();

            if(count($child->children)>0){
                $this->recursiveUpdate($child->children);
            }
        }
        return 0;
    }


    private function addCategory($parentID, $description){
        $parent = tag::find($parentID);
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

        $tag = new tag();
        $tag->real = $myFinalReal;
        $tag->description = $description;
        if($parent)
            $tag->parent()->associate($parent, 'parent_id');
        else
            $tag->parent_id = $myParentId;
        $tag->save();
        return 0;
    }
}
