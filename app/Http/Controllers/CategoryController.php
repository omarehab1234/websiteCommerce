<?php

namespace App\Http\Controllers;
use App\Models\Category;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
class CategoryController extends Controller
{
    function store(Request $req){
        $validated = $req->validate([
            'name'=>"required|min:3|max:50|unique:categories,name",
        ]);

        Category::create([
            'name'=> $validated["name"]
        ]);

        return redirect()->route("admin")
        ->with("success","category was created");
    }

    function showForm(){
        return view("category.create");
    }

    function show(){
        $categories = Category::all();

        return view('category.index',['categories' =>$categories]);
    }
    
    function edit(Category $category){

        return view("category.edit",["category"=>$category]);
    }

    function editCat(Request $req,Category $category){
        $validated = $req->validate([
            'name' => [
                'required',
                'min:3',
                'max:50',
                Rule::unique('categories', 'name')->ignore($category->id),
                ],
            ]);
        $category->update($validated);
            
        return redirect()->route('categories.index')
        ->with('success', 'Category updated successfully.');

    }
    function destroy(Category $category){
        try {
            $category->delete();

            return redirect()->route('categories.index')
                ->with('success', 'Category deleted successfully.');
        } catch (QueryException $e) {
            return redirect()->route('categories.index')
                ->with('error', 'You cannot delete this category because it still contains products.');
        }
        return redirect()->route('categories.index')
        ->with('success', 'Category deleted successfully.');

    }

    
}
