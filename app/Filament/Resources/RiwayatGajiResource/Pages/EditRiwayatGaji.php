<?php

namespace App\Filament\Resources\RiwayatGajiResource\Pages;

use App\Filament\Resources\RiwayatGajiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRiwayatGaji extends EditRecord
{
    protected static string $resource = RiwayatGajiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
