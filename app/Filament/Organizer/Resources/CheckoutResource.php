<?php

namespace App\Filament\Organizer\Resources;

use App\Filament\Organizer\Resources\CheckoutResource\Pages;
use App\Filament\Organizer\Resources\CheckoutResource\RelationManagers;
use App\Models\Checkout;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class CheckoutResource extends Resource
{
    protected static ?string $model = Checkout::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('total_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('organizer_id')
                    ->relationship('organizer', 'name')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('event_id')
                    ->relationship('event', 'title')
                    ->required(),
                Forms\Components\TextInput::make('payment_method')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->label("Name"),

                Tables\Columns\TextColumn::make('user.email')
                    ->searchable()
                    ->label("Email"),
                Tables\Columns\TextColumn::make('event.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->numeric()
                    ->prefix("NRs. ")
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),



                Tables\Columns\TextColumn::make('payment_method')
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
                Tables\Actions\EditAction::make(),
                Action::make("Download Invoice")
                    ->url(fn(Checkout $record)=>route('invoice', $record->id), shouldOpenInNewTab:true),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('organizer_id', Auth::guard('organizer')->id());
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
            'index' => Pages\ListCheckouts::route('/'),
            'create' => Pages\CreateCheckout::route('/create'),
            // 'edit' => Pages\EditCheckout::route('/{record}/edit'),
        ];
    }
}
