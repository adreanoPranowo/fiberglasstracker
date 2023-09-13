<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index(){

        $karyawan = DB::table('karyawan')->orderBy('nik')
        ->join('departemen', 'karyawan.kode_dpt', '=', 'departemen.kode_dpt')
        ->get();

        return view('karyawan.index', compact('karyawan'));
    }
}
