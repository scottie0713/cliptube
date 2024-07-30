<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Playlist extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
    ];

    // relation: playlists.id -> user_playlists.playlist_id
    public function userPlaylists()
    {
        return $this->hasMany(UserPlaylist::class);
    }

    // relation: playlists.id -> playlist_clips.playlist_id
    public function clips()
    {
        return $this->hasMany(PlaylistClip::class);
    }
}
