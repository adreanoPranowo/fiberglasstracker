@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none" style="margin-top: 20px;">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <div class="page-pretitle">Konfigurasi</div>
        <h2 class="page-title">Jam Kerja</h2>
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
                          <a href="#" class="btn btn-primary" id="btnTambahJK">
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
                    <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode JK</th>
                        <th>Nama JK</th>
                        <th>Awal Jam Masuk</th>
                        <th>Jam Masuk</th>
                        <th>Akhir Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jam_kerja as $d)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $d->kode_jam_kerja }}</td>
                      <td>{{ $d->nama_jam_kerja }}</td>
                      <td>{{ $d->awal_jam_masuk }}</td>
                      <td>{{ $d->jam_masuk }}</td>
                      <td>{{ $d->akhir_jam_masuk }}</td>
                      <td>{{ $d->jam_pulang }}</td>
                      <td><div class="btn-group">
                        <a href="#" class="edit btn btn-info btn-sm" kode_jam_kerja="{{ $d->kode_jam_kerja }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                            </svg>
                        </a>
                            <form action="/konfigurasi/{{ $d->kode_jam_kerja }}/delete" method="POST"  style="margin-left : 5px">
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
                    </div></td>
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
{{-- modal tambah data jam kerja --}}
<div class="modal modal-blur fade" id="modal-inputJK" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">Tambah Data Jam Kerja</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="/konfigurasi/storejamkerja" method="POST"  id="frmJK">
              @csrf
              <div class="row">
                <div class="col-12">
                <div class="form-label">Masukan Kode JK</div>
                <div class="input-icon mb-3">
                    <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-123" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M3 10l2 -2v8"></path>
                    <path d="M9 8h3a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 0 -1 1v2a1 1 0 0 0 1 1h3"></path>
                    <path d="M17 8h2.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-1.5h1.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-2.5"></path>
                    </svg>
                    </span>
                    <input type="text" value="" id="kode_jam_kerja" class="form-control" name="kode_jam_kerja"  placeholder="Kode Jam Kerja">
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                <div class="form-label">Masukan Nama JK</div>
                <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-123" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M3 10l2 -2v8"></path>
                  <path d="M9 8h3a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 0 -1 1v2a1 1 0 0 0 1 1h3"></path>
                  <path d="M17 8h2.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-1.5h1.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-2.5"></path>
                  </svg>
                  </span>
                  <input type="text" value="" id="nama_jam_kerja" class="form-control" name="nama_jam_kerja"  placeholder="Nama Jam Kerja">
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                <div class="form-label">Masukan Awal Jam Masuk</div>
                <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>
                  </span>
                  <input type="text" value="" id="awal_jam_masuk" class="form-control" name="awal_jam_masuk"  placeholder="Awal Jam Masuk">
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                <div class="form-label">Masukan Jam Masuk</div>
                <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>
                  </span>
                  <input type="text" value="" id="jam_masuk" class="form-control" name="jam_masuk"  placeholder="Jam Masuk">
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                <div class="form-label">Masukan Akhir Jam Masuk</div>
                <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>
                  </span>
                  <input type="text" value="" id="akhir_jam_masuk" class="form-control" name="akhir_jam_masuk"  placeholder="Akhir Jam Masuk">
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                <div class="form-label">Masukan Jam Pulang</div>
                <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>
                  </span>
                  <input type="text" value="" id="jam_pulang" class="form-control" name="jam_pulang"  placeholder="Jam Pulang">
                </div>
                </div>
              </div>
              <div class="row mt-2">
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
<div class="modal modal-blur fade" id="modal-editJK" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">Edit Data Jam Kerja</h5>
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
        $("#btnTambahJK").click(function(){
            $("#modal-inputJK").modal("show");
        });

        $(".edit").click(function(){
            var kode_jam_kerja = $(this).attr('kode_jam_kerja');
            $.ajax({
                type:'POST',
                url: '/konfigurasi/editjamkerja',
                cache : false,
                data : {
                    _token:"{{ csrf_token() }}",
                    kode_jam_kerja : kode_jam_kerja
                },
                success:function(respond){
                    $("#loadeditform").html(respond);
                }
            });
            $("#modal-editJK").modal("show");
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
        
        $("#frmJK").submit(function(){
            var kode_jam_kerja = $("#kode_jam_kerja").val();
            var nama_jam_kerja = $("#nama_jam_kerja").val();
            var awal_jam_masuk = $("#awal_jam_masuk").val();
            var jam_masuk = $("#jam_masuk").val();
            var akhir_jam_masuk = $("#akhir_jam_masuk").val();
            var jam_pulang = $("#jam_pulang").val();

            if(kode_jam_kerja == ""){
                $("#kode_jam_kerja").focus();
                Swal.fire({
                    title: 'Warning!',
                    text: 'Kode Jam Kerja Harus Diisi',
                    icon: 'warning',
                })
                return false;
            } else if(nama_jam_kerja == ""){
                $("#nama_jam_kerja").focus();
                Swal.fire({
                    title: 'Warning!',
                    text: 'Nama Jam Kerja Harus Diisi',
                    icon: 'warning',
                })
                return false;
            }  else if(awal_jam_masuk == ""){
                $("#awal_jam_masuk").focus();
                Swal.fire({
                    title: 'Warning!',
                    text: 'Awal Jam Masuk Harus Diisi',
                    icon: 'warning',
                })
                return false;
            } else if(jam_masuk == ""){
                $("#jam_masuk").focus();
                Swal.fire({
                    title: 'Warning!',
                    text: 'Jam Masuk Harus Diisi',
                    icon: 'warning',
                })
                return false;
            } else if(akhir_jam_masuk == ""){
                $("#akhir_jam_masuk").focus();
                Swal.fire({
                    title: 'Warning!',
                    text: 'Akhir Jam Masuk Harus Diisi',
                    icon: 'warning',
                })
                return false;
            } else if(jam_pulang == ""){
                $("#jam_pulang").focus();
                Swal.fire({
                    title: 'Warning!',
                    text: 'Jam Pulang Harus Diisi',
                    icon: 'warning',
                })
                return false;
            } 
            
        });
      });
    </script>
@endpush