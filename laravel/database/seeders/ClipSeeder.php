<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClipSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $videoId = DB::table('videos')->insertGetId([
            'provider_video_id' => 'Cri2DJpC9PQ',
            'title' => 'ナポリの男たちの「クロノ・トリガー」クリアまで配信【祝6周年】#1',
            'thumbnail' => 'https://i.ytimg.com/vi/Cri2DJpC9PQ/default.jpg',
        ]);
        DB::table('videos')->insert([
            'provider_video_id' => 'uXpNXL_W-dI',
            'title' => 'ナポリの男たちの「クロノ・トリガー」クリアまで配信【祝6周年】#2',
            'thumbnail' => 'https://i.ytimg.com/vi/uXpNXL_W-dI/default.jpg',
        ]);
        DB::table('videos')->insert([
            'provider_video_id' => 'wK3ebMX2TZU',
            'title' => 'ナポリの男たちの「クロノ・トリガー」クリアまで配信【祝6周年】#3',
            'thumbnail' => 'https://i.ytimg.com/vi/wK3ebMX2TZU/default.jpg',
        ]);

        $storyId = DB::table('stories')->insertGetId([
            'title' => 'ストーリーテスト',
            'hash' => Str::random(6),
            'description' => 'description',
        ]);

        DB::table('user_stories')->insert([
            'user_id' => 1,
            'story_id' => $storyId,
        ]);

        foreach ($this->getAttributes($videoId) as $index => $attribute) {
            $attribute['hash'] = Str::random(6);
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

    private function getAttributes(int $videoId)
    {
        return [
            [
                'video_id' => $videoId,
                'title' => '漫画研究会：北斗の拳１',
                'start_sec' => 13274,
                'end_sec' => 13331,
            ], [
                'video_id' => $videoId,
                'title' => '漫画研究会：北斗の拳２',
                'start_sec' => 13866,
                'end_sec' => 13901,
            ], [
                'video_id' => $videoId,
                'title' => '漫画研究会：北斗の拳３',
                'start_sec' => 14533,
                'end_sec' => 14593,
            ], [
                'video_id' => $videoId,
                'title' => 'シューサン加入',
                'start_sec' => 16917,
                'end_sec' => 17390,
            ], [
                'video_id' => $videoId,
                'title' => '蘭たん「誰？」',
                'start_sec' => 16104,
                'end_sec' => 16156,
            ], [
                'video_id' => $videoId,
                'title' => '音読み訓読み1',
                'start_sec' => 1199,
                'end_sec' => 1218,
            ], [
                'video_id' => $videoId,
                'title' => '音読み訓読み2',
                'start_sec' => 1250,
                'end_sec' => 1288,
            ], [
                'video_id' => $videoId,
                'title' => 'グラン・リオン戦',
                'start_sec' => 26953,
                'end_sec' => 27329,
            ], [
                'video_id' => $videoId,
                'title' => '血文字',
                'start_sec' => 33516,
                'end_sec' => 33564,
            ], [
                'video_id' => $videoId,
                'title' => 'ﾋﾞﾈｶﾞｰ!',
                'start_sec' => 33921,
                'end_sec' => 33944,
            ]
        ];
    }
}
