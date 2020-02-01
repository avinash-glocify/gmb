<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BussinessType;
use Auth;
class BussinessController extends Controller
{

  public function index()
  {
      $user  = Auth::user();

      if(!$user->isAdmin()) {
        return redirect()->route('dashboard');
      }
      $categories = BussinessType::orderBy('id', 'desc')->paginate(20);
      return view('bussiness.index', compact('categories'));
  }

  public function create()
  {
      $user  = Auth::user();

      if(!$user->isAdmin()) {
        return redirect()->route('dashboard');
      }
      return view('bussiness.create');
  }

  public function store(Request $request)
  {
      $rules = [
        'name' => 'required|min:3|unique:bussiness_types'
      ];

      $request->validate($rules);

      BussinessType::create(['name' => $request->name]);
      return redirect()->route('bussiness-index')->with(['success' => 'Bussiness Type Added Successfully']);
  }

  public function delete($id)
  {
      $user  = Auth::user();

      if(!$user->isAdmin()) {
        return redirect()->route('dashboard');
      }
      $bussinesType = BussinessType::findOrFail($id);

      $bussinesType->delete();
      return response(['success' => 'Bussiness Type deleted successfully']);
  }
}
