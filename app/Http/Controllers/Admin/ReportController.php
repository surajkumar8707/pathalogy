<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Report;
use App\Models\ReportSetting;
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
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'age' => 'required|integer',
    //         'refer_by_doctor' => 'required|string|max:255',
    //         'category' => 'required|integer|exists:categories,id',
    //         'sub_category' => 'required|integer|exists:sub_categories,id',
    //         'test' => 'required|array', // test should be an array of selected tests
    //         'test.*' => 'integer|exists:tests,id' // each test should exist in the tests table
    //     ]);
    //     try {
    //         // Create a new report
    //         $report = Report::create([
    //             'category_id' => $request->category,
    //             'sub_category_id' => $request->sub_category,
    //             'name' => $request->name,
    //             'age' => $request->age,
    //             'refer_by_doctor' => $request->refer_by_doctor
    //         ]);

    //         // Attach the selected tests to the report
    //         $report->tests()->attach($request->test);

    //         return redirect()->route('admin.report.view.report', $report->id);
    //         // return $report;
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', $e->getMessage());
    //     }
    // }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'refer_by_doctor' => 'required|string|max:255',
            'category' => 'required|integer|exists:categories,id',
            'sub_category' => 'required|integer|exists:sub_categories,id',
            'test' => 'required|array',
            'test.*' => 'integer|exists:tests,id'
        ]);

        try {
            // Create the report
            $report = Report::create([
                'category_id' => $request->category,
                'sub_category_id' => $request->sub_category,
                'name' => $request->name,
                'age' => $request->age,
                'refer_by_doctor' => $request->refer_by_doctor
            ]);

            // Attach tests to the report, with additional category_id and sub_category_id
            foreach ($request->test as $test_id) {
                $test = Test::findOrFail($test_id);

                // Insert into the 'report_test' table
                DB::table('report_test')->insert([
                    'report_id' => $report->id,
                    'test_id' => $test->id,
                    'category_id' => $report->category_id,  // Report's category_id
                    'sub_category_id' => $test->sub_category_id, // Test's sub_category_id
                ]);
            }

            return redirect()->route('admin.report.view.report', $report->id);
        } catch (\Exception $e) {
            dd($e->getMessage());
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
    public function destroy(Report $report)
    {
        try {
            if ($report) {
                $report->delete();
                return redirect()->route('admin.report.index')->with('success', 'Report deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'Report not found with id ' . $report->id);
            }
        } catch (\Exception $e) {
            // return redirect()->back()->with('error', 'Report not found with id ' . $report_id);
            return redirect()->back()->with('error', $e->getMessage());
        }
        // $subCategory->delete();
        // return redirect()->route('admin.sub-categories.index')->with('success', 'SubCategory deleted successfully.');
    }

    // public function generateReport(int $report_id)
    // {
    //     try {
    //         $report = Report::findOrFail($report_id);
    //         if ($report) {
    //             $category = $report->category;
    //             dd(
    //                 $report->toArray(),
    //                 $category->toArray(),
    //             );
    //             return view('admin.report.generate_report', compact('report'));
    //         } else {
    //             return redirect()->back()->with('error', 'Report not found with id ' . $report_id);
    //         }
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Report not found with id ' . $report_id);
    //         // return returnWebJsonResponse($e->getMessage());
    //     }
    // }
    // public function generateReport(int $report_id)
    // {
    //     try {
    //         // Fetch the report by its ID with its related category and sub-category
    //         $report = Report::with('category', 'subCategory')->findOrFail($report_id);

    //         // Fetch all sub-categories for the report's category
    //         $subCategories = SubCategory::where('category_id', $report->category_id)->get();
    //         // dd($report->toArray(), $subCategories->toArray());

    //         // Initialize an array to hold the sub-categories with their respective tests
    //         $subCategoryData = [];

    //         // Loop through each sub-category and fetch the related tests
    //         foreach ($subCategories as $subCategory) {
    //             // Fetch all tests for the current sub-category
    //             $tests = Test::where('sub_category_id', $subCategory->id)->get();

    //             // Add the sub-category data to the array, including the tests
    //             $subCategoryData[] = [
    //                 'id' => $subCategory->id,
    //                 'name' => $subCategory->name,
    //                 'tests' => $tests->toArray()
    //             ];
    //         }

    //         dd($report->toArray(), $subCategoryData);

    //         // Return the report along with its sub-categories and tests
    //         return view('admin.report.generate_report', compact('report', 'subCategoryData'));
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Error occurred while fetching the report.');
    //     }
    // }
    // public function generateReport(int $report_id)
    // {
    //     try {
    //         // Fetch the report by its ID with its related category and sub-category
    //         $report = Report::with('category', 'subCategory')->findOrFail($report_id);

    //         // Fetch all sub-categories for the report's category
    //         $subCategories = SubCategory::where('category_id', $report->category_id)->get();
    //         // dd($report->category_id, $report, $subCategories->toArray());

    //         // Initialize an array to hold the sub-categories with their respective tests from the pivot table
    //         $subCategoryData = [];

    //         // Loop through each sub-category and fetch the related tests from the pivot table (report_test)
    //         foreach ($subCategories as $subCategory) {
    //             // Fetch all tests for the current sub-category that are attached to the current report
    //             $tests = $report->tests()
    //                 ->where('sub_category_id', $subCategory->id)  // Ensure tests belong to the current sub-category
    //                 ->get();  // Fetch the attached tests

    //             if (count($tests) > 0) {
    //                 // Add the sub-category data to the array, including the tests
    //                 $subCategoryData[] = [
    //                     'id' => $subCategory->id,
    //                     'name' => $subCategory->name,
    //                     'tests' => $tests->toArray()  // Include only the tests attached to this report
    //                 ];
    //             }
    //         }
    //         dd($subCategoryData);

    //         // Return the report along with its sub-categories and their respective tests
    //         return view('admin.report.generate_report', compact('report', 'subCategoryData'));
    //     } catch (\Exception $e) {
    //         // Return with error message if any exception occurs
    //         dd($e->getMessage());
    //         return redirect()->back()->with('error', $e->getMessage());
    //     }
    // }

    public function generateReport(int $report_id)
    {
        try {
            $setting = ReportSetting::first();
            // Fetch the report by its ID with its related category and sub-category
            $report = Report::with('category', 'subCategory')->findOrFail($report_id);

            // Fetch all sub-categories for the report's category
            $subCategories = SubCategory::where('category_id', $report->category_id)->get();

            // Initialize an array to hold the sub-categories with their respective tests from the pivot table
            $subCategoryData = [];

            // Loop through each sub-category and fetch the related tests from the pivot table (report_test)
            foreach ($subCategories as $subCategory) {
                // Fetch all tests for the current sub-category that are attached to the current report
                $tests = $report->tests()
                    ->where('report_test.sub_category_id', $subCategory->id)  // Explicitly use report_test.sub_category_id
                    ->get();  // Fetch the attached tests

                if (count($tests) > 0) {
                    // Add the sub-category data to the array, including the tests
                    $subCategoryData[] = [
                        'id' => $subCategory->id,
                        'name' => $subCategory->name,
                        'tests' => $tests  // Include only the tests attached to this report
                    ];
                }
            }

            // dd($report, $subCategoryData);

            // Return the report along with its sub-categories and their respective tests
            return view('admin.report.generate_report', compact('report', 'subCategoryData', 'setting'));
        } catch (\Exception $e) {
            // Return with error message if any exception occurs
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function receiptReport(int $report_id)
    {
        try {
            $setting = ReportSetting::first();
            // Fetch the report by its ID with its related category and sub-category
            $report = Report::with('category', 'subCategory')->findOrFail($report_id);

            // Fetch all sub-categories for the report's category
            $subCategories = SubCategory::where('category_id', $report->category_id)->get();

            // Initialize an array to hold the sub-categories with their respective tests from the pivot table
            $subCategoryData = [];

            // Loop through each sub-category and fetch the related tests from the pivot table (report_test)
            foreach ($subCategories as $subCategory) {
                // Fetch all tests for the current sub-category that are attached to the current report
                $tests = $report->tests()
                    ->where('report_test.sub_category_id', $subCategory->id)  // Explicitly use report_test.sub_category_id
                    ->get();  // Fetch the attached tests

                if (count($tests) > 0) {
                    // Add the sub-category data to the array, including the tests
                    $subCategoryData[] = [
                        'id' => $subCategory->id,
                        'name' => $subCategory->name,
                        'tests' => $tests  // Include only the tests attached to this report
                    ];
                }
            }

            // dd($report, $subCategoryData);

            // Return the report along with its sub-categories and their respective tests
            return view('admin.report.receipt_report', compact('report', 'subCategoryData', 'setting'));
        } catch (\Exception $e) {
            // Return with error message if any exception occurs
            return redirect()->back()->with('error', $e->getMessage());
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

    // public function saveSingleTest(Request $request)
    // {
    //     try {
    //         // Validate input
    //         $validated = $request->validate([
    //             'test_id' => 'required|exists:tests,id',
    //             'report_id' => 'nullable|exists:reports,id',
    //         ]);

    //         // Prepare where conditions for checking the existing record
    //         $where = [
    //             'report_id' => $validated['report_id'],
    //             'test_id' => $validated['test_id'],
    //         ];

    //         // If the record does not exist, create a new one
    //         DB::table('report_test')->insert($where);

    //         $report_test = DB::table('report_test')->where($where)->first();

    //         // Fetch the newly inserted record
    //         $newRecord = Test::find($validated['test_id']);
    //         $subCategory = SubCategory::find($newRecord->sub_category_id);
    //         $newRecord['sub_category'] = $subCategory;
    //         $newRecord['report_test'] = $report_test;

    //         // Return a success response with a message
    //         return returnWebJsonResponse('Test added to Report', 'success', $newRecord);
    //     } catch (\Exception $e) {

    //         // Return a JSON response with the error message
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

            // Fetch the report to get the category and sub-category information
            $report = Report::findOrFail($validated['report_id']);
            $test = Test::findOrFail($validated['test_id']);

            // Prepare the necessary data for the 'report_test' table
            $category_id = $report->category_id; // category ID from the report
            $sub_category_id = $test->sub_category_id; // sub-category ID from the test

            // Insert into the 'report_test' table with the additional category and sub-category IDs
            $where = [
                'report_id' => $validated['report_id'],
                'test_id' => $validated['test_id'],
                'category_id' => $category_id,       // added category_id
                'sub_category_id' => $sub_category_id, // added sub_category_id
            ];

            // Insert the data into the 'report_test' table
            DB::table('report_test')->insert($where);

            // Fetch the newly inserted record
            $report_test = DB::table('report_test')->where($where)->first();

            // Fetch the newly added test along with the sub-category data
            $newRecord = Test::find($validated['test_id']);
            $subCategory = SubCategory::find($newRecord->sub_category_id);
            $newRecord['sub_category'] = $subCategory;
            $newRecord['report_test'] = $report_test;

            // Return success response
            return returnWebJsonResponse('Test added to Report', 'success', $newRecord);
        } catch (\Exception $e) {
            // Handle any errors and return a JSON response with the error message
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
                $subCategories = SubCategory::where('category_id', $report->category->id)->get();
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
                return view('admin.report.view_report', compact('report', 'category', 'subCategory', 'tests', 'report_tests', 'subCategories'));
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

    // public function saveAllLowerValues(Request $request)
    // {
    //     $lowerValues = $request->input('lower_values');
    //     $all_report_test_ids = array_column($lowerValues, 'report_test');
    //     // dd($lowerValues, $all_report_test_ids);

    //     try {
    //         foreach ($lowerValues as $item) {
    //             // Find the report_test by ID and update the lower value
    //             DB::table('report_test')->where('id', $item['report_test'])->update(['lower_value' => $item['lower_value']]);
    //             // $reportTest = ReportTest::findOrFail($item['report_test']);
    //             // $reportTest->lower_value = $item['lower_value'];
    //             // $reportTest->save();
    //         }
    //         $all_report_test = DB::table('report_test')->whereIn('id', $all_report_test_ids)->get();
    //         return returnWebJsonResponse('All lower values updated successfully.', 'success', $all_report_test);
    //         // return response()->json(['success' => true, 'message' => 'Lower value updated successfully.']);
    //     } catch (\Exception $e) {
    //         return returnWebJsonResponse($e->getMessage());
    //     }
    // }

    public function saveAllLowerValues(Request $request)
    {
        $lowerValues = $request->input('lower_values');
        $all_report_test_ids = array_column($lowerValues, 'report_test');

        try {
            foreach ($lowerValues as $item) {
                // Find the report_test by ID and update the lower value
                DB::table('report_test')->where('id', $item['report_test'])->update([
                    'lower_value' => $item['lower_value'],
                ]);
            }

            $all_report_test = DB::table('report_test')->whereIn('id', $all_report_test_ids)->get();

            return returnWebJsonResponse('All lower values updated successfully.', 'success', $all_report_test);
        } catch (\Exception $e) {
            return returnWebJsonResponse($e->getMessage());
        }
    }
}
