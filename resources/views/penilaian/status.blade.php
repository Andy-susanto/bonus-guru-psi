<div>
    @if ($getRecord()->penilaian()->exists())
        <span class="text-green-500">Sudah</span>
    @else
        <span class="text-red-500">Belum</span>
    @endif
</div>
