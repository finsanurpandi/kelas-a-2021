<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecture;

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
}
