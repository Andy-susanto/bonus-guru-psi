<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PsiResource\Pages;
use App\Filament\Resources\PsiResource\RelationManagers;
use App\Models\Psi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PsiResource extends Resource
{
    protected static ?string $model = Psi::class;

    protected static ?string $navigationIcon = 'heroicon-c-calculator';

    public static function getNavigationGroup(): ?string
    {
        return 'Penggajian';
    }

    public static function getNavigationLabel(): string
    {
        return 'Perhitungan PSI';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
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
            'index' => Pages\ListPsis::route('/'),
            'create' => Pages\CreatePsi::route('/create'),
            'edit' => Pages\EditPsi::route('/{record}/edit'),
        ];
    }
}
