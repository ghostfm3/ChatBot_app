<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 

class TestApiController extends Controller
{
    
    public function index(){       
        return view('test');
    }

    public function store(Request $request){
        $request->validate([
            'prompt' => 'required|max:100',
        ]);
    
        $text = $request->prompt;
        $data = $this->test_api($text);
        
        return view('test')->with([
            'prompts' => [$text],
            'tests' => [$data],
        ]);
    }
    
    public function test_api($text){
        $url = "http://app:8076/?data=" . $text;
        $response = Http::post($url);
        $responseData = $response->json();
        $res_text = $responseData["response"];
        return $res_text;
    }

}
