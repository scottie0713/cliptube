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
            'id' => 'required|string|max:16',
            'title' => 'required|string|max:255',
            'thumbnail' => 'required|url:http,https',
        ];
    }
}
