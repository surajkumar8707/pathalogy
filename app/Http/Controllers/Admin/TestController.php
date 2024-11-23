<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tests = Test::with(['category', 'subCategory'])->get();
        return view('admin.tests.index', compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('admin.tests.create', compact('categories', 'subCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'name' => 'required|string|max:255',
            'upper_value' => 'required|numeric',
            'percent' => 'nullable|numeric'
            // 'lower_value' => 'nullable|numeric',
        ]);

        Test::create($request->all());

        return redirect()->route('admin.tests.index')->with('success', 'Test created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        return view('admin.tests.show', compact('test'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test)
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('admin.tests.edit', compact('test', 'categories', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $test)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'name' => 'required|string|max:255',
            'upper_value' => 'required|numeric',
            'percent' => 'nullable|numeric'
            // 'lower_value' => 'nullable|numeric',
        ]);

        $test->update($request->all());

        return redirect()->route('admin.tests.index')->with('success', 'Test updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        $test->delete();
        return redirect()->route('admin.tests.index')->with('success', 'Test deleted successfully.');
    }
}
