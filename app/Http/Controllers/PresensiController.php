<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{

    public function create() {

        $hariini = date("Y-m-d");
        $nik = Auth::guard('karyawan')->user()->nik;
        $cek = DB::table('presensi')->where('tgl_presensi',$hariini)->where('nik',$nik)->count();
        return view('presensi.create', compact('cek'));
    }

    //function menyimpan data 

    public function store(Request $request){
        
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_presensi = date("Y-m-d");
        $jam = date("H:i:s");
        $image = $request->image;

        //membuat lokasi kantor
        $latitudkantor = -8.131582818330509;
        $longitudkantor = 112.56815327107701;

        $lokasi = $request->lokasi;
    
        //memecah data lokasi user
        $lokasiuser = explode(",", $lokasi);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1]; 

        $jarak = $this->distance($latitudkantor, $longitudkantor, $latitudeuser, $longitudeuser);
        $radius = round($jarak['meters']) ;
       

        
         //cek apakah sudah absen
         $cek = DB::table('presensi')->where('tgl_presensi',$tgl_presensi)->where('nik',$nik)->count();

         if($cek > 0){
            $ket = "out";
         } else {
            $ket = "in";
         }
         //menyimpan data image
        $folderPath = "public/uploads/absensi/";
        $formatName = $nik."-".$tgl_presensi."-".$ket;
        //decode image
        $image_parts = explode(";base64",$image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName.".png";
        $file = $folderPath.$fileName;

       
        if($radius > 100){
            echo "error|Maaf anda berada diluar radius, Jarak anda ".$radius." meter dari Kantor |radius";
        }else {
            if($cek > 0){
                $data_pulang = [
                    'jam_out' => $jam,
                    'foto_out' => $fileName,
                    'lokasi_out' => $lokasi
                ];
                $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->update($data_pulang);
                if($update){
                    echo 'success|Terimakasih, Hati-hati di Jalan|out';
                    Storage::put($file, $image_base64);
                } else {
                    echo 'error|Maaf Gagal Absen, Hubungi Admin|out';
                }
            } else {
                $data = [
                    'nik' => $nik,
                    'tgl_presensi' => $tgl_presensi,
                    'jam_in' => $jam,
                    'foto_in' => $fileName,
                    'lokasi_in' => $lokasi
                ];
                $simpan  = DB::table('presensi')->insert($data);
                if($simpan){
                    echo 'success|Terimakasih, Selamat Bekerja|in';
                    Storage::put($file, $image_base64);
                } else {
                    echo 'error|Maaf Gagal Absen, Hubungi Admin|in';
                }
        }
        }
    }

     //Menghitung Jarak
     function distance($lat1, $lon1, $lat2, $lon2) {
         $theta = $lon1 - $lon2;
         $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
         $miles = acos($miles);
         $miles = rad2deg($miles);
         $miles = $miles * 60 * 1.1515;
         $feet = $miles * 5280;
         $yards = $feet / 3;
         $kilometers = $miles * 1.609344;
         $meters = $kilometers * 1000;
         return compact('meters');
     }

     public function editprofile(){

        //get data karyawan
        $nik = Auth::guard('karyawan')->user()->nik;
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        
        return view('presensi.editprofile', compact('karyawan'));
     }

     public function updateprofile(Request $request){

        $nik = Auth::guard('karyawan')->user()->nik;
        $nama_lengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;
        $password = Hash::make($request->password);
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();

        //get data update foto
        if($request->hasFile(('foto'))){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $karyawan->foto;
        }

        if(empty($request->password)){
             $data = [
            'nama_lengkap' => $nama_lengkap,
            'no_hp' => $no_hp,
            'foto' => $foto
        ];
        } else {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'foto' => $foto,
                'password' => $password
            ];
        }

        $update = DB::table('karyawan')->where('nik', $nik)->update($data);
        if($update){
            if($request->hasFile('foto')){
                $folderPath = "public/uploads/karyawan/";
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success'=>'Berhasil Update Data']);
        } else {
            return Redirect::back()->with(['error'=>'Gagal Update Data']);
        }
     }
     
     public function histori(){

        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        
        return view('presensi.histori', compact('namabulan'));
     }

     public function gethistori(Request $request){
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nik = Auth::guard('karyawan')->user()->nik;

        $histori = Db::table('presensi')
        ->whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
        ->where('nik', $nik)
        ->orderBy('tgl_presensi')
        ->get();

        return view('presensi.gethistori', compact('histori'));
        
     }

     public function izin (){

        return view('presensi.izin');
     }

     public function buatizin(){

        return view('presensi.buatizin');
     }

     public function storeizin(Request $request){

        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin = $request->tgl_izin;
        $status = $request->status;
        $keterangan = $request->keterangan;

        $data = [
            'nik' => $nik,
            'tgl_izin' => $tgl_izin,
            'status' => $status,
            'keterangan' => $keterangan
        ];

        $simpan = DB::table('pengajuan_izin')->insert($data);

        if($simpan){
            return redirect('/presensi/izin')->with(['success'=>'Data Berhasil Terkirim']);
        } else {
            return redirect('/presensi/izin')->with(['error'=>'Data Gagal Disimpan']);
        }


     }
}
