<?php

namespace App\Console\Commands;

use App\Mail\QrCodeGenerated;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class GenerateQrCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qrcode:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        Mail::to('hizmetparki@gmail.com')->send(new QrCodeGenerated());
    }
}
