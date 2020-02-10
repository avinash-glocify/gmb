<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formula;
use App\Models\Files;
use Carbon\Carbon;


class FormulaController extends Controller
{

    public function index()
    {
        $formulas = Formula::paginate(20);
        return view('formulas.index', compact('formulas'));
    }

    public function create()
    {
        return view('formulas.create');
    }

    public function store(Request $request)
    {
        $rules = [
          'name' => 'required'
        ];

        $request->validate($rules);

        $data = [
          'name'        => $request->name,
          'description' => $request->description,
          'link'        => $request->link
        ];


         $formula = Formula::create($data);

         if($request->has('file')) {
           $path = $this->storeFile($request->file);
           $file = Files::create(['path' => $path, 'type' => 'formulas', 'refrence_id' => $formula->id]);
         }

         return redirect()->route('formulas.index')->with(['success' => 'Formula Added SuccessFully']);
    }

    public function show($id)
    {
        //
    }

    public function edit(Formula $formula)
    {
        return view('formulas.edit', compact('formula'));
    }

    public function update(Request $request, Formula $formula)
    {
        $rules = ['name' => 'required'];
        $request->validate($rules);

        $data = [
          'name'        => $request->name,
          'link'        => $request->link,
          'description' => $request->description,
        ];

        $formula->update($data);

        if($request->has('file')) {
          $path = $this->storeFile($request->file);
          $file = Files::create(['path' => $path, 'type' => 'formulas', 'refrence_id' => $formula->id]);
        }

        return redirect()->route('formulas.index')->with(['success' => 'Formula Updated SuccessFully']);
    }

    public function destroy($id)
    {
        $formula = Formula::findOrFail($id);
        $formula->delete();
        return response(['success' => 'Formula deleted successfully']);
    }
}
