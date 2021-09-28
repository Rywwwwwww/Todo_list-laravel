<?php

//EditTask タスク編集処理
//CreateTaskクラスを継承している

namespace App\Http\Requests;

use App\Task;
use Illuminate\Validation\Rule;

//追加
//use Illuminate\Foundation\Http\FormRequest;

class EditTask extends CreateTask
{
    public function rules()
    {
        $rule = parent::rules();

	//状態(1,2,3)を代入
        $status_rule = Rule::in(array_keys(Task::STATUS));

        return $rule + [
            'status' => 'required|' . $status_rule,
        ];
    }

    public function attributes()
    {
        $attributes = parent::attributes();

        return $attributes + [
            'status' => '状態',
        ];
    }

    //エラーメッセージ
    public function messages()
    {
        $messages = parent::messages();

        $status_labels = array_map(function($item) {
            return $item['label'];
        }, Task::STATUS);

        $status_labels = implode('、', $status_labels);

        return $messages + [
            'status.in' => ':attribute には ' . $status_labels. ' のいずれかを指定してください。',
        ];
    }

}
