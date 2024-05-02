<?php

namespace App\Livewire;

use App\Models\guru;
use App\Models\HasilPerhitungan;
use App\Models\Kriteria;
use App\Models\SettingBonus;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Illuminate\Support\Facades\DB;

class ProsesPerhitungan extends Component implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $matrikKeputusan;
    public $matrikNormalisasi;
    public $mean;
    public $variasiPreferensi;
    public $totalKriteria;
    public $omega;
    public $bobot;

    public function render()
    {
        $kriteria = Kriteria::all();
        $alternatif = guru::pluck('kode_guru')->toArray();
        return view('livewire.proses-perhitungan',compact('kriteria','alternatif'));
    }

    public function proses()
    {

        $alternatifs = guru::orderBy('kode_guru')->get();
        $kriterias  = Kriteria::orderBy('kode')->get('tipe_id')->toArray();

        // penentuan matriks keputusan
        $Xij = [];
        foreach ($alternatifs as $ka => $alt) {
            $nilai = DB::table('guru_has_kriteria')
                    ->where('guru_id',$alt->id)
                    ->get();
            foreach ($nilai as $kk => $krit) {
                $Xij[$ka][$kk] = $krit->nilai;
            }
        }

        $this->matrikKeputusan = $Xij;

        // normalisasi matriks keputusan
        $rows = count($Xij);
        $cols = count($Xij[0]);
        $Nij = [];
        for ($j = 0; $j < $cols; $j++) {
            $xj = [];
            for ($i = 0; $i < $rows; $i++) {
                $xj[] = $Xij[$i][$j];
            }

            $divisor = max($xj);
            $cost = false;
            if ($kriterias[$j]['tipe_id'] == 2) {
                $cost = true;
                $divisor = min($xj);
            }

            foreach ($xj as $kj => $x) {
                $Nij[$kj][$j] = $cost ? ($divisor / $x) : ($x / $divisor);
            }
        }

        $this->matrikNormalisasi = $Nij;

        // menjumlahkan elemen tiap kolom matriks
        $EN = [];
        for ($i = 0; $i < $cols; $i++) {
            $jumlah = 0;
            for ($j = 0; $j < $rows; $j++) {
                $jumlah += $Nij[$j][$i];
            }
            $EN[] = $jumlah;
        }

        // hitung nilai mean
        $N = [];
        foreach ($EN as $e) {
            $N[] = $e / $rows;
        }

        $this->mean = $N;


        // hitung variasi preferensi
        $Tj = [];
        for ($i = 0; $i < $cols; $i++) {
            for ($j = 0; $j < $rows; $j++) {
                // fungsi pow adalah pengangkatan
                $Tj[$j][$i] = pow($Nij[$j][$i] - $N[$i], 2);
            }
        }


        $this->variasiPreferensi = $Tj;


        // hitung total tiap kriteria
        $TTj = [];
        for ($i = 0; $i < $cols; $i++) {
            $jumlah = 0;
            for ($j = 0; $j < $rows; $j++) {
                $jumlah += $Tj[$j][$i];
            }
            $TTj[] = $jumlah;
        }

        $this->totalKriteria = $TTj;


        // menentukan penyimpangan nilai preferensi
        $Omega = [];
        foreach ($TTj as  $ttj) {
            $Omega[] = 1 - $ttj;
        }

        $this->omega = $Omega;

        // total penyimpangan nilai preferensi
        $EOmega = array_sum($Omega);

        // menghitung kriteria bobot
        $Wj = [];
        foreach ($Omega as $o) {
            $Wj[] = $o / $EOmega;
        }

        $this->bobot = $Wj;

        // menghitung PSI
        $ThetaI = [];
        for ($i = 0; $i < $cols; $i++) {
            for ($j = 0; $j < $rows; $j++) {
                $ThetaI[$j][$i] = $Nij[$j][$i] * $Wj[$i];
            }
        }

        // penjumlahan tiap baris proses sebelumnya
        $TThetaI = [];
        foreach ($ThetaI as $theta) {
            $TThetaI[] = array_sum($theta);
        }

        foreach ($alternatifs as $key => $alternatif) {
            $alternatif->nilai = round($TThetaI[$key], 4);
        }
        $sorted = $alternatifs->sortByDesc('nilai');
        foreach ($sorted->values()->all() as $key => $data) {
            $dataBonus = SettingBonus::where('mulai_dari','<=',$key+1)->where('sampai_ke','>=',$key+1)->first();
            HasilPerhitungan::updateOrCreate([
                'guru_id' => $data->id,
            ],
            [
                'nilai' => $data->nilai,
                    'ranking' => $key+1,
                    'bonus' => $dataBonus->jumlah_bonus ?? 0
            ]);
        }

        return $alternatifs;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(HasilPerhitungan::query()->orderBy('ranking'))
            ->columns(
                [
                    TextColumn::make('id')->label('#')->rowIndex(),
                    TextColumn::make('ranking')->label('Ranking'),
                    TextColumn::make('guru.kode_guru')->label('Kode Guru')->searchable(),
                    TextColumn::make('guru.nama_lengkap')->label('Nama Lengkap')->searchable(),
                    TextColumn::make('nilai')->label('Nilai')->searchable(),
                    TextColumn::make('bonus')->numeric()->prefix('Rp.')->label('Bonus Gaji')->searchable(),
                    TextColumn::make('guru.gaji_pokok')->numeric()->prefix('Rp.')->label('Gaji Pokok')->searchable(),
                    ViewColumn::make('total_gaji')->view('perhitungan.totalGaji')
                ]
            );
    }
}
