<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PushNotificationResource\Pages;
use App\Filament\Resources\PushNotificationResource\RelationManagers;
use App\Helpers\TableHelper;
use App\Models\PushNotification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PushNotificationResource extends Resource
{
    protected static ?string $model = PushNotification::class;

    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'News & Notifications';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('body')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('news_id')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\IconColumn::make('news_exists')
                    ->exists('news'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                TableHelper::filterCreatedAt(),
            ])
            ->actions([
                Tables\Actions\Action::make('News')
                    ->url(fn (PushNotification $pushNotification): string => route('filament.admin.resources.news.edit', $pushNotification->news_id))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-newspaper')
                    ->hidden(function (PushNotification $pushNotification) {
                        return is_null($pushNotification->news_id);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
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
            'index' => Pages\ListPushNotifications::route('/'),
            'create' => Pages\CreatePushNotification::route('/create'),
            'edit' => Pages\EditPushNotification::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
