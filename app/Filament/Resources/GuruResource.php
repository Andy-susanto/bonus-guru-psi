<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuruResource\Pages;
use App\Filament\Resources\GuruResource\RelationManagers;
use App\Models\Guru;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Wallo\FilamentSelectify\Components\ButtonGroup;

class GuruResource extends Resource
{
    protected static ?string $model = Guru::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function getNavigationGroup(): ?string
    {
        return 'Data Master';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_lengkap')->columnSpanFull()->required(),
                ButtonGroup::make('jk')->options([
                    'laki-laki' => 'Laki - Laki',
                    'perempuan' => 'Perempuan',
                ])
                ->label('Jenis Kelamin')
                ->onColor('primary')
                ->offColor('gray')
                ->gridDirection('row')
                ->default('laki-laki')
                ->columns(2)
                ->required(),
                Textarea::make('alamat')->columnSpanFull(),
                TextInput::make('email')->email()->required(),
                TextInput::make('gaji_pokok')->currencyMask(thousandSeparator:'.',decimalSeparator:',',precision:0)->prefix('Rp.')->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('#')->rowIndex(),
                TextColumn::make('kode_guru')->searchable(),
                TextColumn::make('nama_lengkap')->searchable(),
                TextColumn::make('jk')->label('Jenis Kelamin')->badge()->color('info'),
                TextColumn::make('alamat'),
                TextColumn::make('email')->searchable(),
                TextColumn::make('gaji_pokok')->numeric()->prefix('Rp. ')
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
            'index' => Pages\ListGurus::route('/'),
            'create' => Pages\CreateGuru::route('/create'),
            'edit' => Pages\EditGuru::route('/{record}/edit'),
        ];
    }
}
