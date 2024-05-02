<div>
    <x-filament::button size="xs" icon="heroicon-s-calculator" wire:click='proses'>
        Proses Perhitungan
    </x-filament::button>
    @if ($matrikKeputusan)
        <x-filament::section class="mt-4">
            <x-slot name="heading">
                Matrik Keputusan
            </x-slot>
            @php
                $keysMatrik = array_keys($matrikKeputusan);
            @endphp
            <table>
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        @foreach ($kriteria as $dataKriteria)
                            <th>{{ $dataKriteria->kode }}</th>
                        @endforeach
                    </tr>
                </thead>
                @for ($i = 0; $i < count($matrikKeputusan); $i++)
                    <tr>
                        <td>{{ $alternatif[$i] }}</td>
                        @foreach ($matrikKeputusan[$keysMatrik[$i]] as $key => $valueMatrik)
                            <td class="p-3">{{ $valueMatrik }}</td>
                        @endforeach
                    </tr>
                @endfor
            </table>
        </x-filament::section>
    @endif
    @if ($matrikNormalisasi)
        <x-filament::section class="mt-4">
            <x-slot name="heading">
                Matrik Normalisasi Keputusan
            </x-slot>
            @php
                $keysNormalisasi = array_keys($matrikNormalisasi);
            @endphp
            <table>
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        @foreach ($kriteria as $dataKriteria)
                            <th>{{ $dataKriteria->kode }}</th>
                        @endforeach
                    </tr>
                </thead>
                @for ($i = 0; $i < count($matrikNormalisasi); $i++)
                    <tr>
                        <td>{{ $alternatif[$i] }}</td>
                        @foreach ($matrikNormalisasi[$keysNormalisasi[$i]] as $key => $valueNormalisasi)
                            <td class="p-3">{{ $valueNormalisasi }}</td>
                        @endforeach
                    </tr>
                @endfor
            </table>
        </x-filament::section>
    @endif
    @if ($mean)
        <x-filament::section class="mt-4">
            <x-slot name="heading">
                Hitung Nilai Mean
            </x-slot>
            <table>
                <thead>
                    <tr>
                        @foreach ($kriteria as $dataKriteria)
                            <th>{{ $dataKriteria->kode }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tr>
                    @for ($i = 0; $i < count($mean); $i++)
                        <td class="p-3"><span>{{ $mean[$i] }}</span></td>
                    @endfor
                </tr>
            </table>
        </x-filament::section>
    @endif
    @if ($variasiPreferensi)
        <x-filament::section class="mt-4">
            <x-slot name="heading">
                Variasi Preferensi
            </x-slot>
            @php
                $keysVariasiPreferensi = array_keys($variasiPreferensi);
            @endphp
            <table>
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        @foreach ($kriteria as $dataKriteria)
                            <th>{{ $dataKriteria->kode }}</th>
                        @endforeach
                    </tr>
                </thead>
                @for ($i = 0; $i < count($variasiPreferensi); $i++)
                    <tr>
                        <td>{{ $alternatif[$i] }}</td>
                        @foreach ($variasiPreferensi[$keysVariasiPreferensi[$i]] as $key => $valuePreferensi)
                            <td class="p-3">{{ $valuePreferensi }}</td>
                        @endforeach
                    </tr>
                @endfor
            </table>
        </x-filament::section>
        @if ($totalKriteria)
            <x-filament::section class="mt-4">
                <x-slot name="heading">
                    Hitung Total Tiap Kriteria
                </x-slot>
                <table>
                    <thead>
                        <tr>
                            @foreach ($kriteria as $dataKriteria)
                                <th>{{ $dataKriteria->kode }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tr>
                        @for ($i = 0; $i < count($totalKriteria); $i++)
                            <td class="p-3"><span>{{ $totalKriteria[$i] }}</span></td>
                        @endfor
                    </tr>
                </table>
            </x-filament::section>
        @endif
        @if ($omega)
            <x-filament::section class="mt-4">
                <x-slot name="heading">
                    Penyimpangan Nilai Preferensi
                </x-slot>
                <table>
                    <thead>
                        <tr>
                            @foreach ($kriteria as $dataKriteria)
                                <th>{{ $dataKriteria->kode }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tr>
                        @for ($i = 0; $i < count($omega); $i++)
                            <td class="p-3"><span>{{ $omega[$i] }}</span></td>
                        @endfor
                    </tr>
                </table>
            </x-filament::section>
        @endif
        @if ($omega)
            <x-filament::section class="mt-4">
                <x-slot name="heading">
                    Menghitung Kriteria Bobot
                </x-slot>
                <table>
                    <thead>
                        <tr>
                            @foreach ($kriteria as $dataKriteria)
                                <th>{{ $dataKriteria->kode }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tr>
                        @for ($i = 0; $i < count($bobot); $i++)
                            <td class="p-3"><span>{{ $bobot[$i] }}</span></td>
                        @endfor
                    </tr>
                </table>
            </x-filament::section>
        @endif
    @endif
    <x-filament::section class="mt-4">
        <x-slot name="heading">
            Hasil Perhitungan
        </x-slot>
        {{ $this->table }}
    </x-filament::section>
</div>
