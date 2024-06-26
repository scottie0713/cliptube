<?php

namespace Database\Seeders;

// use App\Models\User;
use Database\Seeders\ClipSeeder;
use Database\Seeders\StorySeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        DB::table('users')->insert([
            'account_id' => 'kimukimi713',
            'password' => '$2y$12$8WkUL5zoxQFjYoN3Q765kuM2lNmsAveJSRcAw/dWiUnQbVckbrdy2',
        ]);
        $this->call([
            ClipSeeder::class,
        ]);
    }
}
