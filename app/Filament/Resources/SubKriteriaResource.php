<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SubKriteria;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SubKriteriaResource\Pages;
use App\Filament\Resources\SubKriteriaResource\RelationManagers;

class SubKriteriaResource extends Resource
{
    protected static ?string $model = SubKriteria::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-arrow-down';

    public static function getNavigationGroup(): ?string
    {
        return 'Data Master';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_subkriteria')
                    ->label('Nama Sub Kriteria')
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\Select::make('kriteria_id')
                    ->relationship(
                        name:'kriteria',
                        modifyQueryUsing: fn(Builder $query) => $query->orderBy('kode')->orderBy('nama_kriteria')
                    )
                    ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->kode} - {$record->nama_kriteria}")
                    ->searchable(['kode','nama_kriteria'])
                    ->preload()
                    ->native(false)
                    ->required(),
                Forms\Components\TextInput::make('bobot')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kriteria_id')
                    ->label('Kriteria')
                    ->formatStateUsing(fn($record) => "{$record->kriteria->kode} - {$record->kriteria->nama_kriteria}")
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_subkriteria')
                    ->label('Nama Sub Kriteria')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bobot')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListSubKriterias::route('/'),
            'create' => Pages\CreateSubKriteria::route('/create'),
            'edit' => Pages\EditSubKriteria::route('/{record}/edit'),
        ];
    }
}
