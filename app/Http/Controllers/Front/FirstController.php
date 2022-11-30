<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FirstController extends Controller
{
    public function showString() {
        return view('index');
    }
    public function about() {
        return view('about');
    }
    public function index($app=null) {
        $name='omar';
        $data=array(
            'phone'=>'7775',
            'email'=>'omar@omar',
            'id'=>'12',
        );
        $obj=new \stdClass();
        $obj ->data=array(
            'phone'=>'7775',
            'email'=>'omar@omar',
            'id'=>'12',
        );
        $obj ->fax= 20;
        $obj ->gender='male';
        if(!$app) return view('user',['name'=>$name],compact('obj'));
        else return response()->json(['name'=>$name,compact('obj')]);
    }
}
