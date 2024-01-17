<form action="/konfigurasi/updatejamkerja" method="POST"  id="frmJK">
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
          <input type="text" value="{{ $jamkerja->kode_jam_kerja }}" id="kode_jam_kerja" class="form-control" name="kode_jam_kerja"  placeholder="Kode Jam Kerja">
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
        <input type="text" value="{{ $jamkerja->nama_jam_kerja }}" id="nama_jam_kerja" class="form-control" name="nama_jam_kerja"  placeholder="Nama Jam Kerja">
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
        <input type="text" value="{{ $jamkerja->awal_jam_masuk }}" id="awal_jam_masuk" class="form-control" name="awal_jam_masuk"  placeholder="Awal Jam Masuk">
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
        <input type="text" value="{{ $jamkerja->jam_masuk }}" id="jam_masuk" class="form-control" name="jam_masuk"  placeholder="Jam Masuk">
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
        <input type="text" value="{{ $jamkerja->akhir_jam_masuk }}" id="akhir_jam_masuk" class="form-control" name="akhir_jam_masuk"  placeholder="Akhir Jam Masuk">
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
        <input type="text" value="{{ $jamkerja->jam_pulang }}" id="jam_pulang" class="form-control" name="jam_pulang"  placeholder="Jam Pulang">
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