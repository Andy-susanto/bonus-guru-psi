<?php

namespace App\Filament\Resources\PsiResource\Pages;

use App\Filament\Resources\PsiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPsis extends ListRecords
{
    protected static string $resource = PsiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
