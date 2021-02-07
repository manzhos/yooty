<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DemandeController extends Controller
{
    public function index()
    {
        if(Auth::user()) {
            $message_create_id = DB::table('messages')->where('user_id', '=', Auth::user()->id)->pluck('id')->toArray();
            $message_assist_id = DB::table('message_user')->where('user_id', '=', Auth::user()->id)->pluck('message_id')->toArray();
            $message_ids = array_merge($message_create_id, $message_assist_id);

            $messages = Message::join('message_meta','messages.id','=','message_meta.message_id')->whereIn('messages.id', $message_ids)->where('message_meta.cost','!=',null)->orderby('message_meta.cost', 'desc')->orderby('messages.created_at', 'desc')->paginate(50);

            return view('demandes', compact('messages'));
        }else{
            return view('demandes');
        }

    }
}
