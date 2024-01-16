<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Streamer;

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

        $crawler->filter('.___rk-program-card-detail-provider-name___uyI6f')->each(function ($node, $i) {
            // ユーザー放送のユーザー名を取得するため、50件まで取得する
            if($i >= 50){
                return false;
            }
            // ここでユーザー名やユーザーIDを抽出し、表示または保存
            $user_name = $node->text();
            echo $user_name."\n";

            // ユーザー名をデータベースに保存
            $streamer = new Streamer();
            $streamer->name = $user_name;
            $streamer->save();
        });

        print("End, getstreamers!\n");
    }
}
