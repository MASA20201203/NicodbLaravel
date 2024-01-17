<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        print("End, getstreamings!\n");
        return 0;
    }
}
