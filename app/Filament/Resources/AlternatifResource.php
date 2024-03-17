<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlternatifResource\Pages;
use App\Filament\Resources\AlternatifResource\RelationManagers;
use App\Models\Alternatif;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AlternatifResource extends Resource
{
    protected static ?string $model = Alternatif::class;

    protected static ?string $navigationIcon = 'heroicon-c-bookmark-square';

    public static function getNavigationGroup(): ?string
    {
        return 'Penggajian';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode')
                    ->required(),
                Forms\Components\Select::make('guru_id')
                    ->relationship('guru','nama_lengkap')
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('guru.nama_lengkap')
                    ->label('Nama Guru')
                    ->badge()
                    ->color('info')
                    ->searchable(),
                Tables\Columns\TextColumn::make('guru.jk')
                    ->label('Jenis Kelamin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('guru.email')
                    ->label('Email')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->button()->size('xs'),
                Tables\Actions\DeleteAction::make()->button()->size('xs'),
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
            'index' => Pages\ListAlternatifs::route('/'),
            'create' => Pages\CreateAlternatif::route('/create'),
            'edit' => Pages\EditAlternatif::route('/{record}/edit'),
        ];
    }
}
