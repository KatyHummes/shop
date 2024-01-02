<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(Request $request, $id)
    {
        // dd($request->all(), $id);
        $photoName = $request->file('photo')->getClientOriginalName();
        $photoPath = $request->file('photo')->store('public/photos');

        // Remova a parte 'public/' do caminho antes de salvar no banco de dados
        $photoPathForDatabase = str_replace('public/', '', $photoPath);
        Product::create([
            'store_id' => $id,
            'name' => $request->input('name'),
            'photo_name' => $photoName,
            'photo_path' => $photoPathForDatabase
        ]);

        return redirect()->back()->with('success', 'Produto criado com sucesso.');
    }
}
