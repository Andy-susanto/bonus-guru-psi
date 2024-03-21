<?php

namespace App\Filament\Resources\SettingBonusResource\Pages;

use App\Filament\Resources\SettingBonusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSettingBonus extends EditRecord
{
    protected static string $resource = SettingBonusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
