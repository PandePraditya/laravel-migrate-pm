<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*
        * (untuk pagination)
        * untuk menggunakan pagination bootstrap, definisikan 
        * Method paginator di provider AppServiceProvider
        */
        $categories = category::paginate(5);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        
        $name = $request->input('name');
        $description = $request->input('description');

        category::create([
            'name' => $name,
            'description' => $description
        ]);
        return redirect('category');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = category::find($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = category::find($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $name = $request->input('name');
        $description = $request->input('description');
        
        category::where('id', '=', $id)->update([
            'name' => $name,
            'description' => $description
        ]);
        
        return redirect("category");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        category::where('id', '=', $id)->delete();
        return redirect('category');
    }
}
