<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\VotingPortal;
use Carbon\carbon;

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
        $votingPoll = VotingPortal::get();

        foreach ($votingPoll as $key => $poll) {

            $currentDate = Carbon::now();
            $startDate = $poll->date . ' ' . date('H:i:s', strtotime($poll->start_time));
            $endDate =  $poll->date . ' ' . date('H:i:s', strtotime($poll->end_time));

            if ($poll->status == 0) {
                if (($currentDate >= $startDate) && ($currentDate <= $endDate)) {
                    $poll->status = 1;
                    $poll->save();
                }
            } else if ($poll->status == 1) {
                if (($currentDate >= $startDate) && ($currentDate >= $endDate)) {
                    $poll->status = 2;
                    $poll->save();
                }
            }
        }

        //run php artisan schedule:work
    }
}
