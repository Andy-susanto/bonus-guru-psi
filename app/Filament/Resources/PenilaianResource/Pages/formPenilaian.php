<?php

namespace App\Filament\Resources\PenilaianResource\Pages;

use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\PenilaianResource;
use Filament\Forms\Concerns\InteractsWithForms;

class formPenilaian extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected static string $resource = PenilaianResource::class;

    protected static string $view = 'filament.resources.penilaian-resource.pages.form-penilaian';

    public function mount()
    {

    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // ...
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        dd($this->form->getState());
    }

    public function getTitle(): string|Htmlable
    {
        return 'Penilaian';
    }
}
