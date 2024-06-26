<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClipSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $storyId = DB::table('stories')->insertGetId([
            'title' => 'ストーリーテスト',
            'description' => 'description',
        ]);

        DB::table('user_stories')->insert([
            'user_id' => 1,
            'story_id' => $storyId,
        ]);

        foreach ($this->getAttributes() as $index => $attribute) {
            $clipId = DB::table('clips')->insertGetId($attribute);
            DB::table('story_clips')->insert([
                'story_id' => $storyId,
                'clip_id' => $clipId,
                'order' => $index + 1,
            ]);
            DB::table('user_clips')->insert([
                'user_id' => 1,
                'clip_id' => $clipId,
            ]);
        }
    }

    private function getAttributes()
    {
        return [
            [
                'video_id' => 'Cri2DJpC9PQ',
                'title' => '漫画研究会：北斗の拳１',
                'start_sec' => 13274,
                'end_sec' => 13331,
            ], [
                'video_id' => 'Cri2DJpC9PQ',
                'title' => '漫画研究会：北斗の拳２',
                'start_sec' => 13866,
                'end_sec' => 13901,
            ], [
                'video_id' => 'Cri2DJpC9PQ',
                'title' => '漫画研究会：北斗の拳３',
                'start_sec' => 14533,
                'end_sec' => 14593,
            ], [
                'video_id' => 'Cri2DJpC9PQ',
                'title' => 'シューサン加入',
                'start_sec' => 16917,
                'end_sec' => 17390,
            ], [
                'video_id' => 'Cri2DJpC9PQ',
                'title' => '蘭たん「誰？」',
                'start_sec' => 16104,
                'end_sec' => 16156,
            ], [
                'video_id' => 'Cri2DJpC9PQ',
                'title' => '音読み訓読み1',
                'start_sec' => 1199,
                'end_sec' => 1218,
            ], [
                'video_id' => 'Cri2DJpC9PQ',
                'title' => '音読み訓読み2',
                'start_sec' => 1250,
                'end_sec' => 1288,
            ], [
                'video_id' => 'Cri2DJpC9PQ',
                'title' => 'グラン・リオン戦',
                'start_sec' => 26953,
                'end_sec' => 27329,
            ], [
                'video_id' => 'Cri2DJpC9PQ',
                'title' => '血文字',
                'start_sec' => 33516,
                'end_sec' => 33564,
            ], [
                'video_id' => 'Cri2DJpC9PQ',
                'title' => 'ﾋﾞﾈｶﾞｰ!',
                'start_sec' => 33921,
                'end_sec' => 33944,
            ]
        ];
    }
}
