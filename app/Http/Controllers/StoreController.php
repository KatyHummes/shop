<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function create()
    {
        return view('create-store');
    }

    public function store(StoreRequest $request)
    {
        try {
            //se passar pelas validações
            $request->validate($this->rules());

            $photoName = $request->file('photo')->getClientOriginalName();
            $photoPath = $request->file('photo')->store('public/photos');
            $photoPathForDatabase = str_replace('public/', '', $photoPath);
            
            //vai tentar criar a loja
            Store::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'photo_name' => $photoName,
                'photo_path' => $photoPathForDatabase
            ]);

            //se conseguir criar vai retornar com sucesso
            return redirect()->back()->with('success', 'Loja criada com sucesso.');
        } catch (ValidationException $e) { 
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar a loja.');
        }
    }

    public function home($id)
    {
        $store = Store::findOrFail($id)->load('products');

        return view('store-home', compact('store'));
    }
}
