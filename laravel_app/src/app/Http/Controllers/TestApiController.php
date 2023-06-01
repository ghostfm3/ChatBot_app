<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\ChatRes;

class TestApiController extends Controller
{
    public function __construct() {
        /*
        コンストラクタ指定
        */
        $this -> nowTime = date('Y-m-d H:i:s');
    }

    public function index(){ 
        /*
        ページ表示
        */
        $chatreses = ChatRes::all();     
        Log::info($chatreses); 
        return view('test', [
            'chatreses' => $chatreses
        ]);
    }

    public function store(Request $request){
        /*
        値受け取り, insert処理
        */
        $request->validate([
            'prompt' => 'required|max:100',
        ]);

        $text = $request->prompt;
        $response = $this->test_api($text);
        
        try {
            // DBにInsertする
            $chatres_in = new ChatRes();
            $chatres_in -> prompt = $text;
            $chatres_in -> response = $response;
            $chatres_in -> created_at = $this->nowTime;
            $chatres_in -> updated_at = $this->nowTime;
            $chatres_in -> save();

            $storeSuccess = array('status' => 'success', 'response' => $response );

            return json_encode($storeSuccess);
        } catch (\Exception $e) {
            // DB Insertエラー
            $errorMessage = $e->getMessage();
            Log::error($errorMessage);
            $storeError = array('status' => 'error', 'message' => $errorMessage);
            return json_encode($storeError);
        }
    }
    
    public function test_api($text){
        /*
        APIリクエスト処理
        */
        $url = "http://app:8076/?data=" . $text;

        try {
            // APIリクエスト
            $response = Http::post($url);
            $responseData = $response->json();
            $res_text = $responseData["response"];

            return $res_text;
        } catch (\Exception $e) {
            // レスポンス受け取り失敗時
            Log::error('APIリクエストエラー: ' . $e->getMessage());
            $res_text = "API取得エラー";

            return $res_text;
        };
    }

    public function destroy()
    {
        /*
        削除ボタン処理
        */
        try {
            DB::beginTransaction();
            ChatRes::truncate();
            DB::commit();
        } catch (\Exception $e){
            Log::error('削除エラー: ' . $e->getMessage());
            DB::rollBack();
        }

        return redirect("/test");
    }

}
