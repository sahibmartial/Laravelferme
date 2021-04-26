<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Http\Controllers\MailController;
class DailyQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Respectively send an exclusive quote to everyone daily via email.';

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
        $quotes = [
            'Mahatma Gandhi' => 'Live as if you were to die tomorrow. Learn as if you were to live forever.',
            'Friedrich Nietzsche' => 'That which does not kill us makes us stronger.',
            'Theodore Roosevelt' => 'Do what you can, with what you have, where you are.',
            'Oscar Wilde' => 'Be yourself; everyone else is already taken.',
            'William Shakespeare' => 'This above all: to thine own self be true.',
            'Napoleon Hill' => 'If you cannot do great things, do small things in a great way.',
            'Milton Berle' => 'If opportunity doesn’t knock, build a door.',
            'Martial Konan' => "Ce qui n'est pas ecrit ne s'impose pas.",
            'Martial Konan'=>"Si tu veux etre aidé, il faut être impliqué",
            'Duo Parfait'=>" dign"
        ];
        // Setting up a random word
        $key = array_rand($quotes);
        $data = $quotes[$key];

        $users = User::all();
       // $to_email=auth()->user();
        $mail= new MailController;
        $subject="Daily New Quote!";
        $content=$data;

        foreach ($users as $key => $user) {
           
          //  dump($user['email']);
            $mail->send($user['email'],$user['name'],$subject,$content);

        }
       
         
        $this->info('Successfully sent daily quote to everyone.');

        //return 0;
    }
}
