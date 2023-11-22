<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Models\Department;
use App\Http\Requests\StoreLecturerRequest;

class LecturerController extends Controller
{
    public function index()
    {
        $data['lecturers'] = Lecture::all();

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
}
