<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReportSetting;
use Illuminate\Http\Request;

class ReportSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve the first record from the report_settings table
        $setting = ReportSetting::first();
        return view('admin.report.setting', compact('setting'));
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

    // Update the settings
    public function settingUpdate(Request $request, $id)
    {
        // Find the settings by ID
        $settings = ReportSetting::find($id);

        // Validate incoming request
        $request->validate([
            'pathalogy_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'working_hour' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'phones' => 'nullable|string|max:255',
            'discount' => 'nullable|numeric',
            'interpretation' => 'nullable|string|max:255',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for header image
        ]);

        // Update the setting record
        try {
            // Retrieve all input data from the form (excluding file)
            $input = $request->except(['_token', 'header_image']);

            // Handle file upload for header image if provided
            if ($request->hasFile('header_image')) {
                // Delete the old image if it exists
                if ($settings->header_image && file_exists(public_path($settings->header_image))) {
                    unlink(public_path($settings->header_image)); // Remove the old image file
                }

                // Handle the new image upload
                $image = $request->file('header_image');
                $imageName = $image->hashName(); // Generate a hashed name for the file
                $image->move(public_path('assets/front/images/header'), $imageName); // Move the uploaded file to public directory

                // Save the image path in the input array
                $input['header_image'] = 'assets/front/images/header/' . $imageName;
            }

            // Update or create the setting record (assuming there's only one record with id 1)
            ReportSetting::updateOrCreate(
                ['id' => 1], // Assuming there's only one record in the report_settings table
                $input
            );

            // Redirect with success message
            return redirect()->route('admin.setting')->with('success', 'Settings updated successfully.');
        } catch (\Exception $e) {
            // Redirect back with error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
