<?php

namespace App\Http\Controllers;

use App\Models\Pengajuanizin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    public function gethari ()  {
        $hari = date("D");
    
        switch ($hari){
            case 'Sun':
            $hari_ini = "Minggu";
            break;
    
            case 'Mon':
            $hari_ini = "Senin";
            break;
    
            case 'Tue':
            $hari_ini = "Selasa";
            break;
    
            case 'Wed':
            $hari_ini = "Rabu";
            break;
    
            case 'Thu':
            $hari_ini = "Kamis";
            break;
    
            case 'Fri':
            $hari_ini = "Jumat";
            break;
    
            case 'Sat':
            $hari_ini = "Sabtu";
            break;
    
            default:
            $hari_ini = "Tidak di ketahui";
            break;
        }
        
            return $hari_ini;
    
    }

    public function create() {

        
        $hariini = date("Y-m-d");
        $namahari = $this->gethari();
        $nik = Auth::guard('karyawan')->user()->nik;
        $cek = DB::table('presensi')->where('tgl_presensi',$hariini)->where('nik',$nik)->count();
        $kode_cabang = Auth::guard('karyawan')->user()->kode_cabang;
        $lok_kantor = DB::table('cabang')->where('kode_cabang',$kode_cabang)->first();
        $jamkerja = DB::table('konfigurasi_jamkerja')
        ->join('jam_kerja','konfigurasi_jamkerja.kode_jam_kerja','=','jam_kerja.kode_jam_kerja')
        ->where('nik',$nik)->where('hari',$namahari)->first();
        return view('presensi.create', compact('cek','lok_kantor','jamkerja'));
    }

    //function menyimpan data 

    public function store(Request $request){
        
        $nik = Auth::guard('karyawan')->user()->nik;
        $kode_cabang = Auth::guard('karyawan')->user()->kode_cabang;
        $tgl_presensi = date("Y-m-d");
        $jam = date("H:i:s");
        $lok_kantor = DB::table('cabang')->where('kode_cabang', $kode_cabang)->first();
        $lok = explode(",", $lok_kantor->lokasi_cabang);
        $image = $request->image;
        $latitudkantor = $lok[0];
        $longitudkantor = $lok[1];

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


        if($radius > $lok_kantor->radius_cabang){
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
        $nik = Auth::guard('karyawan')->user()->nik;
        $dataizin = DB::table('pengajuan_izin')->where('nik', $nik)->get();
        // dd($dataizin);
        return view('presensi.izin', compact('dataizin'));
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

    public function monitoring(){
        return view('presensi.monitoring');
    }

    public function getpresensi(Request $request){
        $tanggal = $request->tanggal;
        $presensi = DB::table('presensi')
        ->select('presensi.*', 'nama_lengkap', 'nama_dpt')
        ->join('karyawan','presensi.nik', '=','karyawan.nik')
        ->join('departemen','karyawan.kode_dpt', '=','departemen.kode_dpt')
        ->where('tgl_presensi', $tanggal)
        ->get();

        return view('presensi.getpresensi', compact('presensi'));
    }

    public function tampilkanpeta(Request $request){
        $id = $request->id;
        $presensi = DB::table('presensi')->where('id', $id)
        ->join('karyawan','presensi.nik','=','karyawan.nik')
        ->first();
        return view('presensi.showmap', compact('presensi'));
    }

    public function laporan(){

        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $karyawan = DB::table('karyawan')->orderBy('nik')->get();

        return view('presensi.laporan', compact('namabulan', 'karyawan'));

    }

    public function cetaklaporan(Request $request){
        $nik = $request->nik;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];


        $karyawan = DB::table('karyawan')->where('nik', $nik)
        ->join('departemen','karyawan.kode_dpt','=','departemen.kode_dpt')
        ->first();


        $presensi = DB::table('presensi')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
        ->orderBy('tgl_presensi')
        ->get();

        if (isset($_POST['exportexcel'])){
            $time = date("d-M-Y H:i:s");
            //mengrimkan data raw ke excel
            header("Content-type: application/vnd-ms-excel");
            //mendefisinikan nama file export
            header("Content-Disposition: attachment; filename=Laporan Presensi Karyawan $time.xls");
            return view('presensi.cetaklaporanexcel', compact('bulan','tahun','namabulan','karyawan','presensi'));
        }
        return view('presensi.cetaklaporan', compact('bulan','tahun','namabulan','karyawan','presensi'));
    }

    public function gaji(){
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $karyawan = DB::table('karyawan')->orderBy('nik')->get();
        return view('presensi.gaji', compact('namabulan', 'karyawan'));
    }

    public function cetakgaji(Request $request){
        $nik = $request->nik;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];


        $karyawan = DB::table('karyawan')->where('nik', $nik)
        ->join('departemen','karyawan.kode_dpt','=','departemen.kode_dpt')
        ->first();


        $presensi = DB::table('presensi')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
        ->orderBy('tgl_presensi')
        ->get();

        if (isset($_POST['exportexcel'])){
            $time = date("d-M-Y H:i:s");
            //mengrimkan data raw ke excel
            header("Content-type: application/vnd-ms-excel");
            //mendefisinikan nama file export
            header("Content-Disposition: attachment; filename=Laporan Presensi Karyawan $time.xls");
            return view('presensi.cetaklaporanexcel', compact('bulan','tahun','namabulan','karyawan'));
        }
        return view('presensi.cetakgaji', compact('bulan','tahun','namabulan','karyawan'));
    }

    public function rekap(){

        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        return view('presensi.rekap', compact('namabulan'));
    }


    public function cetakrekap(Request $request){
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $rekap = DB::table('presensi')
        ->selectRaw('presensi.nik,nama_lengkap,
            MAX(IF(DAY(tgl_presensi) = 1, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_1,
            MAX(IF(DAY(tgl_presensi) = 2, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_2,
            MAX(IF(DAY(tgl_presensi) = 3, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_3,
            MAX(IF(DAY(tgl_presensi) = 4, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_4,
            MAX(IF(DAY(tgl_presensi) = 5, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_5,
            MAX(IF(DAY(tgl_presensi) = 6, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_6,
            MAX(IF(DAY(tgl_presensi) = 7, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_7,
            MAX(IF(DAY(tgl_presensi) = 8, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_8,
            MAX(IF(DAY(tgl_presensi) = 9, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_9,
            MAX(IF(DAY(tgl_presensi) = 10, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_10,
            MAX(IF(DAY(tgl_presensi) = 11, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_11,
            MAX(IF(DAY(tgl_presensi) = 12, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_12,
            MAX(IF(DAY(tgl_presensi) = 13, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_13,
            MAX(IF(DAY(tgl_presensi) = 14, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_14,
            MAX(IF(DAY(tgl_presensi) = 15, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_15,
            MAX(IF(DAY(tgl_presensi) = 16, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_16,
            MAX(IF(DAY(tgl_presensi) = 17, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_17,
            MAX(IF(DAY(tgl_presensi) = 18, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_18,
            MAX(IF(DAY(tgl_presensi) = 19, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_19,
            MAX(IF(DAY(tgl_presensi) = 20, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_20,
            MAX(IF(DAY(tgl_presensi) = 21, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_21,
            MAX(IF(DAY(tgl_presensi) = 22, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_22,
            MAX(IF(DAY(tgl_presensi) = 23, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_23,
            MAX(IF(DAY(tgl_presensi) = 24, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_24,
            MAX(IF(DAY(tgl_presensi) = 25, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_25,
            MAX(IF(DAY(tgl_presensi) = 26, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_26,
            MAX(IF(DAY(tgl_presensi) = 27, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_27,
            MAX(IF(DAY(tgl_presensi) = 28, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_28,
            MAX(IF(DAY(tgl_presensi) = 29, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_29,
            MAX(IF(DAY(tgl_presensi) = 30, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_30,
            MAX(IF(DAY(tgl_presensi) = 31, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_31')
        ->join('karyawan','presensi.nik','=','karyawan.nik')
        ->whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
        ->groupByRaw('presensi.nik,nama_lengkap')
        ->get();

        if (isset($_POST['exportexcel'])){
            $time = date("d-M-Y H:i:s");
            //mengrimkan data raw ke excel
            header("Content-type: application/vnd-ms-excel");
            //mendefisinikan nama file export
            header("Content-Disposition: attachment; filename=Rekap Presensi Karyawan $time.xls");

        }

        return view('presensi.cetakrekap', compact('bulan','tahun','rekap','namabulan'));
        
    }

    public function izinsakit(Request $request){
        $query = Pengajuanizin::query();
        $query->select('id','tgl_izin','pengajuan_izin.nik','nama_lengkap','jabatan','status','status_approved','keterangan');
        $query->join('karyawan','pengajuan_izin.nik','=','karyawan.nik');
        if(!empty($request->dari) && !empty($request->sampai)){
            $query->whereBetween('tgl_izin', [$request->dari,$request->sampai]);
        }

        if(!empty($request->nik)){
            $query->where('pengajuan_izin.nik', $request->nik);
        }

        if(!empty($request->nama_lengkap)){
            $query->where('nama_lengkap','like','%'. $request->nama_lengkap .'%');
        }

        if($request->status_approved != ""){
            $query->where('status_approved', $request->status_approved);
        }
        $query->orderBy('tgl_izin','desc');
        $izinsakit = $query->paginate(4);
        $izinsakit->appends($request->all());
        return view('presensi.izinsakit', compact('izinsakit'));
    }

    public function approveizinsakit(Request $request){
        $status_approved = $request->status_approved;
        $id_izinsakit_form = $request->id_izinsakit_form;
        $update = DB::table('pengajuan_izin')->where('id', $id_izinsakit_form)->update([
            'status_approved' => $status_approved
        ]);
        if($update){
            return Redirect::back()->with(['success' => 'Data berhasil di update']);
        } else {
            return Redirect::back()->with(['warning' => 'Data gagal di update']);
        }
    }

    public function batalkanizinsakit($id){
        $update = DB::table('pengajuan_izin')->where('id', $id)->update([
            'status_approved' => 0
        ]);
        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil di Update']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal di Update']);
        }
    }

    public function cekpengajuanizin(Request $request){
        $tgl_izin = $request->tgl_izin;
        $nik = Auth::guard('karyawan')->user()->nik;

        $cek = DB::table('pengajuan_izin')->where('nik', $nik)->where('tgl_izin', $tgl_izin)->count();
        return $cek;

    }

}
