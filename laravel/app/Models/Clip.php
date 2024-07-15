<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Clip extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'video_id',
        'title',
        'hash',
        'start_sec',
        'end_sec',
        'point',
    ];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public static function filterByProviderVideoId(string $providerVideoId)
    {
        return self::whereHas('video', function ($query) use ($providerVideoId) {
            $query->where('provider_video_id', $providerVideoId);
        });
    }
}
