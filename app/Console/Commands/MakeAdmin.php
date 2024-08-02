<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {UserEmail}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make A user Admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $user_email = $this->argument('UserEmail');
        User::where('email', $user_email)->update(['role' => 'admin']);
        Log::info('user email' . $user_email . 'has been granted admin priviledges');
        echo "finished";
    }
}
