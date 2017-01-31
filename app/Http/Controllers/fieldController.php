<?php

namespace App\Http\Controllers;

use App\field;
use Illuminate\Http\Request;

class fieldController extends Controller
{
    public function add(Request $r){
        $name = $r->field;
        field::firstOrCreate(['title'=>$name]);
        return redirect('/addField');
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
