<?php

namespace App\Filament\Seller\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('discount')
                    ->required()
                    ->label("Discount in %")
                    ->suffix('%')
                    ->numeric()
                    ->default(0),
                RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),

                Repeater::make("product_varients")
                    ->relationship('product_varients')
                    ->label('Varients')
                    ->columnSpanFull()
                    ->grid(2)
                    ->schema([
                        TextInput::make('title')
                            ->required(),
                        TextInput::make('price')
                            ->numeric()
                            ->prefix('Rs.')
                            ->required(),
                        FileUpload::make('images')
                            ->multiple()
                            ->downloadable()
                            ->required(),
                    ]),
            ]);
    }
}
