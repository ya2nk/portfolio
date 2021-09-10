<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class CommentController extends Controller
{
    public function index()
    {
        $comment = Comment::all();

        return view('admin.comment.index', compact('comment'));
    }

    public function show($id)
    {
        $decrypt = Crypt::decryptString($id);
        $comment = Comment::find($decrypt);

        return response()->json($comment);
    }
}
