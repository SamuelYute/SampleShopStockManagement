<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Resources\CommentResource;
use App\Item;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(Request $request, Item $item)
    {
        $this->validate($request,[
            'username' => 'required|max:20',
            'text' => 'required|string|max:150',
        ]);

        $comment = new Comment;
        $comment->username = $request->username;
        $comment->text = $request->text;

        $comment->item()->associate($item);

        $comment->save();

        if(\Illuminate\Support\Facades\Request::is('api*'))
        {
            return new CommentResource($comment);
        }
        else{
            return redirect()->back();
        }
    }

    public function update(Request $request, Comment $comment)
    {
        $this->validate($request,[
            'text' => 'required|string|max:150'
        ]);

        $comment->text = $request->text;

        $comment->save();

        if(\Illuminate\Support\Facades\Request::is('api*'))
        {
            return new CommentResource($comment);
        }
        else{
            return redirect()->back();
        }
    }

    public function destroy(Comment $comment)
    {
        return $comment->delete();
    }
}
