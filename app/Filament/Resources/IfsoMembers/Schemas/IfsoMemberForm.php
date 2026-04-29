<?php

namespace App\Filament\Resources\IfsoMembers\Schemas;

use App\Models\User;
use App\PrescriberEnum;
use App\ProfessionalRoleEnum;
use App\TitleEnum;
use App\WorkplaceEnum;
use Dom\Text;
use Filament\Actions\Action;
use Filament\Actions\SelectAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;

class IfsoMemberForm
{

    public static function configure(Schema $schema): Schema
    {

        return $schema
            ->components([
                Section::make('Personal Information')
                    ->icon('heroicon-o-identification')
                    ->collapsible()
                    ->collapsed()
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        ImageEntry::make('photo')
                            ->disk('public')
                            ->columnSpanFull()
                            ->height(120)
                            ->circular(),
                        Select::make('title')
                            ->options(TitleEnum::class),
                        TextInput::make('gender'),
                        TextInput::make('first_name'),
                        TextInput::make('last_name'),
                        TextInput::make('mobile_phone'),
                        TextInput::make('email'),
                        TextInput::make('city'),
                        TextInput::make('country'),
                        PdfViewerField::make('document')
                            ->disk('public')
                            ->columnSpanFull()
                            ->label('View the PDF')
                            ->minHeight('40svh'),

                         

                    ]),
                Section::make('General Notes')
                    ->icon('heroicon-o-pencil-square')
                    ->collapsible()
                    ->collapsed()
                    ->columnSpanFull()
                    ->schema([
                        RichEditor::make('notes')
                            ->label('Notes')
                            ->columnSpanFull()
                            ->extraAttributes([
        'style' => 'min-height: 300px;',
    ])
                    ]),

                Section::make('Rating and Consent')
                    ->icon('heroicon-o-users')
                    ->collapsible()
                    ->collapsed()
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        DatePicker::make('edit_due_date')
                            ->label('Edit Due Date'),
                        Select::make('rating')
                            ->label('Rating')
                            ->options(array_combine(range(1, 10), range(1, 10))),
                        Select::make('reviewer_id')
                            ->label('Assign Reviewer')
                            ->relationship(
                                name: 'reviewer',
                                titleAttribute: 'name'
                            )
                            ->searchable()
                            ->preload()

                            ->options(
                                User::role('reviwer')->pluck('name', 'id')
                            ),

                    ]),

                Section::make('Social Media profiles')
                    ->icon('heroicon-o-users')
                    ->collapsible()
                    ->collapsed()
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextInput::make('facebook_url'),
                        TextInput::make('instagram_url'),
                        TextInput::make('linkedin_url'),
                        TextInput::make('twitter_url'),

                    ]),
                Section::make('Additional Information')
                    ->icon('heroicon-o-document-text')
                    ->collapsible()
                    ->columnSpanFull()
                    ->collapsed()
                    ->columns(2)
                    ->schema([
                        TextInput::make('year_of_birth'),
                        TextInput::make('abstract_no'),

                    ]),
                Section::make('Emergency Contact Information')
                    ->icon('heroicon-o-home')
                    ->collapsible()
                    ->columnSpanFull()
                    ->collapsed()
                    ->columns(2)
                    ->schema([
                        TextInput::make('emergency_contact_name'),
                        TextInput::make('emergency_contact_relationship'),
                        TextInput::make('emergency_contact_phone'),
                        TextInput::make('emergency_contact_email'),

                    ]),
                Section::make('Main workplace')
                    ->icon('heroicon-o-document-text')
                    ->collapsible()
                    ->columnSpanFull()
                    ->collapsed()
                    ->columns(2)
                    ->schema([
                        Select::make('main_workplace')
                            ->options(WorkplaceEnum::class),

                    ]),
                Section::make('Professional role')
                    ->icon('heroicon-o-academic-cap')
                    ->columnSpanFull()
                    ->collapsible()
                    ->collapsed()
                    ->columns(1)
                    ->schema([
                        Select::make('professional_role')
                            ->options(ProfessionalRoleEnum::options()),
                    ]),
                Section::make('Prescribing Authority')
                    ->icon('heroicon-o-academic-cap')
                    ->columnSpanFull()
                    ->collapsible()
                    ->collapsed()
                    ->columns(1)
                    ->schema([
                        Select::make('prescriber')
                            ->options(PrescriberEnum::options()),
                    ]),




            ]);
    }
}
