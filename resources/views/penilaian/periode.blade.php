<div>
    @php
        $nilai = \DB::table('guru_has_kriteria')->where('guru_id',$getRecord()->id)->first();
    @endphp
     {{$nilai ? $nilai->periode : ''}}
</div>
