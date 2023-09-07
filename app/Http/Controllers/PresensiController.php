<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
}
