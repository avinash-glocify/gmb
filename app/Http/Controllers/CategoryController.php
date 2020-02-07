<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;

class CategoryController extends Controller
{

  public function index()
  {
      $user  = Auth::user();

      if(!$user->isAdmin()) {
        return redirect()->route('dashboard');
      }
      $categories = Category::orderBy('id', 'desc')->paginate(20);
      return view('category.index', compact('categories'));
  }

  public function create()
  {
      $user  = Auth::user();

      if(!$user->isAdmin()) {
        return redirect()->route('dashboard');
      }
      return view('category.create');
  }

  public function store(Request $request)
  {
      $rules = [
        'name' => 'required|min:3|unique:categories'
      ];

      $request->validate($rules);
      Category::create(['name' => $request->name]);

      return redirect()->route('category.index')->with(['success' => 'Category Added Successfully']);

  }

  public function delete(Request $request, $id)
  {
      $user  = Auth::user();

      if(!$user->isAdmin()) {
        return redirect()->route('dashboard');
      }
      $category = Category::findOrFail($id);
      $category->delete();

      return response(['success' => 'Category deleted successfully']);

  }
}
