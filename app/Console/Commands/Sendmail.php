<?php

namespace App\Console\Commands;

use App\Mail\AccountInformation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Collection;
use DB;

class Sendmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending Account Information Email';

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
        $this->info("Start Sending Emails");
        $accounts = DB::table('user_data')
            ->join('groups', 'user_data.group_id', '=', 'groups.group_id')
            ->get();

        foreach($accounts as $account) {

            $members = DB::table('user_data')
                ->where('group_id', $account->group_id)
                ->get();

            $user = collect([
                ['name' => $account->student_name, 'email' => $account->student_email]
            ]);

            Mail::to($user)->send(new AccountInformation($account, $members));
            $this->info('...');
            sleep(10);
        }
        $this->info("Finish");
    }
}
