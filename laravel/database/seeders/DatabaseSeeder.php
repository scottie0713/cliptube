<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\ClipSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        DB::table('users')->insert([
            'provider' => 'twitter',
            'provider_id' => '11194222',
            'provider_name' => 'scottie2nd',
            'name' => 'kiki',
            'hash' => Str::random(6),
            'avatar' => 'https://pbs.twimg.com/profile_images/824897060495167489/a15ksl2S_x96.jpg',
            'token' => 'Snlrb28zVWpLakxUTEF5dDZ6RV9UM2Y3cmhJaGE4TjZFdFdKeFh5bkdHRWdJOjE3MjA2MzMwMDc2NzQ6MToxOmF0OjE',
        ]);
        $this->call([
            ClipSeeder::class,
        ]);
    }
}
