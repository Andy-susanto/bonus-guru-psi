<?php

namespace App\Filament\Pages;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;

class Perhitungan extends Page
{

    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-s-calculator';

    protected static string $view = 'filament.pages.perhitungan';

    public static function getNavigationGroup(): ?string
    {
        return 'Perhitungan';
    }
}
