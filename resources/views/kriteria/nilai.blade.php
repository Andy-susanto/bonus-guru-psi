<div>
    @php
        $nilai = \DB::table('guru_has_kriteria')->where('kriteria_id',$kriteria->id)->where('guru_id',$getRecord()->id)->first();
    @endphp
    {{$nilai ? $nilai->nilai : 'Belum Di Nilai'}}
</div>

