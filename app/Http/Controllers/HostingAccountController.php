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

        foreach($accounts as $account){
            $user = collect([
                ['name' => $account->name, 'email' => $account->email]
            ]);
            var_dump($account);
            exit();
        }

        Mail::to($user)->send(new AccountInformation());
    }
}
