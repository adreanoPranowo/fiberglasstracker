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
                                @if(Session::get('success'))
                                    <div class="alert alert-success">
                                        {{  Session::get('success') }}
                                    </div>
                                @endif

                                @if(Session::get('warning'))
                                    <div class="alert alert-warning">
                                        {{  Session::get('warning') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="#" class="btn btn-primary" id="btnTambahKaryawan">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                                </svg>
                                Tambah Data
                                </a>
                            </div>
                        </div>
                    <div class="row mt-2">
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
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="edit btn btn-info btn-sm" nik="{{ $d->nik }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                <path d="M16 5l3 3"></path>
                                            </svg>
                                        </a>
                                <form action="/karyawan/{{ $d->nik }}/delete" method="POST"  style="margin-left : 5px">
                                    @csrf
                                    <a class="btn btn-danger btn-sm delete-confirm" id="">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4 7l16 0"></path>
                                            <path d="M10 11l0 6"></path>
                                            <path d="M14 11l0 6"></path>
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                        </svg>
                                    </a>
                                </form>
                                </div>
                                </td>
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
<!-- modal tambah data -->
<div class="modal modal-blur fade" id="modal-inputkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Data Karyawan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/karyawan/store" method="POST"  id="frmKaryawan" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                    <div class="form-label">Masukan Nomor Induk Karyawan</div>
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-123" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M3 10l2 -2v8"></path>
                        <path d="M9 8h3a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 0 -1 1v2a1 1 0 0 0 1 1h3"></path>
                        <path d="M17 8h2.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-1.5h1.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-2.5"></path>
                        </svg>
                        </span>
                        <input type="text" value="" id="nik" class="form-control" name="nik"  placeholder="NIK">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="form-label">Masukan Nama Lengkap</div>
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        </svg>
                        </span>
                        <input type="text" value="" id="nama_lengkap" class="form-control" name="nama_lengkap" placeholder="Nama Karyawan">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="form-label">Masukan Jabatan</div>
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id-badge-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M7 12h3v4h-3z"></path>
                        <path d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6"></path>
                        <path d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z"></path>
                        <path d="M14 16h2"></path>
                        <path d="M14 12h4"></path>
                        </svg>
                        </span>
                        <input type="text" value="" id="jabatan"  class="form-control" name="jabatan" placeholder="Jabatan">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="form-label">Masukan No HP</div>
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                        </svg>
                        </span>
                        
                        <input type="text" value=""  id="no_hp" class="form-control" name="no_hp" placeholder="No Handphone">
                    </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-12">
                        <div class="form-label">Pilih Departemen</div>
                        <select name="kode_dpt" id="kode_dpt" class="form-select">
                            <option value="">Departemen</option>
                            @foreach($departemen as $d)
                            <option {{ Request('kode_dpt')==$d->kode_dpt ? 'selected' : ''}} value="{{ $d->kode_dpt }}">{{ $d->nama_dpt }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="form-label">Masukan foto</div>
                            <input type="file" name="foto" class="form-control">
                    </div>
                </div>
                <div class="row mt-4">
                <div class="col-12">
                    <div class="form-group">
                        <button class="btn btn-primary w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M10 14l11 -11"></path>
                        <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5"></path>
                        </svg>
                        Simpan
                        </button>
                    </div>
                </div>
            </div>
            </form>
            
        </div>
        </div>
    </div>
</div>

<!-- modal edit data -->
<div class="modal modal-blur fade" id="modal-editkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Data Karyawan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="loadeditform">

            
        </div>
        </div>
    </div>
</div>
@endsection
@push('myscript')
<script>
    $(function(){
        $("#btnTambahKaryawan").click(function(){
            $("#modal-inputkaryawan").modal("show");
        });

        $(".edit").click(function(){
            var nik = $(this).attr('nik');
            $.ajax({
                type:'POST',
                url: '/karyawan/edit',
                cache : false,
                data : {
                    _token:"{{ csrf_token() }}",
                    nik:nik
                },
                success:function(respond){
                    $("#loadeditform").html(respond);
                }
            });
            $("#modal-editkaryawan").modal("show");
        });

        $(".delete-confirm").click(function(e){
            var form = $(this).closest('form');
            Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data yang terhapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire(
                'Deleted!',
                'Data Berhasil Terhapus',
                'success'
                )
            }
            })
        });

        $("#frmKaryawan").submit(function(){
            var nik = $("#nik").val();
            var nama_lengkap = $("#nama_lengkap").val();
            var jabatan = $("#jabatan").val();
            var no_hp = $("#no_hp").val();
            var kode_dpt = $("frmKaryawan").find("#kode_dpt").val();

            if(nik == ""){
                $("#nik").focus();
                Swal.fire({
                    title: 'Warning!',
                    text: 'NIK Harus Di isi',
                    icon: 'warning',
                })
                return false;
            } else if (nama_lengkap == ""){
                $("#nama_lengkap").focus();
                Swal.fire({
                    title: 'Warning!',
                    text: 'Nama Lengkap Harus Di isi',
                    icon: 'warning',
                })
                return false;
            } else if (jabatan == ""){
                $("#jabatan").focus();
                Swal.fire({
                    title: 'Warning!',
                    text: 'Jabatan Harus Di isi',
                    icon: 'warning',
                })
                return false;
            } else if (no_hp == ""){
                $("#no_hp").focus();
                Swal.fire({
                    title: 'Warning!',
                    text: 'No HP Harus Di isi',
                    icon: 'warning',
                })
                return false;
            } else if (kode_dpt == ""){
                $("#kode_dpt").focus();
                Swal.fire({
                    title: 'Warning!',
                    text: 'Departemen Harus Di isi',
                    icon: 'warning',
                })
                return false;
            }
            
        });
    });
</script>
@endpush