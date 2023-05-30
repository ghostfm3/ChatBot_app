<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Log;
use App\Models\ChatRes;

class TestApiController extends Controller
{
    
    public function index(){ 
        $chatreses = ChatRes::all();     
        Log::info($chatreses); 
        return view('test', [
            'chatreses' => $chatreses
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'prompt' => 'required|max:100',
        ]);

        $text = $request->prompt;
        $nowTime = date('Y-m-d H:i:s');
        $response = $this->test_api($text);

        $chatres_in = new ChatRes();
        $chatres_in -> prompt = $text;
        $chatres_in -> response = $response;
        $chatres_in -> created_at = $nowTime;
        $chatres_in -> updated_at = $nowTime;
        $chatres_in -> save();
        // return redirect("/test");

        $storeSuccess = array('status' => 'success', 'response' => $response );
        return json_encode($storeSuccess);
    }
    
    public function test_api($text){
        $url = "http://app:8076/?data=" . $text;

        try {
            $response = Http::post($url);
            $responseData = $response->json();
            $res_text = $responseData["response"];

            return $res_text;
        } catch (\Exception $e) {
            Log::error('APIリクエストエラー: ' . $e->getMessage());
            $res_text = "API取得エラー";

            return $res_text;
        };
    }

    public function destroy()
    {
        ChatRes::truncate();
        return redirect("/test");
    }

}
