<?php

namespace App\Filament\Organizer\Resources;

use App\Filament\Organizer\Resources\PaymentRequestResource\Pages;
use App\Models\Checkout;
use App\Models\PaymentRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class PaymentRequestResource extends Resource
{
    protected static ?string $model = PaymentRequest::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Payment Requests';
    protected static ?string $recordTitleAttribute = 'amount';

    public static function canDelete($record): bool
    {
        return $record->status === 'pending';
    }

    public static function canEdit($record): bool
    {
        return $record->status === 'pending';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('organizer_id')
                    ->default(Auth::id())
                    ->required(),
               Forms\Components\TextInput::make('amount')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->default(fn () => Checkout::where('organizer_id', Auth::id())->sum('total_amount') - PaymentRequest::where('organizer_id', Auth::id())->where('status', 'approved')->sum('amount'))
                    ->maxValue(fn () => Checkout::where('organizer_id', Auth::id())->sum('total_amount') - PaymentRequest::where('organizer_id', Auth::id())->where('status', 'approved')->sum('amount'))
                    ->prefix('NRs.')
                    ->helperText(fn () =>
                        'You can only withdraw up to NRs. ' . number_format(Checkout::where('organizer_id', Auth::id())->sum('total_amount') - PaymentRequest::where('organizer_id', Auth::id())->where('status', 'approved')->sum('amount'), 0) . '.' .
                        ' Note: A 10% event charge will be deducted from the requested amount.'
                    ),
                Forms\Components\TextInput::make('bank_name')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('bank_account_name')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('bank_account_number')
                    ->maxLength(255)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('amount')
                    ->money('NPR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('bank_name')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('bank_account_name')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('bank_account_number')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->modifyQueryUsing(fn ($query) => $query->where('organizer_id', Auth::id()));
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaymentRequests::route('/'),
            'create' => Pages\CreatePaymentRequest::route('/create'),
            // 'edit' => Pages\EditPaymentRequest::route('/{record}/edit'),
        ];
    }
}
