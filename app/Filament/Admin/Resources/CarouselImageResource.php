<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CarouselImageResource\Pages;
use App\Filament\Admin\Resources\CarouselImageResource\RelationManagers;
use App\Models\CarouselImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CarouselImageResource extends Resource
{
    protected static ?string $model = CarouselImage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('images')
                    ->multiple()
                    ->image()
                    ->disk('public')
                    ->directory('carousel')
                    ->storeFileNamesIn('images')
                    ->maxFiles(3)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif'])
                    ->maxSize(5120) // 5MB max per file
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('images')
                    ->stacked()
                    ->limit(3)
                    ->limitedRemainingText()
                    ->circular(),
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
            'index' => Pages\ListCarouselImages::route('/'),
            'create' => Pages\CreateCarouselImage::route('/create'),
            // 'edit' => Pages\EditCarouselImage::route('/{record}/edit'),
        ];
    }
}
