<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class postController extends Controller
{
     public function index(){
        return 'Liste';
     }

     public function store(){

        $post = new Posts();

        $post->title = "titre exemple";
        $post->description = "Desc exemple";
        $post->save();
     }
}
