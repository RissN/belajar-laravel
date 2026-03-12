<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use RealRashid\SweetAlert\Facades\Alert;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::with('student')->latest()->get();
        $title = "Data Attendance";
        return view('attendance.index', compact('attendances', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::get();
        return view('attendance.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date = $request->date;
        $attendances = $request->attendances;

        if (!$attendances) {
            return redirect()->back()->with('error', 'Please select at least one student.');
        }

        foreach ($attendances as $attendance) {
            $existingAttendance = Attendance::where('student_id', $attendance['student_id'])->whereDate('date', $date)->first();
            if ($existingAttendance) {
                $existingAttendance->update([
                    'status_in' => $attendance['status_in'],
                    'check_in' => $attendance['check_in'],
                    'status_out' => $attendance['status_out'],
                    'check_out' => $attendance['check_out'],
                    'note' => $attendance['note'],
                ]);
            } else {
                Attendance::create([
                    'student_id' => $attendance['student_id'],
                    'date' => $date,
                    'status_in' => $attendance['status_in'],
                    'check_in' => $attendance['check_in'],
                    'status_out' => $attendance['status_out'],
                    'check_out' => $attendance['check_out'],
                    'note' => $attendance['note'],
                ]);
            }
        }
        Alert::success('Success', 'Student created successfully');
        return redirect()->route('attendance.index')->with('success', 'Attendance saved successfully.');
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
        $attendance = Attendance::find($id);
        $attendance->delete();
        Alert::success('Success', 'Attendance deleted successfully');
        return redirect()->route('attendance.index');
    }
}
