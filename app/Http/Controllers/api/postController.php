<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Http\Request;
use App\Models\Posts;

class postController extends Controller
{
    public function index()
    {
        return 'Liste';
    }

    public function store(CreatePostRequest $request)
    {

        $post = new Posts();
        $post->title = "titre exemple";
        $post->description = "Desc exemple";
        $post->save();
    }
}
