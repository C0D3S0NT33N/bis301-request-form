<?php

namespace App\Http\Controllers;

use App\Mail\AccountInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Collection;
use DB;

class HostingAccountController extends Controller
{

    public function sendAccountInfo(Request $request){

        $accounts = DB::table('user_data')
                      ->join('groups', 'user_data.group_id', '=', 'groups.group_id')
                      ->get();

        $i=0;
        foreach($accounts as $account){

            $members = DB::table('user_data')
                         ->where('group_id', $account->group_id)
                         ->get();

            $user = collect([
                //['name' => $account->student_name, 'email' => $account->student_email]
                ['name' => $account->student_name, 'email' => 've.natthasak_st@tni.ac.th']
            ]);

            Mail::to($user)->send(new AccountInformation($account, $members));
            if($i++>=8) break;
            sleep(10);
        }
    }
}
