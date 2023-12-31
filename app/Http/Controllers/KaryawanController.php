<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

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
        $karyawan = $query->paginate(8);

        //menmapilkan data departement di select option
        $departemen = DB::table('departemen')->get();
        $cabang = DB::table('cabang')->orderBy('kode_cabang')->get();
        return view('karyawan.index', compact('karyawan','departemen','cabang'));
    }

    public function store(Request $request){
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_dpt = $request->kode_dpt;
        $password = Hash::make('123');
        $kode_cabang = $request->kode_cabang;

        if($request->hasFile(('foto'))){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }

        try {
            $data = [
                'nik' => $nik,
                'nama_lengkap' => $nama_lengkap,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'kode_dpt' => $kode_dpt,
                'foto' => $foto,
                'password' => $password,
                'kode_cabang' => $kode_cabang
            ];
            $simpan = DB::table('karyawan')->insert($data);
            if($simpan){
                if($request->hasFile('foto')){
                    $folderPath = "public/uploads/karyawan/";
                    $request->file('foto')->storeAs($folderPath, $foto);
                }

                return Redirect::back()->with(['success'=>'Data Karyawan Berhasil Disimpan']);
            }
        } catch (\Exception $e) {
            if($e->getCode()==23000){
                $message = " Data dengan NIK ".$nik." Sudah Ada";
            }
            return Redirect::back()->with(['warning'=>'Data Karyawan Gagal Disimpan' . $message]);
            
        }
    }

    public function edit(Request $request){
        $nik = $request->nik;
        $departemen = DB::table('departemen')->get();
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        $cabang = DB::table('cabang')->orderBy('kode_cabang')->get();
        return view('karyawan.edit', compact('departemen','karyawan','cabang'));
    }

    public function update($nik, Request $request){
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_dpt = $request->kode_dpt;
        $kode_cabang = $request->kode_cabang;
        $password = Hash::make('123');
        $old_foto = $request->old_foto;
        
        if($request->hasFile(('foto'))){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $old_foto;
        }

        try {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'kode_dpt' => $kode_dpt,
                'foto' => $foto,
                'password' => $password,
                'kode_cabang' => $kode_cabang
            ];
            $update = DB::table('karyawan')->where('nik', $nik)->update($data);
            if($update){
                if($request->hasFile('foto')){
                    $folderPath = "public/uploads/karyawan/";
                    $folderPathOld = "public/uploads/karyawan/".$old_foto;
                    $request->file('foto')->storeAs($folderPath, $foto);
                    Storage::delete($folderPathOld);
                }

                return Redirect::back()->with(['success'=>'Data Karyawan Berhasil Diupdate']);
            }
        } catch (\Exception $e) {
            //dd($e);
            return Redirect::back()->with(['warning'=>'Data Karyawan Gagal Diupdate']);
            
        }
    }

    public function delete($nik){
        $delete = DB::table('karyawan')->where('nik', $nik)->delete();
        if($delete){
            return Redirect::back()->with(['success'=>'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning'=>'Data Gagal Dihapus']);
        }
    }
}
