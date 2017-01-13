<?php

namespace App\Http\Controllers;

use App\Mail\AccountInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Collection;

class HostingAccountController extends Controller
{
    public function sendAccountInfo(Request $request){

        $user = collect([
            ['name' => 'Natthasak', 'email' => 've.natthasak_st@tni.ac.th']
        ]);

        Mail::to($user)->send(new AccountInformation());
    }
}
