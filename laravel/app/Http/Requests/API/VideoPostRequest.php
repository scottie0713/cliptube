<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class VideoPostRequest extends FormRequest
{
    public function authorize()
    {
        return true;  // 認可ロジックが必要な場合はここで処理
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:32',
            'description' => 'string|max:255',
        ];
    }
}
