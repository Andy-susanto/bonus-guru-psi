<?php

namespace App\Filament\Resources\GuruResource\Pages;

use App\Filament\Resources\GuruResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListGurus extends ListRecords
{
    protected static string $resource = GuruResource::class;

    public function getTitle(): string|Htmlable
    {
        return 'Data Guru';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->icon('heroicon-s-plus-circle')->size('xs')->label('Tambahkan Guru Baru'),
        ];
    }
}
