<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list(Request $request)
    {
        try {
            if ($request->ajax() and $request->date) {
                $attendances = Attendance::whereDate('date', date('Y-m-d', strtotime($request->date)))->where('present', 1)->pluck('student_id')->toArray();
                $users = User::get();
                return returnWebJsonResponse('Student get successfully', 'success', [
                    'attendances' => $attendances,
                    'users' => $users,
                    'date' => $request->date,
                ]);
            }

            $todayDate = date('Y-m-d');
            $attendances = Attendance::whereDate('date', $todayDate)->where('present', 1)->pluck('student_id')->toArray();
            $users = User::get();
            return view('admin.attendance.list', compact('attendances', 'users'));
        } catch (\Exception $e) {
            if ($request->ajax() and $request->date) {
                return returnWebJsonResponse($e->getMessage(), 'error', []);
            } else {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function saveAttendance(Request $request)
    {
        try {
            $student_id = $request->student_id;
            $isPresent = ($request->isPresent == 1) ? true : false;
            // dd($isPresent);
            $date = date('Y-m-d', strtotime($request->searchDate));

            $attendance = Attendance::updateOrCreate(
                [
                    'student_id' => $student_id,
                    'date' => $date,
                ], // Assuming there's only one record in the settings table
                [
                    'student_id' => $student_id,
                    'date' => $date,
                    'present' => $isPresent,
                ]
            );
            return returnWebJsonResponse('Student Attandance modified successfully', 'success', $request->all());
        } catch (\Exception $e) {
            return returnWebJsonResponse($e->getMessage(), 'error', []);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
