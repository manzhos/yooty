<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CommentController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */

    public function index(Comment $message)
    {
/*
        $comments = $message->comments()->parent()->with('replies')->get();

        return response()->json($comments);
*/
    }

    public function addComment(Request $request)//, Message $message
    {
        $message = Message::find($request->message_id);

        //validate
/*        $this->validate($request,[
            'body'=>'required',
        ]);*/

        if($request->has('file') or $request->body != null) {
            $comment = $message->comments()->create([
                'message_id' => $request->message_id,
                'body' => $request->body,
                'user_id' => Auth::user()->id,
            ]);
        }

        //store images and files for comment
        $files = $request->file('file');

        if($files)
        {
            foreach ($files as $file)
            {
                $filename = 'yooty_' . time() . '_' . $file->getClientOriginalName();

                $img = Image::make($file);
                // resize the image so that the largest side fits within the limit; the smaller
                // side will be scaled to maintain the original aspect ratio
                $img->resize(2400, 2400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $img->save( public_path('/storage/uploads/' . $filename));

                $media = $comment->media()->create([
                    'comment_id' => $request->comment_id,
                    'file_name' => $filename,
                ]);
            }

        }

        event(new \App\Events\NewMessage(''));

        //return back()->withMessage('Réponse créer');
    }


    public function editComment(Request $request)
    {
        $comment = Comment::find($request->comment_id);

        $this->validate($request,[
            'body' => 'required'
        ]);

        $comment->update([
            'body' => $request->body,
        ]);

        return back()->withMessage('Réponse modifiée');
    }


    public function delComment(Request $request)
    {
        Comment::find($request->comment_id)->delete();

        event(new \App\Events\NewMessage(''));

        return back()->with('message','Commentaire supprimé');
    }


    public function getComments(Request $request)
    {
        $comments = Message::find($request->id)->comments;

        return response()->json($comments);
    }

    public function getImages()
    {
        $images = DB::table('media_comments')->get();

        return response()->json($images);
    }


}
