<?php

namespace App\Filament\Pages;

use App\Models\guru;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Http\Request;

class FormPenilaianPage extends Page
{
    use HasPageShield;

    public $record;
    public $namaGuru;

    public function mount(Request $request){
        $this->record = $request->record;
        $this->namaGuru = guru::find($request->record)?->nama_lengkap;
    }

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public function getTitle(): string|Htmlable
    {
        return "Form Penilaian Guru ($this->namaGuru)";
    }

    protected static string $view = 'filament.pages.form-penilaian-page';

    protected static bool $shouldRegisterNavigation = false;
}
