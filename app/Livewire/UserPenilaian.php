<?php

namespace App\Livewire;

use App\Models\guru;
use App\Models\Kriteria;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class UserPenilaian extends Component implements HasTable, HasForms
{

    use InteractsWithTable;
    use InteractsWithForms;

    public function render()
    {
        return view('livewire.user-penilaian');
    }

    protected function columns()
    {
        $kriterias = Kriteria::all();
        $data = [
            TextColumn::make('id')->label('#')->rowIndex(),
            ViewColumn::make('periode')->label('Periode')->view('penilaian.periode'),
            TextColumn::make('kode_guru')->label('Kode Guru'),
            TextColumn::make('nama_lengkap')->label('Nama Lengkap')->searchable()
        ];

        foreach ($kriterias as $key => $kriteria) {
            $view = ViewColumn::make("$key$kriteria->kode")->label("$kriteria->kode")->view('kriteria.nilai',compact('kriteria'));
            array_push($data,$view);
        }

        return $data;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(guru::query())
            ->columns($this->columns())
            ->filters([
                Filter::make('periode')
                    ->label('Periode')
                    ->indicator('Periode')
                    ->form([
                        Select::make('nilai_periode')->label('Periode')
                            ->options([
                                '2024'=>'2024',
                                '2023'=>'2023'
                            ])
                            ->searchable()
                    ])->query(function(Builder $query, array $data):Builder{
                        if ($query->whereRelation('kriteria','periode',$data['nilai_periode'])->get()->toArray()) {
                           return $query->whereRelation('kriteria','periode',$data['nilai_periode']);
                        }else{
                            return $query;
                        }
                    })
            ],layout:FiltersLayout::AboveContent)
            ->actions([
                Action::make('penilaian')
                    ->label('Penilaian')
                    ->icon('heroicon-s-pencil')
                    ->size('xs')
                    ->button()
                    ->color('success')
                    ->url(fn(guru $record):string=> route('filament.admin.pages.form-penilaian-page',['record'=>$record->id]))
            ])
            ->bulkActions([
            ]);
    }
}
