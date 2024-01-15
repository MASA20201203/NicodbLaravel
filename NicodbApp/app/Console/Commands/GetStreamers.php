<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

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

        // print_r($crawler);

        // var_dump($crawler);

        // $crawler->filter('.some-class')->each(function ($node) {
        //     // ここでユーザー名やユーザーIDを抽出し、表示または保存
        //     echo $node->text()."\n";
        // });

        $crawler->filter('.___rk-program-card-detail-provider-name___uyI6f')->each(function ($node) {
            // ここでユーザー名やユーザーIDを抽出し、表示または保存
            echo $node->text()."\n";
        });

        print("End, getstreamers!\n");
    }
}
