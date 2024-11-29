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

    public function generateReport(int $report_id)
    {
        try {
            $report = Report::findOrFail($report_id);
            if ($report) {
                $category = $report->category;
                // dd(
                //     $report->toArray(),
                //     $category->toArray(),
                // );
                return view('admin.report.generate_report', compact('report'));
            } else {
                return redirect()->back()->with('error', 'Report not found with id ' . $report_id);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Report not found with id ' . $report_id);
            // return returnWebJsonResponse($e->getMessage());
        }
    }

    // public function saveSingleTest(Request $request)
    // {
    //     try {
    //         $validated = $request->validate([
    //             'test_id' => 'required|exists:tests,id',
    //             'report_id' => 'nullable|exists:reports,id',
    //         ]);

    //         $where = [
    //             'report_id' => $validated['report_id'],
    //             'test_id' => $validated['test_id'],
    //         ];
    //         $report_test = DB::table('report_test')->where($where)->first();
    //         if ($report_test) {
    //             $report_test = DB::table('report_test')->create($where);
    //             return returnWebJsonResponse('Test Add in Report', 'success', $report_test);
    //         } else {
    //             return returnWebJsonResponse('This record is already in the Report', 'error', $report_test);
    //         }

    //         return $validated;
    //     } catch (\Exception $e) {
    //         // return redirect()->back()->with('error', 'Report not found with id ' . $report_id);
    //         return returnWebJsonResponse($e->getMessage());
    //     }
    // }

    public function saveSingleTest(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'test_id' => 'required|exists:tests,id',
                'report_id' => 'nullable|exists:reports,id',
            ]);

            // Prepare where conditions for checking the existing record
            $where = [
                'report_id' => $validated['report_id'],
                'test_id' => $validated['test_id'],
            ];

            // Check if the record already exists in the 'report_test' table
            $existingRecord = DB::table('report_test')->where($where)->first();

            if ($existingRecord) {
                // If the record exists, return an error response
                return returnWebJsonResponse('This record is already in the Report', 'error', $existingRecord);
            } else {
                // If the record does not exist, create a new one
                DB::table('report_test')->insert($where);

                $report_test = DB::table('report_test')->where($where)->first();

                // Fetch the newly inserted record
                $newRecord = Test::find($validated['test_id']);
                $newRecord['report_test'] = $report_test;

                // Return a success response with a message
                return returnWebJsonResponse('Test added to Report', 'success', $newRecord);
            }
        } catch (\Exception $e) {

            // Return a JSON response with the error message
            return returnWebJsonResponse($e->getMessage());
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
            if ($report) {
                $category = $report->category;
                $subCategory = $report->subCategory;
                $tests = Test::where([
                    'category_id' => $category->id,
                    'sub_category_id' => $category->id,
                ])->get();
                $report_tests = $report->tests->pluck('id')->toArray();
                // dd(
                //     $report->toArray(),
                //     $category->toArray(),
                //     $tests->toArray(),
                //     $report_tests,
                // );
                return view(
                    'admin.report.view_report',
                    compact(
                        'report',
                        'category',
                        'subCategory',
                        'tests',
                        'report_tests',
                    )
                );
            } else {
                return redirect()->back()->with('error', 'Report not found with id ' . $report_id);
            }
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
