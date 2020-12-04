<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testParam($id){
        return view('test3')->with('id', $id);
    }

    public function simpeleTest(){
        return view('test');
    }

}
