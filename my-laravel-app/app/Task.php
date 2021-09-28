<?php

//モデルファイル
//フォルダ及び、タスク表示	

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
	//追加
	const STATUS = [
		1 => [ 'label' => '未着手', 'class' => 'label-danger' ],
    		2 => [ 'label' => '着手中', 'class' => 'label-info' ],
    		3 => [ 'label' => '完了', 'class' => '' ],
	];

	//状態の表示	
	public function getStatusLabelAttribute()
    	{
        	// 状態値
        	$status = $this->attributes['status'];

        	// 定義されていなければ空文字を返す
        	if (!isset(self::STATUS[$status])) {
			return '';
        	}

		//Viewへ...
        	return self::STATUS[$status]['label'];
	}

	//状態を色分け
	public function getStatusClassAttribute()
	{
    		// 状態値
    		$status = $this->attributes['status'];

    		// 定義されていなければ空文字を返す
    		if (!isset(self::STATUS[$status])) {
        		return '';
    		}
	
		//Viewへ...
    		return self::STATUS[$status]['class'];
	}

	//日付表示
	public function getFormattedDueDateAttribute()
    	{
		//Viewへ...	
		return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])
            	->format('Y/m/d');
    	}
}
