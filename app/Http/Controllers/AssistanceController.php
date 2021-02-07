<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AssistanceController extends Controller
{
    public function apply($id)
    {
        $message = Message::find($id);
        $ids = $message->assistance()->where('user_id','=', Auth::user()->id)->get(); // check if the user has already applied
        //add in table message_user the record with data: message_id has var $message and user_id is the auth user
        if(count($ids) > 0){
            return redirect()->route('messages.show', $id)->withMessage('You already applied.');
        }else{
            $message->assistance()->attach( Auth::user()->id );
            return redirect()->route('messages.show', $id)->withMessage('You applied.');
        }
    }

    public function select(Message $message)
    {
        $users = $message->assistance()->get();
        return view('messages.selectassistant', compact('users', 'message'));
    }

    public function deleteassistance(Message $message)
    {
        // delete all assistance for message
        $message->assistance()->detach();
        $users = [];
        return view('messages.selectassistant', compact('users', 'message'));
    }

    public function noassistant(Request $request, Message $message)
    {
        // delete selected assistance for message
        $message->assistance()->detach($request->user);
        $users = $message->assistance()->get();
        return view('messages.selectassistant', compact('users', 'message'));
    }

    public function yesassistant(Request $request, Message $message)
    {
        // mark the record as selected for assist
        DB::table('message_user')
            ->where('message_id', $message->id)
            ->where('user_id', $request->user)
            ->update(['assistant' => 1]);

        // delete all other candidates
        DB::table('message_user')
            ->where('message_id', $message->id)
            ->where('user_id','!=', $request->user)
            ->delete();

        $user = Auth::user();
        $list = DB::select('select message_id from message_user where user_id = :id and assistant = 1', ['id' => $user->id]); // get a message id's where user select as assistant
        $m_ids = Arr::pluck($list,'message_id'); // get only id (clear array from keys 'message_id:', leave only values of id)

        $messages = Message::whereIn('id', $m_ids)                          //select messages where the user is assistance
                            ->orWhere('user_id', $user->id)                 //select messages where the user is author
                            ->get();

        $selected_message = $message->id;

        $coach_pairs = Coach::where('coach_ready','yes')->get();    //select all pair user-coach where coach answer 'yes'

        return redirect()->route('messagelist-conv', compact('messages', 'selected_message', 'coach_pairs'));
    }
}
