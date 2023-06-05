<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        $response = [
            'status' => true,
            'posts' => $posts
        ];
        return view('posts.index', compact('posts', 'response'));
        //     return response()->json([
        //         'status' => true,
        //         'posts' => $post
        //     ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $post = Post::create($validated);

        if($post){
            $response = [
                'status' => true,
                'message' => 'Post Inserted Successfully',
                'posts' => $post
            ];
            return redirect()->route('posts.index')->with([
                'success' => 'Post Inserted Successfully',
                'response' => $response
            ]);
        }
        return redirect()->route('posts.add')->withErrors($validated);
        // return response()->json([
        //     'status' => true,
        //     'message' => 'Post Inserted Successfully',
        //     'post' => $post,
        // ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post = Post::find($post->id);
        if ($post) {
            return redirect()->route('posts.index')->with(['post' => $post]);
        }
        return redirect()->route('posts.index');
        // return response()->json([
        //     'status' => true,
        //     'post' => $post
        // ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post = Post::find($post->id);
        if($post){
            $post->update($request->all());
            if ($post) {
                return redirect()->route('posts.index')->with('success', 'Post Updated Successfully');
            }
            // return response()->json([
            //     'status' => true,
            //     'message' => 'Post Updated Successfully',
            //     'post' => $post
            // ]);
        }
        return redirect()->route('posts.add')->withErrors('Error Happen');
        // return response()->json([
        //     'status' => false,
        //     'message' => 'Sorry No Post Found With This Id',
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post = Post::find($post->id);
        if($post){
            $response = [
                'status' => true,
                'message' => 'Post Deleted Successfully',
            ];
            $post->delete();
            return redirect()->route('posts.index')->with('response', $response);
            // return response()->json([
            //     'status' => true,
            //     'message' => 'post deleted successfully',
            //     'post' => $post
            // ], 200);
        }
        return redirect()->route('posts.index')->withErrors('Error Happen');
        // return response()->json([
        //     'status' => false,
        //     'message' => 'no post found with this id'
        // ], 404);
    }
}
