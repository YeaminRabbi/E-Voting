<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Carbon\carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class CheckVotingTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:votingtime';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check is the voting time is active or not';

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
        $user = new User;
        $user->name = Str::random(10);
        $user->email = Str::random(6).'@gmail.com';
        $user->password =  Hash::make(Str::random(3));
        $user->phone = Str::random(11);
        $user->email_verified_at = Carbon::now();
        $user->organizer_id = 1;
        $user->save();

        //run php artisan schedule:work
    }
}
