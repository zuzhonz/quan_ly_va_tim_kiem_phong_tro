<?php

namespace App\Console\Commands;

use App\Models\Motel;
use App\Mail\motel_money;
use App\Mail\RegisterOtp;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Motels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'motel:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {

        $tasks = DB::table('users')
            ->select(['name', 'phone_number', 'email', "motels.room_number as room", 'motels.status', 'motels.price'])
            ->join('user_motel', 'users.id', '=', 'user_motel.user_id')
            ->join('motels', 'user_motel.motel_id', '=', 'motels.id')
            ->where('user_motel.status', 1)
            ->get();
        foreach ($tasks as $task) {
            Mail::to($task->email)->send(new motel_money($task));
        }
    }
}