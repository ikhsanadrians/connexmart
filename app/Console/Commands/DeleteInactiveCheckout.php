<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserCheckout;

class DeleteInactiveCheckout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-inactive-checkout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        UserCheckout::where("updated_at", "<", now()->subMinutes(1))->delete();
    }
}