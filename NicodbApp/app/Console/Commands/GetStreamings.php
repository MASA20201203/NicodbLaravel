<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
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

        foreach ($communities as $community) {
            // echo $community->id . "\n";
            var_dump($community);
        }


        // collect($communities)->each(function ($community) {
            // var_dump($community->items);
            // var_dump($community->get('items'));
            // var_dump($community->attributes);
            // var_dump($community['attributes']['community_id']);
            // var_dump($community->get('attributes'));
            // var_dump($community);
            // print_r($community);
            // echo gettype($community) . "\n";
        // });
        // $streamers = collect($user_programs)->map(function ($user_program) {
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
