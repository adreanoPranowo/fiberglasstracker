@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none" style="margin-top: 20px;">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <div class="page-pretitle">Kantor Cabang</div>
        <h2 class="page-title">Data Kantor Cabang</h2>
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
                                <a href="#" class="btn btn-primary" id="btnTambahCabang">
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
                            <form action="/cabang" method="GET">
                                <div class="row">
                                    <div class="col-10">
                                       {{-- <select name="kode_cabang" class="form-select" id="">
                                            <option value="">Semua Cabang</option>
                                            @foreach ($cabang as $d )
                                                <option {{ Request('kode_cabang')==$d->kode_cabang ? 'selected' : '' }}  value="{{ $d->kode_cabang }}">{{ $d->nama_cabang }}</option>
                                            @endforeach
                                       </select> --}}
                                    </div>
                                    <div class="col-2">
                                        {{-- <div class="form-group">
                                            <button type="submit" class="btn btn-primary w-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                            <path d="M21 21l-6 -6"></path>
                                            </svg>
                                            Cari
                                            </button>
                                        </div> --}}
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
                            <th>KODE CABANG</th>
                            <th>NAMA CABANG</th>
                            <th>LOKASI</th>
                            <th>RADIUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cabang as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->kode_cabang }}</td>
                                <td>{{ $d->nama_cabang }}</td>
                                <td>{{ $d->lokasi_cabang }}</td>
                                <td>{{ $d->radius_cabang }} Meter</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="edit btn btn-info btn-sm" kode_cabang="{{ $d->kode_cabang }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                <path d="M16 5l3 3"></path>
                                            </svg>
                                        </a>
                                            <form action="/cabang/{{ $d->kode_cabang }}/delete" method="POST"  style="margin-left : 5px">
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
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal tambah data -->
<div class="modal modal-blur fade" id="modal-inputcabang" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Data Cabang</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/cabang/store" method="POST"  id="frmCabang">
                @csrf
                <div class="row">
                    <div class="col-12">
                    <div class="form-label">Masukan Kode Cabang</div>
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-123" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M3 10l2 -2v8"></path>
                        <path d="M9 8h3a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 0 -1 1v2a1 1 0 0 0 1 1h3"></path>
                        <path d="M17 8h2.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-1.5h1.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-2.5"></path>
                        </svg>
                        </span>
                        <input type="text" value="" id="kode_cabang" class="form-control" name="kode_cabang"  placeholder="Kode Cabang">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="form-label">Masukan Nama Cabang</div>
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M9 8l1 0" /><path d="M9 12l1 0" /><path d="M9 16l1 0" /><path d="M14 8l1 0" /><path d="M14 12l1 0" /><path d="M14 16l1 0" /><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" /></svg>
                        </span>
                        <input type="text" value="" id="nama_cabang" class="form-control" name="nama_cabang" placeholder="Nama Cabang">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="form-label">Masukan Lokasi Cabang</div>
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5" /><path d="M9 4v13" /><path d="M15 7v5.5" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /></svg>
                        </span>
                        <input type="text" value="" id="lokasi_cabang" class="form-control" name="lokasi_cabang" placeholder="Lokasi Cabang">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="form-label">Masukan Radius Cabang</div>
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-radar-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                <path d="M15.51 15.56a5 5 0 1 0 -3.51 1.44"></path>
                                <path d="M18.832 17.86a9 9 0 1 0 -6.832 3.14"></path>
                                <path d="M12 12v9"></path>
                            </svg>
                        </span>
                        <input type="text" value="" id="radius_cabang" class="form-control" name="radius_cabang" placeholder="Radius Cabang">
                    </div>
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
<div class="modal modal-blur fade" id="modal-editcabang" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Data Cabang</h5>
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
        $("#btnTambahCabang").click(function(){
            $("#modal-inputcabang").modal("show");
        });

        $(".edit").click(function(){
            var kode_cabang = $(this).attr('kode_cabang');
            $.ajax({
                type:'POST',
                url: '/cabang/edit',
                cache : false,
                data : {
                    _token:"{{ csrf_token() }}",
                    kode_cabang : kode_cabang
                },
                success:function(respond){
                    $("#loadeditform").html(respond);
                }
            });
            $("#modal-editcabang").modal("show");
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
        
        $("#frmCabang").submit(function(){
            var kode_cabang = $("#kode_cabang").val();
            var nama_cabang = $("#nama_cabang").val();
            var lokasi_cabang = $("#lokasi_cabang").val();
            var radius_cabang = $("#radius_cabang").val();

            if(kode_cabang == ""){
                $("#kode_cabang").focus();
                Swal.fire({
                    title: 'Warning!',
                    text: 'Kode Cabang Harus Diisi',
                    icon: 'warning',
                })
                return false;
            } else if(nama_cabang == ""){
                $("#nama_cabang").focus();
                Swal.fire({
                    title: 'Warning!',
                    text: 'Nama Cabang Harus Diisi',
                    icon: 'warning',
                })
                return false;
            }  else if(lokasi_cabang == ""){
                $("#lokasi_cabang").focus();
                Swal.fire({
                    title: 'Warning!',
                    text: 'Lokasi Cabang Harus Diisi',
                    icon: 'warning',
                })
                return false;
            } else if(radius_cabang == ""){
                $("#radius_cabang").focus();
                Swal.fire({
                    title: 'Warning!',
                    text: 'Radus Cabang Harus Diisi',
                    icon: 'warning',
                })
                return false;
            } 
            
        });
    });
</script>
@endpush