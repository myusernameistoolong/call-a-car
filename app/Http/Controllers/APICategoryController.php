<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class APICategoryController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store(Request $request)
    {
        Category::create($request->all());
        return response()->json("Category " . $request->name . " has been created successfully.", 201);
    }

    public static function getAll()
    {
        return $categories = Category::orderBy("price_per_km")->get();
    }

    public static function show($id)
    {
        return $category = Category::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());

        return response()->json( "Category " . $request->name . " has been successfully updated.", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json("Category " . $category->name . " has been successfully updated.", 202);
    }
}
