<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Category;

Route::get('/posts',function(){
    $posts = Post::all();
    return response()->json([
        'posts' => $posts
    ]);
});

Route::get('/categories',function(){
    $categories = Category::all();
    return response()->json([
        'categories' => $categories
    ]);
});