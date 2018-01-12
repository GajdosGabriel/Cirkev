<?php

namespace App\Console\Commands;


use App\Post;
use App\User;
use Illuminate\Console\Command;

class CommentUserReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CommentUserReport';

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
     * @return mixed
     */
    public function handle()
    {
        $posts = Post::reportComments()->get();

        if($posts->count() >= 1) {

            $users = User::whereSend_email(1)->get();

            foreach($users as $user) {

                \Mail::send ('emails.commentRepost',
                    $data = array(
                        'posts' => $posts,
                        'userEmail' => $user->email,
                    ), function($message) use($data)
                    {
                        $message->from('admin@cirkevonline.sk', 'Cirkev-Online - Informuje');
                        $message->to($data['userEmail'])
                            ->subject('Týždenný súhrn komentárov');
                    });
            }
        }
    }
}
