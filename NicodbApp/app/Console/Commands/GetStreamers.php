<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
    }
}
