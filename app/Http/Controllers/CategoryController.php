<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

/**
 * CategoryController sınıfı, kategorilerle ilgili işlemleri yönetir.
 */
class CategoryController extends Controller
{
    /**
     * Tüm kategorileri getirir ve görüntüler.
     *
     * @return \Illuminate\View\View Kategorilerin listelendiği görünüm.
     */
    public function index()
    {
        $categories = Category::all();
        return view('back.categories.index', compact('categories'))->with('addPostSuccess', 'Kategori başarıyla oluşturuldu');
    }

    /**
     * Yeni bir kategori oluşturma formunu görüntüler.
     *
     * @return \Illuminate\View\View Kategori oluşturma formunun görüntülendiği görünüm.
     */
    public function create()
    {
        return view('back.categories.create');
    }

    public function show(Category $category)
    {
        return view('back.categories.show', compact('category'));
    }

    /**
     * Yeni bir kategori oluşturur.
     *
     * @param  \Illuminate\Http\Request  $request İstek nesnesi.
     * @return \Illuminate\Http\RedirectResponse Kategori oluşturulduktan sonra yönlendirme.
     */
    public function store(Request $request)
    {
        Category::create($request->post());
        return redirect()->route('categories.index')->with('message', 'Kategori başarıyla oluşturuldu');
    }

    /**
     * Belirtilen kategoriyi düzenleme formunu görüntüler.
     *
     * @param  \App\Models\Category  $category Kategori modeli.
     * @return \Illuminate\View\View Kategori düzenleme formunun görüntülendiği görünüm.
     */
    public function edit(Category $category)
    {
        return view('back.categories.edit', compact('category'));
    }

    /**
     * Belirtilen kategoriyi günceller.
     *
     * @param  \Illuminate\Http\Request  $request İstek nesnesi.
     * @param  \App\Models\Category  $category Kategori modeli.
     * @return \Illuminate\Http\RedirectResponse Kategori güncellendikten sonra yönlendirme.
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->post());
        return back()->with(['ok' => 'Kategori başarıyla güncellendi']);
    }

    /**
     * Belirtilen kategoriyi siler.
     *
     * @param  \App\Models\Category  $category Kategori modeli.
     * @return \Illuminate\Http\RedirectResponse Silme işleminden sonra yönlendirme.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back();
    }
}
