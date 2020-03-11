<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::paginate(20);
        return view('client.index', compact('clients'));
    }

    public function create()
    {
        return view('client.create');
    }

    public function store(Request $request)
    {
        $rules = ['name' => 'required'];
        $request->validate($rules);

        $client = Client::create([
          'name'        => $request->name,
          'description' => $request->description,
        ]);

        return redirect()->route('client.index')->with(['success' => 'Client Added SuccessFully']);

    }

    public function show(Client $client)
    {
        return view('client.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('client.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $rules = ['name' => 'required'];
        $request->validate($rules);

        $client->update([
          'name'        => $request->name,
          'description' => $request->description,
        ]);

        return redirect()->route('client.index')->with(['success' => 'Client Updated SuccessFully']);

    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return response(['success' => 'Client deleted successfully']);
    }
}
