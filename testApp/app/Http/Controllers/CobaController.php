<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CobaController extends Controller
{
    public function coba()
    {
        // $data['nama'] = 'Finsa';
        // $data['alamat'] = 'Cianjur';

        // return view('coba.index', $data);

        $nama = 'Finsa';
        $alamat = '<strong>Cianjur</strong>';

        $fruits = array('Mangga', 'Jambu', 'Nanas');

        return view('coba.index', compact('nama', 'alamat', 'fruits'));
    }
}
