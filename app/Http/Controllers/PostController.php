<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

/**
 * PostController sınıfı, kullanıcıların gönderileriyle ilgili işlemleri yönetir.
 */
class PostController extends Controller
{
    /**
     * PostController sınıfının yapıcı yöntemi.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('authResource:post')->except('index', 'create', 'store');
    }

    /**
     * Kullanıcının tüm gönderilerini listeler.
     *
     * @return \Illuminate\View\View Kullanıcının gönderilerinin listelendiği görünüm.
     */
    public function index(Request $request)
    {
        $posts = auth()->user()->posts;
        return view('back.posts.index', compact('posts'));
    }

    /**
     * Yeni bir gönderi oluşturma formunu görüntüler.
     *
     * @return \Illuminate\View\View Gönderi oluşturma formunun görüntülendiği görünüm.
     */
    public function create()
    {
        $categories = Post::all();
        return view('back.posts.create', compact('categories'));
    }

    /**
     * Yeni bir gönderi oluşturur.
     *
     * @param  \Illuminate\Http\Request  $request İstek nesnesi.
     * @return \Illuminate\Http\RedirectResponse Gönderi oluşturulduktan sonra yönlendirme.
     */
    public function store(Request $request)
    {       
        if ($request->has('image')) {
            $this->uploadImage($request);
        }
        $request->user()->posts()->create($request->post());

        return redirect()->route('posts.index')->with('message', 'Gönderi başarıyla oluşturuldu');
    }

    /**
     * Belirtilen gönderiyi görüntüler.
     *
     * @param  int  $id Gönderi kimliği.
     * @return \Illuminate\View\View Gönderi görüntüleme görünümü.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('front.posts.show', compact('post'));
    }

    /**
     * Belirtilen gönderiyi düzenleme formunu görüntüler.
     *
     * @param  \App\Models\Post  $post Gönderi modeli.
     * @return \Illuminate\View\View Gönderi düzenleme formunun görüntülendiği görünüm.
     */
    public function edit(Post $post)
    {
        $post = Post::findOrFail($post->id);
        $categories = Category::all();
        return view('back.posts.edit', compact('post', 'categories'));
    }

    /**
     * Belirtilen gönderiyi günceller.
     *
     * @param  \Illuminate\Http\Request  $request İstek nesnesi.
     * @param  \App\Models\Post  $post Gönderi modeli.
     * @return \Illuminate\Http\RedirectResponse Gönderi güncellendikten sonra yönlendirme.
     */
    public function update(Request $request, Post $post)
    {
        if ($request->has('image')) 
        {
            $oldImage = $post->image;
            $this->uploadImage($request);
            if (file_exists(public_path('images/' . $oldImage))) 
            {
                unlink(public_path('images/' . $oldImage));
            }
            $post->image = $request->post()['image'];
        }
        $post->title    = $request->title;
        $post->excerpt  = $request->excerpt;
        $post->body     = $request->body;
        $post->save();

        return back()->with('message', 'Gönderi başarıyla güncellendi');
    }

    /**
     * Belirtilen gönderiyi siler.
     *
     * @param  \App\Models\Post  $post Gönderi modeli.
     * @return \Illuminate\Http\RedirectResponse Gönderi silindikten sonra yönlendirme.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }

    /**
     * Gönderi için resim yükler.
     *
     * @param  \Illuminate\Http\Request  $request İstek nesnesi.
     * @return void
     */
    public function uploadImage($request)
    {
        $image = $request->file('image');
        $imageName = time() . $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        $request->merge(['image' => $imageName]);
    }
}
