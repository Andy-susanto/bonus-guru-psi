<?php

namespace App\Filament\Resources\SettingBonusResource\Pages;

use App\Filament\Resources\SettingBonusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSettingBonuses extends ListRecords
{
    protected static string $resource = SettingBonusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->size('xs')->label('Tambahkan Data Baru')->icon('heroicon-s-plus-circle'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
