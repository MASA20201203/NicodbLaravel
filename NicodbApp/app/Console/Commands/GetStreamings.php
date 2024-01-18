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
        // collect($communities)->each(function ($community) use ($client) {
        //     // echo $community->id . "\n";
        //     // echo 'https://com.nicovideo.jp/live/'. $community->id . "\n";
        //     $response = $client->request('GET', 'https://com.nicovideo.jp/live/'. $community->id);
        //     $crawler = new Crawler($response->getBody()->getContents());
        //     var_dump($crawler);
        //     return false;

            // $live_date = $crawler->filter('.liveDate');
            // echo var_dump($live_date);
            // dd($live_date);
        // });

        $response = $client->request('GET', 'https://com.nicovideo.jp/api/v1/communities/6167499/lives.json?limit=50&offset=0');
        // $response = $client->request('GET', 'https://com.nicovideo.jp/live/co6167499');
        // var_dump($response->getBody()->getContents());
        var_dump($response);

        // $crawler = new Crawler($response->getBody()->getContents());
        // var_dump($crawler);

        // ".LiveItem"の要素を取得
        // $liveDate = $crawler->filter('.liveDate');
        // var_dump($liveDate);

        // 各".LiveItem"要素に対する処理
        // $liveItems->each(function (Crawler $node) {
        //     // ここで各要素に対する処理を行う
        //     // 例えば、要素のテキストを表示する
        //     echo $node->text() . "\n";
        // });



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
