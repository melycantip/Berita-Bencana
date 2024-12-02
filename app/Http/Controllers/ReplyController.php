<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function store($comment_id, Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $id_user = Auth::id();

        $reply = new Reply;

        $reply->content = $request->input('content');
        $reply->user_id = $id_user;
        $reply->comment_id = $comment_id;

        $reply->save();

        return redirect()->back()->with('success', 'Reply berhasil Ditambahkan');
    }
}
