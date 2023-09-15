<form action="/departemen/{{ $departemen->kode_dpt }}/update" method="POST"  id="frmDepartemen">
                @csrf
                <div class="row">
                    <div class="col-12">
                    <div class="form-label">Masukan Kode Departemen</div>
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-123" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M3 10l2 -2v8"></path>
                        <path d="M9 8h3a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 0 -1 1v2a1 1 0 0 0 1 1h3"></path>
                        <path d="M17 8h2.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-1.5h1.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-2.5"></path>
                        </svg>
                        </span>
                        <input type="text" value="{{ $departemen->kode_dpt }}" id="kode_dpt" class="form-control" name="kode_dpt"  placeholder="Kode Departemen" readonly>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="form-label">Masukan Nama Departemen</div>
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        </svg>
                        </span>
                        <input type="text" value="{{ $departemen->nama_dpt }}" id="nama_dpt" class="form-control" name="nama_dpt" placeholder="Nama Departemen">
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