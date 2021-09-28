<?php

//追加
use Carbon\Carbon;

use Illuminate\Database\Seeder;

//追加
use Illuminate\Support\Facades\DB;


class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	//firstメソッドでIDを取得	
	$user = DB::table('users')->first(); // ★

	//フォルダテーブルに、３つデータ追加
	$titles = ['プライベート', '仕事', '旅行'];
    
	foreach ($titles as $title) {
		//テーブル指定
        	DB::table('folders')->insert([
			'title' => $title,
			//アカウントカラム
			'user_id' => $user->id, // ★
                	'created_at' => Carbon::now(),
                	'updated_at' => Carbon::now(),
            	]);
	}	    
    }
}
