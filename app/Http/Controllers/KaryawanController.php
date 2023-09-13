<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index(Request $request){
        

        //query search
        $query = karyawan::query();
        $query->select('karyawan.*', 'nama_dpt');
        $query->join('departemen', 'karyawan.kode_dpt', '=', 'departemen.kode_dpt');
        $query->orderBy('nik');
        if(!empty($request->nama_karyawan)){
            $query->where('nama_lengkap','like','%'.$request->nama_karyawan.'%');
        }
        if(!empty($request->kode_dpt)){
            $query->where('karyawan.kode_dpt', $request->kode_dpt);
        }
        $karyawan = $query->paginate(2);

        //menmapilkan data departement di select option
        $departemen = DB::table('departemen')->get();

        return view('karyawan.index', compact('karyawan','departemen'));
    }
}
