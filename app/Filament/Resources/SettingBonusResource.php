<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingBonusResource\Pages;
use App\Filament\Resources\SettingBonusResource\RelationManagers;
use App\Models\SettingBonus;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use LaraZeus\Quantity\Components\Quantity;

class SettingBonusResource extends Resource
{
    protected static ?string $model = SettingBonus::class;

    protected static ?string $navigationIcon = 'heroicon-s-cog';

    public static function getNavigationGroup(): ?string
    {
        return 'Penggajian';
    }

    public static function getNavigationLabel(): string
    {
        return 'Pengaturan Bonus';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->label('Nama Rentang')->required(),
                Quantity::make('mulai_dari')->numeric()->label('Mulai Dari')->required(),
                Quantity::make('sampai_ke')->numeric()->label('Sampai Ke')->required(),
                TextInput::make('jumlah_bonus')->currencyMask(thousandSeparator:'.',decimalSeparator:',',precision:0)->prefix('Rp.')->label('Jumlah Bonus')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettingBonuses::route('/'),
            'create' => Pages\CreateSettingBonus::route('/create'),
            'edit' => Pages\EditSettingBonus::route('/{record}/edit'),
        ];
    }
}
