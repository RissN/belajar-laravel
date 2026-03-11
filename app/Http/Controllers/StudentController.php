<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use RealRashid\SweetAlert\Facades\Alert;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Student";
        $students = Student::get();
        return view('student.index', compact('title', 'students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create New Student";
        return view('student.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'gender' => 'nullable',
            'phone' => 'nullable',
            'address' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/student'), $imageName);
        }
        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'image' => $imageName
        ]);
        Alert::success('Success', 'Student created successfully');
        return redirect()->route('student.index');
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
        $title = "Edit Student";
        $students = Student::findOrFail($id);
        return view('student.edit', compact('title', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:student,email,' . $id,
            'gender' => 'nullable',
            'phone' => 'nullable',
            'address' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $students = Student::find($id);
        $imageName = $students->image;
        if ($request->hasFile('image')) {
            if ($students->image) {
                unlink(public_path('uploads/student') . '/' . $students->image);
            }
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/student'), $imageName);
        }
        $students->name = $request->name;
        $students->email = $request->email;
        $students->phone = $request->phone;
        $students->gender = $request->gender;
        $students->address = $request->address;
        $students->image = $imageName;
        $students->save();

        Alert::success('Success', 'Student updated successfully');
        return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $students = Student::find($id);
        $students->delete();
        unlink(public_path('uploads/student') . '/' . $students->image);
        Alert::success('Success', 'Student deleted successfully');
        return redirect()->route('student.index');
    }
}
