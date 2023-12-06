<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Models\Department;
use App\Models\User;
use App\Http\Requests\StoreLecturerRequest;
use App\Http\Requests\UpdateLecturerRequest;

class LecturerController extends Controller
{
    public function index()
    {
        // $data['lecturers'] = Lecture::all();
        $data['lecturers'] = Lecture::with('department')->get();
        // $students = Lecture::find(5467650471)->student;

        // dd($students);

        // $data['lecturers'] = Lecture::where('department_id', 1)->get();
       
        // dd($lectures);
        // echo "<pre>";
        // print_r($lectures);
        // echo "</pre>";
        return view('lecturer.index', $data);
    }

    public function create()
    {
        $data['departments'] = Department::pluck('name', 'id');
        return view('lecturer.create', $data);
    }

    public function store(StoreLecturerRequest $request)
    {
        // without validation
        // Lecture::create($request->all());

        // form validation
        // $validated = $request->validate([
        //     'nidn' => 'required|digits:10|unique:lectures,nidn',
        //     'nama' => 'required|string|min:3|max:60',
        //     'department_id' => 'required',
        // ]);
        // Lecture::create($validated);

        Lecture::create($request->validated());

        return redirect()->route('lecturer.index');
    }

    public function edit(string $nidn)
    {
        $data['lecturer'] = Lecture::find($nidn);
        $data['departments'] = Department::pluck('name', 'id');
        return view('lecturer.create', $data);
    }

    public function update(UpdateLecturerRequest $request, $nidn)
    {
        $lecturer = Lecture::find($nidn);
        $lecturer->update($request->validated());

        return redirect()->route('lecturer.index');
    }

    public function destroy(string $nidn)
    {
        Lecture::find($nidn)->delete();

        return redirect()->route('lecturer.index');
    }

    // soft deleting
    public function recycle_bin()
    {
        $data['lecturers'] = Lecture::onlyTrashed()->get();
        $data['jumlah'] = Lecture::onlyTrashed()->count();
        return view('lecturer.recyclebin', $data);
    }

    public function restore(Request $request, $nidn)
    {
        Lecture::onlyTrashed()->where('nidn', $nidn)->restore();

        return redirect()->route('lecturer.recycle.bin');
    }

    public function delete(Request $request, $nidn)
    {
        Lecture::onlyTrashed()->where('nidn', $nidn)->forceDelete();

        return redirect()->route('lecturer.recycle.bin');
    }

    public function restore_all()
    {
        Lecture::onlyTrashed()->restore();

        return redirect()->route('lecturer.recycle.bin');
    }

    public function delete_all()
    {
        Lecture::onlyTrashed()->forceDelete();

        return redirect()->route('lecturer.recycle.bin');
    }

    public function students(string $nidn)
    {
        $data['students'] = Lecture::find($nidn)->students;
        $data['lecturer'] = Lecture::find($nidn);
        $data['users'] = User::find(3)->with('roles')->get();

        $data['departmentStudent'] = Department::find(2)->student;

        return view('lecturer.student', $data);
    }
}
