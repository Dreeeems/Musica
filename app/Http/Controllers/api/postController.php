<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest;
use App\Models\Posts;
use Exception;
use Illuminate\Http\Request;

class postController extends Controller
{
    public function index(Request $request)
    {





        try {


            return response()->json([
                'status_code' => 200,
                'status_message' => 'Get all posts !',
                'data' => Posts::all()
            ]);
        } catch (Exception $e) {
            return response($e);
        }
    }

    public function store(CreatePostRequest $request)
    {
        try {

            $post = new Posts();

            $post->title = $request->title;
            $post->description = $request->description;

            $post->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Post added !',
                'data' => $post
            ]);
        } catch (Exception $e) {

            return response()->json($e);
        }
    }

    public function update(EditPostRequest $request, Posts $post)
    {

        try {

            $post->title = $request->title;
            $post->description = $request->description;
            $post->updated_at = time();

            $post->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'The post has been successfully updated.',
                'data' => $post
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function delete(Posts $post)
    {
        try {



            $post->delete();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'The post has been successfully delete.',
                'data' => $post
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
