<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class ClipListRequest extends FormRequest
{
    public function authorize()
    {
        return true;  // 認可ロジックが必要な場合はここで処理
    }

    public function rules()
    {
        return [
            'videoId' => ['required', 'regex:/^[a-zA-Z0-9_-]{11}$/'],
        ];
    }
}
