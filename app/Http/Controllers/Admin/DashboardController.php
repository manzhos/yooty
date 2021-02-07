<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use App\Models\Comment;
use App\Models\Message;
use App\Models\Role;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\Meta;
use App\Models\Userprof;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //Dashboard
    public function dashboard()
    {
        $current_user = Auth::user();

        if($current_user->role->role === 'admin'){
            //Set the "user page" as default
            $users = User::orderBy('name')->orderBy('surname')->paginate(25);

            return view('admin.users', compact('users'));
        }else{
            //You are not administrator
            return view('admin.dashboard')->with('error-message', 'You are not administrator');
        }

    }

    //Users
    public function users()
    {
        $users = User::orderBy('name')->orderBy('surname')->paginate(50);

        return view('admin.users', compact('users'));
    }

    public function delusers(Request $request)
    {
        User::find('user_id', '=', $request->user_id)->delete();
        Usermeta::find('user_id', '=', $request->user_id)->delete();
        Userprof::find('user_id', '=', $request->user_id)->delete();

        $users = User::orderBy('name')->orderBy('surname')->paginate(50);

        return redirect()->route('admin.users', compact('users'));
    }

    public function clearDB()
    {
        $users_id = User::all()->pluck('id');

        Coach::whereNotIn('student_id', $users_id)->orWhereNotIn('student_id', $users_id)->delete();
        DB::table('message_user')->whereNotIn('user_id', $users_id)->delete();
        Role::whereNotIn('user_id', $users_id)->delete();
        Usermeta::whereNotIn('user_id', $users_id)->delete();
        Userprof::whereNotIn('user_id', $users_id)->delete();

        $users = User::orderBy('name')->orderBy('surname')->paginate(50);

        return redirect()->route('admin.users', compact('users'))->with('message', 'All junk records deleted');
    }


    public function setroleuser(Request $request)
    {
        User::find($request->user_id)->role->update([
            'role' => 'user'
        ]);

        return back()->with('message', 'User role set to "User"');
    }


    public function setroleadmin(Request $request)
    {
        User::find($request->user_id)->role->update([
            'role' => 'admin'
        ]);

        return back()->with('message', 'User role set to "Admin"');
    }


    public function blockuser(Request $request)
    {
        User::find($request->user_id)->role->update([
            'blocked' => true
        ]);

        return back()->with('message', 'User is blocked');
    }


    public function unblockuser(Request $request)
    {
        User::find($request->user_id)->role->update([
            'blocked' => false
        ]);

        return back()->with('message', 'User is unblocked');
    }


    //Messages

    public function chatmessages()
    {
        $messages = Message::orderBy('subject')->paginate(50);

        return view('admin.chatmessages', compact('messages'));
    }


    //Comments

    public function chatcomments()
    {
        $comments = Comment::orderBy('body')->paginate(50);

        return view('admin.chatcomments', compact('comments'));
    }


    //Conversation

    public function adminconversations(Request $request, Message $message)
    {
        /*
            $user = Auth::user();
            $list = DB::select('select message_id from message_user where user_id = :id and assistant = 1', ['id' => $user->id]); // get a message id's where user select as assistant
            $m_ids = Arr::pluck($list, 'message_id'); // get only id (clear array from keys 'message_id:', leave only values of id)

            $messages = Message::whereIn('id', $m_ids)      //select messages where the user is assistance
            ->orWhere('user_id', $user->id)                 //select messages where the user is author
            ->paginate(50);



            $coach_pairs = Coach::where('coach_ready', 'yes')->get();    //select all pair user-coach where coach answer 'yes'
            //$messages = Message::where('subject', 'like', '%g%')->paginate();

            return view('admin/admin-conversation', compact('messages'));
        */

        if ($request->has('selected_message')) {
            $selected_message = $request->selected_message;
        } else {
            $selected_message = 'null';
        }

        $messages = Message::all();

        return view('admin/admin-conversation', compact('messages', 'selected_message'));

    }

}
