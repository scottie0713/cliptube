<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserPlaylist extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'playlist_id',
    ];

    /**
     * playlists.hashを受け取って、それが自分のものかどうかを判定する
     */
    public function isMine(string $playlistHash): bool
    {
        $playlist = Playlist::where('hash', $playlistHash)->first();
        if ($playlist === null) {
            return false;
        }

        $userPlaylist = UserPlaylist::where('playlist_id', $playlist->id)->first();
        if ($userPlaylist === null) {
            return false;
        }

        return $userPlaylist->user_id === $this->id;
    }
}
