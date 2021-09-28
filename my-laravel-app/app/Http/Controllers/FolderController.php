<?php

//ファルダ作成処理

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;

use App\Http\Requests\CreateFolder; // ★ 追加

// ★ Authクラスをインポートする
use Illuminate\Support\Facades\Auth;


class FolderController extends Controller
{
	//ページ表示
	public function showCreateForm()
	{
        	return view('folders/create');
	}
	
	//フォルダ作成	CreateFolder.phpのリクエスト結果をもらう
	public function create(CreateFolder $request)
	{
    		// フォルダモデルのインスタンスを作成する
    		$folder = new Folder();
    		// タイトル[title=viewのテキストid]に入力値を代入する
    		$folder->title = $request->title;

		// ★ ユーザーに紐づけて保存
        	Auth::user()->folders()->save($folder);


		// インスタンスの状態をデータベースに書き込む
		$folder->save();

		//htmlに渡す(登録したデータのidページにいく)
    		return redirect()->route('tasks.index', [
        		'id' => $folder->id,
    		]);
	}
}
