<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Community;

class GetStreamings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getstreamings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '配信データ取得処理';

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
        print("Start, getstreamings!\n");

        // commities テーブルからコミュニティIDを読み出す
        $communities = Community::all();
        // var_dump($communities);
        // var_dump($communities);

        $client = new Client();

        // Streamerモデルにデータを保存

        // foreach ($communities as $community) {
        //     var_dump($community);
        //     echo $community->id . "\n";
        // }

        collect($communities)->each(function ($community) use ($client) {
            // echo $community->id . "\n";
            echo 'https://com.nicovideo.jp/live/'. $community->id . "\n";
            // $response = $client->request('GET', 'https://live.nicovideo.jp/ranking');
            // $crawler = new Crawler($response->getBody()->getContents());
        });




        // コレクションのマップ処理
        // $streamers = collect($communities)->map(function ($community) {
        //     return [
        //         'id' => $user_program["programProvider"]["id"],
        //         'name' => $user_program["programProvider"]["name"],
        //     ];
        // })->toArray();

        // Streamer::upsert($streamers, ['id'], ['name']);

        // 取得したコミュニティIDを元に、生放送履歴ページを開く
        // 生放送履歴ページから前日分の配信URLを取得
        // 配信URLから来場者数、コメント、広告pt、ギフトpt データ等を取得
        // 取得したデータを streamings テーブルに登録する

        print("End, getstreamings!\n");
        return 0;
    }
}
