<form action="/cabang/update" method="POST"  id="frmCabangEdit">
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
            <input type="text" value="{{ $cabang->kode_cabang }}" readonly id="kode_cabang" class="form-control" name="kode_cabang"  placeholder="Kode Cabang">
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
            <input type="text" value="{{ $cabang->nama_cabang }}" id="nama_cabang" class="form-control" name="nama_cabang" placeholder="Nama Cabang">
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
            <input type="text" value="{{ $cabang->lokasi_cabang }}" id="lokasi_cabang" class="form-control" name="lokasi_cabang" placeholder="Lokasi Cabang">
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
            <input type="text" value="{{ $cabang->radius_cabang }}" id="radius_cabang" class="form-control" name="radius_cabang" placeholder="Radius Cabang">
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
<script>
    $(function(){
        $("#frmCabangEdit").submit(function(){
            var kode_cabang = $("#frmCabangEdit").find("#kode_cabang").val();
            var nama_cabang = $("#frmCabangEdit").find("#nama_cabang").val();
            var lokasi_cabang = $("#frmCabangEdit").find("#lokasi_cabang").val();
            var radius_cabang = $("#frmCabangEdit").find("#radius_cabang").val();

            if(kode_cabang == ""){
                $("#kode_cabang").focus();
                Swal.fire({
                    title: 'Warning!',
                    text: 'Kode Cabang Harus Diisi',
                    icon: 'warning',
                })
                return false;
            } else if(nama_cabang == ""){
                $("#frmCabangEdit").find("#nama_cabang").focus();
                Swal.fire({
                    title: 'Warning!',
                    text: 'Nama Cabang Harus Diisi',
                    icon: 'warning',
                })
                return false;
            }  else if(lokasi_cabang == ""){
                $("#frmCabangEdit").find("#lokasi_cabang").focus();
                Swal.fire({
                    title: 'Warning!',
                    text: 'Lokasi Cabang Harus Diisi',
                    icon: 'warning',
                })
                return false;
            } else if(radius_cabang == ""){
                $("#frmCabangEdit").find("#radius_cabang").focus();
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