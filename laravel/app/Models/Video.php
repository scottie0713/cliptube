<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Video extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'provider_video_id',
        'title',
    ];

    protected $hidden = [
        'provider_video_id',
    ];

    // カスタムアクセサを定義
    // provider_video_idをidとして扱う
    public function getIdAttribute()
    {
        return $this->attributes['provider_video_id'];
    }

    public function clips()
    {
        return $this->hasMany(Clip::class);
    }

    public static function withClips()
    {
        return self::whereHas('clips')->get();
    }
}
