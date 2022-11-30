<?php

namespace App\Console\Commands;

use App\Mail\NotifyEmail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email notify for users every day';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        $users =User::where('id',1)->get();
        $users =User::where('id',1)->get();
        $users -> pluck('email')->toArray();

//        $users =User::pluck('email')->toArray();
        $data= ['title'=>'today lessons','body'=>'programing php'];
        foreach($users as $user){
            Mail::to($user)->send(new NotifyEmail($data));
        }
    }
}
