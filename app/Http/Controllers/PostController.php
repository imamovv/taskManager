<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $post = new Post([
            'user_id' => auth()->id(),
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);

        $post->save();

        return response()->json($post, Response::HTTP_CREATED);
    }

    public function show(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], Response::HTTP_FORBIDDEN);
        }

        return response()->json($post, Response::HTTP_OK);
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], Response::HTTP_FORBIDDEN);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);

        return response()->json($post, Response::HTTP_OK);
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], Response::HTTP_FORBIDDEN);
        }

        $post->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}