<?php

namespace App\Console\Commands;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of posts created exactly minutes added by admin';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Update the status of posts created exactly 10 minutes ago
        $tenMinutesAgo = Carbon::now()->subMinutes(1);
        Post::where('status', Post::AVAILABLE)
            ->where('created_at', '<=', $tenMinutesAgo)
            ->update(['status' => Post::ON_HOLD]);
    }
}
