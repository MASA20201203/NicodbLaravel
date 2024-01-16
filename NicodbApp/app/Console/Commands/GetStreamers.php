<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Streamer;
use App\Models\Community;
use Illuminate\Support\Collection;

class GetStreamers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getstreamers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '配信データを取得するニコ生ユーザー情報を取得する';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        print("Start, getstreamers!\n");

        $client = new Client();
        $response = $client->request('GET', 'https://live.nicovideo.jp/ranking');

        $crawler = new Crawler($response->getBody()->getContents());

        // ニコ生公式ランキングのjsonデータを取得（"embedded-data"要素の"data-props"）
        $dataProps = $crawler->filter('#embedded-data')->attr('data-props');
        $jsonData = json_decode($dataProps, true);

        // jsonデータからユーザー配信のデータを変数に格納
        $user_programs = $jsonData["ranking"]["userPrograms"];

        // Streamerモデルにデータを保存
        $streamers = collect($user_programs)->map(function ($user_program) {
            return [
                'id' => $user_program["programProvider"]["id"],
                'name' => $user_program["programProvider"]["name"],
            ];
        })->toArray();

        Streamer::upsert($streamers, ['id'], ['name']);

        // Communityモデルにデータを保存
        $communities = collect($user_programs)->map(function ($user_program) {
            return [
                'id' => $user_program["socialGroup"]["id"],
            ];
        })->toArray();

        Community::upsert($communities, ['id']);

        print("End, getstreamers!\n");
    }
}
