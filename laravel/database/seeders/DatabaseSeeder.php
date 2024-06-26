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
            'account_id' => 'kimukimi713',
            'hash' => Str::random(6),
            'password' => '$2y$12$8WkUL5zoxQFjYoN3Q765kuM2lNmsAveJSRcAw/dWiUnQbVckbrdy2',
        ]);
        $this->call([
            ClipSeeder::class,
        ]);
    }
}
