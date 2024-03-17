<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenilaianResource\Pages;
use App\Filament\Resources\PenilaianResource\Pages\formPenilaian;
use App\Filament\Resources\PenilaianResource\RelationManagers;
use App\Models\Penilaian;
use App\Models\PenilaianGuru;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenilaianResource extends Resource
{
    protected static ?string $model = PenilaianGuru::class;

    protected static ?string $navigationIcon = 'heroicon-s-pencil';

    public static function getNavigationGroup(): ?string
    {
        return 'Penggajian';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->rowIndex()
                    ->label('#'),
                Tables\Columns\TextColumn::make('kode')
                    ->label('Kode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('guru.nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('guru.nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable(),
                Tables\Columns\ViewColumn::make('penilaian')
                    ->view('penilaian.status')
                    ->label('Status')
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('penilaian')
                    ->label('Penilaian')
                    ->size('xs')
                    ->button()
                    ->icon('heroicon-s-pencil')
                    ->url(fn($record):string=>formPenilaian::getUrl([$record]))
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenilaians::route('/'),
            'create' => Pages\CreatePenilaian::route('/create'),
            'edit' => Pages\EditPenilaian::route('/{record}/edit'),
            'penilaian' => Pages\formPenilaian::route('/{record}/penilaian')
        ];
    }
}
