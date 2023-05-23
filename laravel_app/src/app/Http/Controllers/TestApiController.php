<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 

class TestApiController extends Controller
{
    
    public function index(){
        $data = $this->test_api();
        return view('test', ['tests' => $data]);
    }
    
    public function test_api(){
        $url = "http://app:8075/";
        $response = Http::get($url);
        return $response;
    }

}
