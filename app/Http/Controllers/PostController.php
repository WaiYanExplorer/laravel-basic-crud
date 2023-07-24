<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function addPost(Request $request) {
        $post = new Post();
        $post->header = $request->header;
        $post->description = $request->input('description');

        $post->save();

        return back()->with([
            'successMessage' => $request->header.' has been added successfully.',
        ]);
    }

    public function deletePost($id) {
        $post = Post::find($id);
        $post->delete();

        return back()->with([
            'successMessage' => 'A post record has been deleted successfully.',
        ]);
    }
}
