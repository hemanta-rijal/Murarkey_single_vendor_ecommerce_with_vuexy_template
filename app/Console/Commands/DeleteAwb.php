<?php

namespace App\Console\Commands;

use App\Models\NotFoundAwb;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteAwb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:awb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete AWB after 20 days.';

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
     * @return mixed
     */
    public function handle()
    {
        $after20days = Carbon::parse('20 days ago');
        NotFoundAwb::where('created_at', '<=', $after20days)->delete();
    }
}
