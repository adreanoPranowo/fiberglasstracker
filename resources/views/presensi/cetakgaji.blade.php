<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laporan Gaji</title>
  
    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  
    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
  
    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>@page 
    { size: A4 }
  
    #judul{
      font-size: 18;
      font-weight: bold;
    }

    h3{
        text-align: center;
    }
  
    .tabelkrywn{
      margin-top: 50px;
    }
    .tabelkrywn td{
      padding: 3px;
    }
  
    .tabelgaji{
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }
  
    .tabelgaji  tr  th{
      border: 1px solid #000 ;
      background-color: #c7c7c7;
      padding: 8px;
    }
  
    .tabelgaji td{
      border: 1px solid #000 ;
      padding: 5px;
    }
  
    .foto {
      width: 40px;
      height: 45px;
    }
    </style>
</head>
<body class="A4">
    
    <section class="sheet padding-10mm">
        <table style="width : 100%">
            <tr>
                <td style="width: 30px;">
                    <img src="{{ asset('assets/img/logo_wangi.png') }}" width="70" height="70" alt="logo_perusahaan">
                </td>
                <td>
                    <span id="judul">
                      LAPORAN GAJI KARYAWAN<br>
                      PERIODE {{ strtoupper($namabulan[$bulan] )}} {{ $tahun }} <br>
                      CV. WANGI FIBERGLASS <br>
                    </span>
                    <span><i>Jl. Jember No.RT/RW 20/06, Dusun Kaliwadung, Kaligondo, Kec. Genteng, Kabupaten Banyuwangi, Jawa Timur 68465</i></span>
              </td>
            </tr>
        </table> 
        <br>
        <h3>SLIP GAJI KARYAWAN</h3>
        <table class="tabelkrywn">
            <tr>
              <td rowspan="6">
                @php
                  $path = Storage::url('uploads/karyawan/'.$karyawan->foto);
                @endphp
                <img src="{{ url($path) }}" alt="" width="100" height="130">
              </td>
            </tr>
            <tr>
              <td>NIK</td>
              <td>:</td>
              <td>{{ $karyawan->nik }}</td>
            </tr>
            <tr>
                <td>Nama Karyawan</td>
                <td>:</td>
                <td>{{ $karyawan->nama_lengkap }}</td>
              </tr>
              <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $karyawan->jabatan }}</td>
              </tr>
              <tr>
                <td>Departemen</td>
                <td>:</td>
                <td>{{ $karyawan->nama_dpt }}</td>
              </tr>
              <tr>
                <td>No HP</td>
                <td>:</td>
                <td>{{ $karyawan->no_hp }}</td>
              </tr>
          </table>
          <table class="tabelgaji">
            <tr>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
          </table>
    </section>
    
</body>
</html>