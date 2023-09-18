<?php
function selisih($jam_masuk, $jam_keluar) {
    list($h, $m, $s) = explode(":", $jam_masuk);
    $dtAwal = mktime($h, $m, $s, "1", "1", "1");
    list($h, $m, $s) = explode(":", $jam_keluar);
    $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
    $dtSelisih = $dtAkhir - $dtAwal;
    $totalmenit = $dtSelisih / 60;
    $jam = explode(".", $totalmenit / 60);
    $sisamenit = ($totalmenit / 60) - $jam[0];
    $sisamenit2 = $sisamenit * 60;
    $jml_jam = $jam[0];
    return $jml_jam . ":" . round($sisamenit2);
}
?>
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
        @php
         $jamterlambat = selisih('08:00:00', $d->jam_in);
        @endphp
        <span class="badge bg-danger" style="color:white">Terlambat {{ $jamterlambat }} Jam</span>
        @else
        <span class="badge bg-success" style="color:white">Tepat Waktu</span>
        @endif
    </td>
    <td>
        <a href="#" class="tampilkanpeta" id="{{ $d->id }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7"></path>
        <path d="M9 4v13"></path>
        <path d="M15 7v5"></path>
        <path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z"></path>
        <path d="M19 18v.01"></path>
        </svg>
        </a>
    </td>
</tr>
@endforeach

<script>
    $(function(){
        $(".tampilkanpeta").click(function(e){
            var id = $(this).attr("id");
            $.ajax({
                type:'POST',
                url: '/tampilkanpeta',
                data : {
                    _token: "{{ csrf_token() }}",
                    id : id
                },
                cache : false,
                success:function(respond){
                    $("#loadmap").html(respond);
                }
            });

            $("#modal-tampilkanpeta").modal("show");
        });
    });
</script>