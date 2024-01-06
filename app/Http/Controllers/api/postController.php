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
            $post->user_id = auth()->user()->id;

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
            if ($post->user_id == auth()->user()->id) {
                $post->save();
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'The post has been successfully updated.',
                    'data' => $post
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'NAN',
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function delete(Posts $post)
    {
        try {


            if ($post->user_id == auth()->user()->id) {
                $post->delete();
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'The post has been successfully delete.',
                    'data' => $post
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'NAN',
                    'data' => $post
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
