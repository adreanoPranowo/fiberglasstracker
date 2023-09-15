@foreach($presensi as $d)
@php
    $foto_in = Storage::url('uploads/absensi/'.$d->foto_in);
    $foto_out = Storage::url('uploads/absensi/'.$d->foto_out);
@endphp
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $d->nik}}</td>
    <td>{{ $d->nama_lengkap}}</td>
    <td>{{ $d->nama_dpt}}</td>
    <td>{{ $d->jam_in}}</td>
    <td>
        <img src="{{ url($foto_in) }}" class="avatar" alt="">
    </td>
    <td>{{  $d->jam_out != null ? $d->jam_out : 'Belum Absen'  }}</td>
    <td>
        @if($d->jam_out != null)
        <img src="{{ url($foto_out) }}" class="avatar" alt="">
        @else
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-3" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
        <path d="M12 12h3.5"></path>
        <path d="M12 7v5"></path>
        </svg>
        @endif
    </td>
    <td>
        @if($d->jam_in > "08:00")
        <span class="badge bg-danger" style="color:white">Terlambat</span>
        @else
        <span class="badge bg-success" style="color:white">Tepat Waktu</span>
        @endif
    </td>
</tr>
@endforeach