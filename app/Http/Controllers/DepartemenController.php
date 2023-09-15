<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DepartemenController extends Controller
{
    public function index(Request $request){

        $nama_dpt = $request->nama_dpt;
        $query = Departemen::query();
        $query->select('*');
        if(!empty($nama_dpt)){
            $query->where('nama_dpt', 'like', '%'.$nama_dpt.'%');
        }
        $departemen = $query->get();

        // $departemen = DB::table('departemen')->orderBy('kode_dpt')->get();
        return view('departemen.index', compact('departemen'));
    }

    public function store(Request $request){
        $kode_dpt = $request->kode_dpt;
        $nama_dpt = $request->nama_dpt;
        $data = [
            'kode_dpt' => $kode_dpt,
            'nama_dpt' => $nama_dpt
        ];

        $simpan = DB::table('departemen')->insert($data);
        if($simpan){
            return Redirect::back()->with(['success'=>'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning'=>'Data Gagal Disimpan']);
        }
    }

    public function edit(Request $request){

        $kode_dpt = $request->kode_dpt;
        $departemen = DB::table('departemen')->where('kode_dpt', $kode_dpt)->first();

        return view('departemen.edit', compact('departemen'));
    }

    public function update($kode_dpt, Request $request){

        $nama_dpt = $request->nama_dpt;
        $data = [
            'nama_dpt' => $nama_dpt
        ];

        $update = DB::table('departemen')->where('kode_dpt', $kode_dpt)->update($data);
        if($update){
            return Redirect::back()->with(['success'=>'Data Berhasil Di update']);
        } else {
            return Redirect::back()->with(['warning'=>'Data Gagal Di update']);
        }

    }

    public function delete($kode_dpt){
        $delete = DB::table('departemen')->where('kode_dpt', $kode_dpt)->delete();
        if($delete){
            return Redirect::back()->with(['success'=>'Data Berhasil Di Hapus']);
        } else {
            return Redirect::back()->with(['warning'=>'Data Gagal Di Hapus']);
        }
    }
    
}
