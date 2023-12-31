<?php

namespace App\Http\Controllers;

use App\Models\cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class Cabangcontroller extends Controller
{
    public function index(Request $request){
        
        $cabang = DB::table('cabang')->orderBy('kode_cabang')->get();
        $kodeCabangTerpilih = $request->input('kode_cabang');
        $query = DB::table('cabang');
        if ($kodeCabangTerpilih) {
            $query->where('kode_cabang', $kodeCabangTerpilih);
        }
        $hasilPencarian = $query->get();

        return view('cabang.index', compact('cabang','hasilPencarian'));
    }

    public function store(Request $request){
        $kode_cabang = $request->kode_cabang;
        $nama_cabang = $request->nama_cabang;
        $lokasi_cabang = $request->lokasi_cabang;
        $radius_cabang = $request->radius_cabang;

        try {
            $data = [
                'kode_cabang' => $kode_cabang,
                'nama_cabang' => $nama_cabang,
                'lokasi_cabang' => $lokasi_cabang,
                'radius_cabang' => $radius_cabang 
            ];
            DB::table('cabang')->insert($data);
            return Redirect::back()->with(['success'=>'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning'=>'Data Gagal Disimpan']);
        }
    }

    public function edit(Request $request){
        $kode_cabang = $request->kode_cabang;
        $cabang = DB::table('cabang')->where('kode_cabang', $kode_cabang)->first();
        return view('cabang.edit', compact('cabang'));
    }

    public function update(Request $request){
        $kode_cabang = $request->kode_cabang;
        $nama_cabang = $request->nama_cabang;
        $lokasi_cabang = $request->lokasi_cabang;
        $radius_cabang = $request->radius_cabang;

        try {
            $data = [
                'nama_cabang' => $nama_cabang,
                'lokasi_cabang' => $lokasi_cabang,
                'radius_cabang' => $radius_cabang
            ];
            DB::table('cabang')
            ->where('kode_cabang', $kode_cabang)
            ->update($data);
            return Redirect::back()->with(['success'=>'Data Berhasil Diupdate']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning'=>'Data Gagal Diupdate']);
        }
    }

    public function delete($kode_cabang){
        $delete = DB::table('cabang')->where('kode_cabang', $kode_cabang)->delete();
        if($delete){
            return Redirect::back()->with(['success'=>'Data Berhasil Di Hapus']);
        } else {
            return Redirect::back()->with(['warning'=>'Data Gagal Di Hapus']);
        }
    }
}
