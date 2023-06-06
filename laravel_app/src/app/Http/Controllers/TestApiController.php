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
        $this -> url = "http://app:8076/?data=";
        $this -> apiError = "API取得エラー";
        $this -> dbError = "DB反映エラー";
    }

    public function errorLog($errMsg) {
        $errorMessage = $errMsg->getMessage();
        return Log::error($errorMessage);
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
            $this -> errorLog($e);
            $storeError = array('status' => 'error', 'response' => $this -> dbError);
            return json_encode($storeError);
        }
    }
    
    public function test_api($text){
        /*
        APIリクエスト処理
        */
        $url_fu = $this -> url . $text;

        try {
            // APIリクエスト
            $response = Http::post($url_fu);
            $responseData = $response->json();
            $res_text = $responseData["response"];

            return $res_text;
        } catch (\Exception $e) {
            // レスポンス受け取り失敗時
            $this -> errorLog($e);

            return $this -> apiError;
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

            return redirect("/test");
        } catch (\Exception $e){
            $this -> errorLog($e);
            DB::rollBack();
            
            $storeError = array('status' => 'error', 'response' => $this -> dbError);
            return json_encode($storeError);
        }
    }

}
