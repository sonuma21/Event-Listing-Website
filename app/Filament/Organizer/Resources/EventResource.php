<?php

namespace App\Filament\Organizer\Resources;

use App\Filament\Organizer\Resources\EventResource\Pages;
use App\Filament\Organizer\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Closure;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function canDelete($record): bool
    {
        return $record->status === 'pending';
    }



    public static function form(Form $form): Form
    {
        $isEditing = $form->getOperation() === 'edit';

        $schema = [
            Forms\Components\TextInput::make('title')
                ->label('Event Title')
                ->required()
                ->maxLength(255)
                ->visible(! $isEditing),


            Forms\Components\DatePicker::make('date')
            ->required()
            ->minDate(now()->format('Y-m-d')) // Only allows today's date or future dates
            ->rules([
                fn (string $operation): Closure => function (string $attribute, $value, Closure $fail) use ($operation) {
                    if ($operation === 'create') {
                        $selectedDate = \Carbon\Carbon::parse($value);
                        $today = \Carbon\Carbon::today();

                        if ($selectedDate->lessThan($today)) {
                            $fail('The date must be today or a future date.');
                        }
                    }
                },
            ])
            ->visible(! $isEditing),

            Forms\Components\TimePicker::make('time')
                ->required()
                ->visible(! $isEditing),

            Forms\Components\TextInput::make('location')
                ->label('Event Location')
                ->required()
                ->visible(! $isEditing),

            Forms\Components\FileUpload::make('images')
                ->label('Event Images')
                ->multiple()
                ->image()
                ->directory('event-images')
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif'])
                ->maxSize(5120)
                ->maxFiles(5),

            Forms\Components\CheckboxList::make('categories')
                ->relationship('categories', 'eng_title')
                ->label('Categories')
                ->required()
                ->visible(! $isEditing),

            Forms\Components\Radio::make('feesOption')
                ->label('Fees Option')
                ->options([
                    'required' => 'Fees Required',
                    'not-required' => 'No Fees',
                ])
                ->live()
                ->default('not-required')
                ->dehydrated(false)
                ->visible(! $isEditing),

            Forms\Components\TextInput::make('fees')
                ->label('Event Fees')
                ->numeric()
                ->prefix('NRP')
                ->minValue(0)
                ->nullable()
                ->required(fn(Forms\Get $get) => $get('feesOption') === 'required')
                ->visible(fn(Forms\Get $get) => $get('feesOption') === 'required' && ! $isEditing),

        ];

        if ($isEditing) {

            $schema[] = Forms\Components\RichEditor::make('requirements')
                ->nullable()
                ->label('Requirements')
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'bulletList',
                    'orderedList',
                    'link',
                    'undo',
                    'redo'
                ]);
        }

        return $form->schema($schema);
    }




    public static function table(Table $table): Table
    {
        $panelId = Filament::getCurrentPanel()?->getId();
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fees')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time'),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->sortable()
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->visible($panelId === 'organizer'),
                Tables\Columns\ImageColumn::make('images')
                    ->stacked()
                    ->limit(3)
                    ->limitedRemainingText()
                    ->circular(),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            // 'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
