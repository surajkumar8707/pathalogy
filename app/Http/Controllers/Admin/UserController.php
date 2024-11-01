<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\DataTables\UserDatatable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserDatatable $dataTable)
    {
        return $dataTable->render('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'nullable|min:8',
            'phone' => 'nullable|digits_between:10,15', // Updated for better validation
            'image' => 'nullable|image|max:800', // Optional profile image
            'address' => 'nullable|string',
            'father' => 'nullable|string|max:255',
            'father_phone' => 'nullable|digits_between:10,15',
            'father_occupation' => 'nullable|string|max:255',
            'mother' => 'nullable|string|max:255',
            'mother_phone' => 'nullable|digits_between:10,15',
            'aadhar_number' => 'nullable|digits:12|unique:users', // Assuming it's 12 digits
            'pan_number' => 'nullable|string|unique:users', // Add appropriate validation
            'sign' => 'nullable|image|max:800', // Optional sign image
            'status' => 'nullable', // Optional sign image
        ], [
            'name.required' => 'Student name is required'
        ]);

        // Handle file uploads
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profiles', 'public');
            $data['image'] = $imagePath;
        }

        if ($request->hasFile('sign')) {
            $signPath = $request->file('sign')->store('signs', 'public');
            $data['sign'] = $signPath;
        }

        if ($request->password) {
            $data['password'] = Hash::make($request->password); // Hash the password
        }
        // Create the user
        User::create($data);

        // Redirect with success message
        return redirect()->route('admin.students.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = User::findOrFail($id);
        return view('admin.users.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = User::findOrFail($id);
        return view('admin.users.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     $data = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users,email,' . $id,
    //     ]);

    //     $customer = User::findOrFail($id);
    //     $data['approved'] = (isset($request->approved) and ($request->approved == 1)) ? 1 : 0;
    //     // dd($data);
    //     $customer->update($request->all());

    //     return redirect()->route('admin.students.index')->with('success', 'users updated successfully');
    // }
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|digits:10',
            'aadhar_number' => 'nullable|digits:12',
            'pan_number' => 'nullable|string|max:10',
            'father' => 'nullable|string|max:255',
            'father_phone' => 'nullable|digits:10',
            'father_occupation' => 'nullable|string|max:255',
            'mother' => 'nullable|string|max:255',
            'mother_phone' => 'nullable|digits:10',
            'address' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        // Find the student record
        $student = User::findOrFail($id);

        // Update the student record
        $student->name = $request->name;
        $student->email = $request->email;

        // Only update password if provided
        if ($request->filled('password')) {
            $student->password = bcrypt($request->password);
        }

        // Update other fields
        $student->phone = $request->phone;
        $student->aadhar_number = $request->aadhar_number;
        $student->pan_number = $request->pan_number;
        // Assuming you have fields for parent's info in the User model
        $student->father = $request->father;
        $student->father_phone = $request->father_phone;
        $student->father_occupation = $request->father_occupation;
        $student->mother = $request->mother;
        $student->mother_phone = $request->mother_phone;
        $student->address = $request->address;
        $student->status = $request->status;

        // Save the updated student record
        $student->save();

        // Redirect with success message
        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = User::findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.students.index')->with('success', 'users deleted successfully');
    }

    public function changeStatus(Request $request, User $student)
    {
        try {
            $student = User::findOrFail($request->id);
            // dd($student);

            $status = ($request->status == 1) ? 'active' : 'inactive';
            $student->status = $status;
            $res = $student->save();
            return returnWebJsonResponse("Student " . $status . " successfully", 'success', $student);
        } catch (\Exception $e) {
            return returnWebJsonResponse($e->getMessage(), 'error', []);
        }
        // return response()->json(['success' => true, 'message' => "Student " . $status . " successfully"]);
    }
}
