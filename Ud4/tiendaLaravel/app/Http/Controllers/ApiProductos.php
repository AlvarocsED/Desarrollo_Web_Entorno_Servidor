<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiProductos extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos= Productos::all();
        return  $productos;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $producto= new Productos();
        $producto->nombre=$request->nommbre;
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto=Productos::find();
        return $producto;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
}