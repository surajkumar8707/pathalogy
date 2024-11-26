<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Report;
use App\Models\SubCategory;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $tests = Test::all();
        $reports = Report::all();
        return view('admin.report.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $tests = Test::all();
        return view('admin.report.create', compact('categories', 'subCategories', 'tests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    public function generateReport(Request $request)
    {
        // dd($request->all());
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'refer_by_doctor' => 'required|string|max:255',
            'category' => 'required|integer|exists:categories,id',
            'sub_category' => 'required|integer|exists:sub_categories,id',
            'test' => 'required|array', // test should be an array of selected tests
            'test.*' => 'integer|exists:tests,id' // each test should exist in the tests table
        ]);
        try {
            // Create a new report
            $report = Report::create([
                'category_id' => $request->category,
                'sub_category_id' => $request->sub_category,
                'name' => $request->name,
                'age' => $request->age,
                'refer_by_doctor' => $request->refer_by_doctor
            ]);

            // Attach the selected tests to the report
            $report->tests()->attach($request->test);

            return redirect()->route('admin.report.view.report', $report->id);
            // return $report;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function fetchSubcategory(Request $request)
    {
        try {
            $subCategory = SubCategory::where('category_id', $request->category_id)->get();
            return returnWebJsonResponse("Subcategory list", 'success', $subCategory);
        } catch (\Exception $e) {
            return returnWebJsonResponse($e->getMessage());
        }
    }

    public function fetchTest(Request $request)
    {
        try {
            $tests = Test::where('sub_category_id', $request->sub_category_id)->get();
            return returnWebJsonResponse("Test list", 'success', $tests);
        } catch (\Exception $e) {
            return returnWebJsonResponse($e->getMessage());
        }
    }

    public function viewReport($report_id)
    {
        try {
            $report = Report::findOrFail($report_id);
            // dd(
            //     $report->toArray(),
            //     $report->tests->toArray(),
            // );
            return view('admin.report.view_report', compact('report'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Report not found with id ' . $report_id);
            // return returnWebJsonResponse($e->getMessage());
        }
    }

    public function updateLowerValue(Request $request)
    {
        $validated = $request->validate([
            'report_test' => 'required|exists:report_test,id',
            'lower_value' => 'nullable|numeric',
        ]);

        // return $request->all();

        try {
            // Find the pivot record and update
            DB::table('report_test')
                ->where('id', $validated['report_test'])
                ->update(['lower_value' => $validated['lower_value']]);
            $report_test = DB::table('report_test')->where('id', $validated['report_test'])->first();
            return returnWebJsonResponse('Lower value updated successfully.', 'success', $report_test);
            // return response()->json(['success' => true, 'message' => 'Lower value updated successfully.']);
        } catch (\Exception $e) {
            return returnWebJsonResponse($e->getMessage());
        }
    }
}
