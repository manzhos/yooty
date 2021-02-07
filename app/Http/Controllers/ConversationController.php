<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class ConversationController extends Controller
{
    public function messagelist(Request $request, Message $message)
    {
        if(Auth::user()) {
            $user = Auth::user();
            $list = DB::select('select message_id from message_user where user_id = :id and assistant = 1', ['id' => $user->id]); // get a message id's where user select as assistant
            $m_ids = Arr::pluck($list, 'message_id'); // get only id (clear array from keys 'message_id:', leave only values of id)

            $messages = Message::whereIn('id', $m_ids)      //select messages where the user is assistance
            ->orWhere('user_id', $user->id)                 //select messages where the user is author
            ->paginate(50);

            if ($request->has('selected_message')) {
                $selected_message = $request->selected_message;
            } else {
                $selected_message = 'null';
            }

            $coach_pairs = Coach::where('coach_ready', 'yes')->get();    //select all pair user-coach where coach answer 'yes'
            //$messages = Message::where('subject', 'like', '%g%')->paginate();

            return view('messages', compact('messages', 'selected_message', 'coach_pairs'));
        }else{
            $messages = Message::all();
            return view('messages');
        }

    }


    public function searchconversation(Request $request, Message $message)
    {
        //dd('%'.$request->search.'%');
        if(Auth::user()) {
            $user = Auth::user();
            $list = DB::select('select message_id from message_user where user_id = :id and assistant = 1', ['id' => $user->id]); // get a message id's where user select as assistant
            $m_ids = Arr::pluck($list, 'message_id'); // get only id (clear array from keys 'message_id:', leave only values of id)

            $messages = Message::whereIn('id', $m_ids)            //select messages where the user is assistance
            ->orWhere('user_id', $user->id)                       //select messages where the user is author
            ->where('subject', 'like', '%'.$request->search.'%')  //select messages where the subject contain the search string
            ->paginate(50);

            if ($request->has('selected_message')) {
                $selected_message = $request->selected_message;
            } else {
                $selected_message = 'null';
            }

            $coach_pairs = Coach::where('coach_ready', 'yes')->get();    //select all pair user-coach where coach answer 'yes'
            //$messages = Message::where('subject', 'like', '%g%')->paginate();

            return view('messages', compact('messages', 'selected_message', 'coach_pairs'));
        }else{
            $messages = Message::all();
            return view('messages');
        }

    }


    public function closechat(Request $request)
    {
        DB::table('message_meta')->where('message_id', '=', $request->id)->update([
            'terminate' => 1,
        ]);

        return back();
    }

    public function conversation(Request $request, Message $message)
    {
        if(Auth::user()) {
            $user = Auth::user();
            $list = DB::select('select message_id from message_user where user_id = :id and assistant = 1', ['id' => $user->id]); // get a message id's where user select as assistant
            $m_ids = Arr::pluck($list, 'message_id'); // get only id (clear array from keys 'message_id:', leave only values of id)

            $messages = Message::whereIn('id', $m_ids)      //select messages where the user is assistance
            ->orWhere('user_id', $user->id)                 //select messages where the user is author
            ->paginate(50);

            if ($request->has('selected_message')) {
                $selected_message = $request->selected_message;
            } else {
                $selected_message = 'null';
            }

            $coach_pairs = Coach::where('coach_ready', 'yes')->get();    //select all pair user-coach where coach answer 'yes'

            return view('conversation', compact('messages', 'selected_message', 'coach_pairs'));
        }else{
            return view('conversation');
        }
    }

}
