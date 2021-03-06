<?php

namespace App\Http\Controllers;


//add
use App\Folder;
use App\Task; // Task()
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;//タスク追加処理作成
use App\Http\Requests\EditTask;//タスク変更処理作成

// ★ Authクラスをインポートする
use Illuminate\Support\Facades\Auth;

// DBクラス
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    	//タスク表示処理 idはデータ型のため、int使用	
	public function index(int $id){
		//return "Hello world";

		// ★ ユーザーのフォルダを取得する
        	$folders = Auth::user()->folders()->get();

		//全てのフォルダーを取得する	
		$folders = Folder::all();

		//選ばれたフォルダーを取得する
		$current_folder = Folder::find($id);

		//選ばれたフォルダに紐づくタスクを取得する
		//$tasks = Task::where('folder_id', $current_folder->id)->get();
		$tasks = $current_folder->tasks()->get(); //変更 	

		//blade.php　htmlのキーの値を渡す	
		return view('tasks/index', [
			//フォルダー名	
			'folders' => $folders,
			//id値
			'current_folder_id' => $current_folder->id,
			//タスク名	
			'tasks' => $tasks,
        	]);
	}
	
	//タスク登録ページ　表示処理
	public function showCreateForm(int $id)
	{
		//追加する場合フォルダーを選択しておく必要があるため
    		return view('tasks/create', [
        		'folder_id' => $id
    		]);
	}

	//タスク登録処理
	public function create(int $id, CreateTask $request)
	{
		//id値をフォルダー名に紐づけ	
		$current_folder = Folder::find($id);
		//モデルクラス呼び出し==データ登録させるためのカラム呼び出し
    		$task = new Task();
		//タスク登録する	
		$task->title = $request->title;
		//日付	
		$task->due_date = $request->due_date;

    		$current_folder->tasks()->save($task);


		//Taskモデル内表示
		//ddd($task);

    		return redirect()->route('tasks.index', [
        		'id' => $current_folder->id,
    		]);
	}

	//タスク編集ページへ移動
	public function showEditForm(int $id, int $task_id)
	{
		//タスクidでselect実施
    		$task = Task::find($task_id);

		//削除処理追加
		/*
		return view('tasks/edit', [
        		'task' => $task,
		]);
		 */
		return view('tasks/edit', [
                        'task' => $task,
                ]);
	}

	//タスク変更処理	
	public function edit(int $id, int $task_id, EditTask $request)
	{
    		//タスクデータ取得
    		$task = Task::find($task_id);

    		//DB登録
    		$task->title = $request->title;
    		$task->status = $request->status;
    		$task->due_date = $request->due_date;
    		$task->save();

    		//タスク一覧画面に移動
    		return redirect()->route('tasks.index', [
        		'id' => $task->folder_id,
    		]);
	}

	//タスク削除処理
	public function del(string $id, string $task_id)
	{

		//削除処理
		//Task::find($task_id->id)->delete();
		Task::find($task_id)->delete();


		//タスク一覧画面に移動
		return redirect()->route('tasks.index', [
			'id' => $id,
		]);

	}

}
