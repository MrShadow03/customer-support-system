<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    public function broadcast(Request $request){
        broadcast(new PusherBroadcast("Here's a test message"))->toOthers();
        return response()->json(['message'=> 'message successfully broadcasted'],200);
    }
}
