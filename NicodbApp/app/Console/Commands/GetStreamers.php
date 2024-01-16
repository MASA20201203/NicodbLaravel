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

        // $crawler->filter('.___rk-program-card-detail-provider-name___uyI6f')->each(function ($node, $i) {
        //     // ユーザー放送のユーザー名を取得するため、50件まで取得する
        //     if($i >= 50){
        //         return false;
        //     }
        //     // ここでユーザー名やユーザーIDを抽出し、表示または保存
        //     $user_name = $node->text();
        //     echo $user_name."\n";

        //     // ユーザー名をデータベースに保存
        //     $streamer = new Streamer();
        //     $streamer->name = $user_name;
        //     $streamer->save();
        // });

        // DEBUG 後で削除
        // // 'embedded-data'のデータを取得する
        // $embeddedData = $crawler->filter('script[data-name="embedded-data"]')->each(function ($node) {
        //     return $node->attr('data-props');
        // });

        // // $embeddedDataには必要なデータが含まれます
        // print_r($embeddedData);


        // $html = (string) $response->getBody();

        // $dom = new DOMDocument();
        // @$dom->loadHTML($html);

        // $xpath = new DOMXPath($dom);
        // $nodes = $xpath->query('//*[@data-embedded]');

        // foreach ($nodes as $node) {
        //     echo $node->nodeValue . "\n";
        // }

        // "embedded-data"要素の"data-props"属性を取得
        $dataProps = $crawler->filter('#embedded-data')->attr('data-props');

        // JSONデータをデコード
        $jsonData = json_decode($dataProps, true);

        // 処理...
        // 例えば、$jsonDataをそのまま返すか、加工して返す
        // var_dump($jsonData);
        // var_dump($jsonData["ranking"]);
        var_dump($jsonData["ranking"]["userPrograms"]);
        
        // $file = './tmp/embedded-data.json';
        // // ファイルをオープンして既存のコンテンツを取得します
        // $current = file_get_contents($file);
        // // 新しい人物をファイルに追加します
        // $current .= $jsonData;
        // // 結果をファイルに書き出します
        // file_put_contents($file, $current);

        print("End, getstreamers!\n");
    }
}
