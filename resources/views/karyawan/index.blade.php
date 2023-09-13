@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none" style="margin-top: 20px;">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <div class="page-pretitle">Karyawan</div>
        <h2 class="page-title">Data Karyawan</h2>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form action="/karyawan" method="GET">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <input type="text" name="nama_karyawan" id="nama_karyawan" value="{{ Request('nama_karyawan') }}" class="form-control" placeholder="Nama Karyawan">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <select name="kode_dpt" id="kode_dpt" class="form-select">
                                                <option value="">Departemen</option>
                                                @foreach($departemen as $d)
                                                    <option {{ Request('kode_dpt')==$d->kode_dpt ? 'selected' : ''}} value="{{ $d->kode_dpt }}">{{ $d->nama_dpt }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                            
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                            <path d="M21 21l-6 -6"></path>
                                            </svg>
                                            Cari
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                        <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NIK</th>
                            <th>NAMA</th>
                            <th>JABATAN</th>
                            <th>DEPARTEMENT</th>
                            <th>NO. HP</th>
                            <th>FOTO</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawan as $d)
                        @php
                            $path = Storage::url('uploads/karyawan/'.$d->foto);
                        @endphp
                            <tr>
                                <td>{{ $loop->iteration + $karyawan->firstItem() - 1 }}</td>
                                <td>{{ $d->nik }}</td>
                                <td>{{ $d->nama_lengkap }}</td>
                                <td>{{ $d->jabatan }}</td>
                                <td>{{ $d->nama_dpt }}</td>
                                <td>{{ $d->no_hp }}</td>
                                <td>
                                    @if(empty($d->foto))
                                    <img src="{{ asset('assets/img/nofoto.jpg') }}" class="avatar" alt="">
                                    @else
                                    <img src="{{ url($path) }}" class="avatar" alt="">
                                    @endif
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex">
                {!! $karyawan->links() !!}
                </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection