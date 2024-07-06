<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class YoutubeSearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;  // 認可ロジックが必要な場合はここで処理
    }

    public function rules()
    {
        return [
            'query' => 'required|string|max:255',
        ];
    }
}
