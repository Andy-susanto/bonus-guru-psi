<?php

namespace App\Livewire;

use App\Models\guru;
use Livewire\Component;
use App\Models\Kriteria;
use Filament\Forms\Form;
use App\Models\SubKriteria;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Tables\Concerns\InteractsWithTable;
use GrahamCampbell\ResultType\Success;

class FormPenilaian extends Component implements HasForms
{

    use InteractsWithForms;

    public $record;

    public ?array $data = [];

    public function mount($record)
    {
        $this->record = $record;
        $cek = DB::table('guru_has_kriteria')->where('guru_id',$record)->pluck('nilai','kriteria_id')->toArray();
        $this->form->fill($cek);
    }

    public function render()
    {
        return view('livewire.form-penilaian');
    }

    protected function schema()
    {
        $kriterias = Kriteria::all();
        $data = [];
        foreach ($kriterias as $key => $kriteria) {
            $forms = Select::make("$kriteria->id")
                ->preload()
                ->searchable()
                ->label("$kriteria->nama_kriteria")
                ->native(false)
                ->options(SubKriteria::where('kriteria_id', $kriteria->id)->pluck('nama_subkriteria', 'bobot')->toArray());
            array_push($data, $forms);
        }

        return $data;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema($this->schema())
            ->statePath('data');
    }

    public function create()
    {
        $data =  $this->form->getState();
        $key  = array_keys($data);

        for ($i = 0; $i < count($data); $i++) {
            DB::table('guru_has_kriteria')
                ->updateOrInsert(
                    [
                        'guru_id' => $this->record,
                        'kriteria_id' => $key[$i]
                    ],
                    [
                        'nilai' => $data[$key[$i]]
                    ]
                );
        }

        Notification::make()
            ->title('Nilai telah diperbaharui')
            ->success()
            ->send();

        return redirect(route('filament.admin.pages.penilaian'));

    }
}
