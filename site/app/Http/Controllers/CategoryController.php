<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){

        $categories = Category::all();

        return view('category.index', compact('categories'));
    }

    public function create() {
        return view('category.create');
    }

    public function store(Request $request, Category $category) {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name|max:250'
        ]);

//        Category::create($request->all());

//        return redirect()->action([CategoryController::class, 'index'])->
//        with('message','Вашу категорію було додано до бази даних');

        if(!$category->create($request->all()))
        {
            $err=$category->getErrors();
            return redirect()->action([CategoryController::class, 'index'])->with('errors',$err)->withInput();
        }
        return redirect()->route('category.index')->with('message','Вашу категорію було успішно створено');
    }

    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }

    public function edit(Category $category) {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {

        $request->validate([
            'category_name' => 'required|unique:categories,category_name|max:250'
        ]);

        if(!$category->update($request->all()))
        {
            $err=$category->getErrors();
            return redirect()->action([CategoryController::class, 'edit'])->with('errors',$err)->withInput();
        }
        return redirect()->route('category.index')->with('message','Вашу категорію було змінено');
    }

    public function destroy(Category $category) {
        $category->delete();

        return redirect()->route('category.index')->with('message','Категорію видалено успішно!');

    }

}
