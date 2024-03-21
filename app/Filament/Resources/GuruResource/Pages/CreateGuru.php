<?php

namespace App\Filament\Resources\GuruResource\Pages;

use App\Filament\Resources\GuruResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\guru as Guru;

class CreateGuru extends CreateRecord
{
    protected static string $resource = GuruResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $guru = Guru::latest('id')->first();
        $data['kode_guru'] = "A".str_pad($guru->id+1,2,0,STR_PAD_LEFT);
        return $data;
    }
}
