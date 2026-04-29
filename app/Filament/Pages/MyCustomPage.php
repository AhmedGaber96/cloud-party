<?php
namespace App\Filament\Pages;
use App\GenderEnum;
use App\HcpDeclarationEnum;
use App\PrescriberEnum;
use App\ProfessionalRoleEnum;
use App\TitleEnum;
use App\WorkplaceEnum;
use App\Models\IfsoMember;
use App\Models\User;
use BackedEnum;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Pages\Page;
use Filament\Facades\Filament;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;
use UnitEnum;

class MyCustomPage extends Page implements HasForms
{
    use HasPageShield;
    use Forms\Concerns\InteractsWithForms;

    protected string $view = 'filament.pages.my-custom-page';
    protected static ?string $title ='My Profile';


protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user';

    

    public ?array $data = [];
    public ?User $user = null;
    public ?IfsoMember $member = null;
    public bool $canSave = true;

    public function mount(): void
    {
        $this->user = Filament::auth()->user();
        $this->member = $this->user->ifsoMember ?? new IfsoMember();


        $this->form->fill(array_merge(
            $this->user->only(['name', 'email']),
            $this->member->toArray(),
        ));

         $this->canSave = $this->member->edit_due_date > now()->toDateString();
         
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->statePath('data')
            ->schema([

                // ─── Account Section ──────────────────────────────────────
                // Section::make('Account Information')
                //     ->icon('heroicon-o-user-circle')
                //     ->collapsible()
                //     ->schema([
                //         Forms\Components\TextInput::make('name')
                //             ->label('Full Name')
                //             ->required(),

                //         Forms\Components\TextInput::make('email')
                //             ->label('Email Address')
                //             ->email()
                //             ->required(),

                //         Forms\Components\TextInput::make('password')
                //             ->password()
                //             ->label('New Password')
                //             ->helperText('Leave empty to keep current password.')
                //             ->dehydrated(fn($state) => filled($state)),
                //     ])->columns(2),

                // ─── Personal Info ────────────────────────────────────────


                
                
                Section::make(' Information')
                    ->icon('heroicon-o-identification')
                    ->collapsible()
                    ->schema([
Placeholder::make('photo_preview')
    ->label('Profile Photo')
    ->content(function () {
        if (!$this->member?->photo) {
            return 'No image';
        }

        $url = asset('storage/' . $this->member->photo);

        return new HtmlString("
            <img src='{$url}' 
                 style='height:120px;width:120px;border-radius:50%;object-fit:cover;' />
        ");
    })
    ->columnSpanFull(),
                        Select::make('title')
                            ->options(TitleEnum::class),

                       TextInput::make('gender'),
                        TextInput::make('first_name'),
                        TextInput::make('last_name'),

                        Forms\Components\Select::make('gender')
                            ->label('Gender')
                            ->options(GenderEnum::class)
                              ->disabled(fn () => ! $this->canSave)
                            ->native(false),

                        Forms\Components\TextInput::make('year_of_birth')
                            ->label('Year of Birth')
                            ->numeric()
                            ->minValue(1900)
                              ->disabled(fn () => ! $this->canSave)
                            ->maxValue(now()->year),

                        Forms\Components\FileUpload::make('photo')
                            ->label('Profile Photo')
                            ->image()
                            ->imageEditor()
                              ->disabled(fn () => ! $this->canSave)
                            ->directory('member-photos')
                            ->columnSpanFull(),
                    ])->columns(2),

                // ─── Contact Info ─────────────────────────────────────────
                Section::make('Contact Information')
                    ->icon('heroicon-o-phone')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('mobile_phone')
                            ->label('Mobile Phone')
                              ->disabled(fn () => ! $this->canSave)
                            ->tel(),

                        Forms\Components\TextInput::make('city')
                          ->disabled(fn () => ! $this->canSave)
                            ->label('City'),

                        Forms\Components\TextInput::make('country')
                          ->disabled(fn () => ! $this->canSave)
                            ->label('Country'),

                        Forms\Components\TagsInput::make('additional_emails')
                            ->label('Additional Emails')
                              ->disabled(fn () => ! $this->canSave)
                            ->helperText('Press Enter after each email.')
                            ->columnSpanFull(),
                            
                    ])->columns(2),

                // ─── Social Media ─────────────────────────────────────────
                Section::make('Social Media')
                    ->icon('heroicon-o-link')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('facebook_url')
                            ->label('Facebook URL')
                              ->disabled(fn () => ! $this->canSave)
                            ->url()
                            ->prefixIcon('heroicon-o-globe-alt'),

                        Forms\Components\TextInput::make('instagram_url')
                            ->label('Instagram URL')
                              ->disabled(fn () => ! $this->canSave)
                            ->url()
                            ->prefixIcon('heroicon-o-globe-alt'),

                        Forms\Components\TextInput::make('linkedin_url')
                            ->label('LinkedIn URL')
                              ->disabled(fn () => ! $this->canSave)
                            ->url()
                            ->prefixIcon('heroicon-o-globe-alt'),

                        Forms\Components\TextInput::make('twitter_url')
                            ->label('Twitter / X URL')
                              ->disabled(fn () => ! $this->canSave)
                            ->url()
                            ->prefixIcon('heroicon-o-globe-alt'),
                    ])->columns(2),

                // ─── Emergency Contact ────────────────────────────────────
                Section::make('Emergency Contact')
                    ->icon('heroicon-o-exclamation-triangle')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('emergency_contact_name')
                          ->disabled(fn () => ! $this->canSave)
                            ->label('Contact Name'),

                        Forms\Components\TextInput::make('emergency_contact_relationship')
                          ->disabled(fn () => ! $this->canSave)
                            ->label('Relationship'),

                        Forms\Components\TextInput::make('emergency_contact_phone')
                          ->disabled(fn () => ! $this->canSave)
                            ->label('Phone')
                            ->tel(),

                        Forms\Components\TextInput::make('emergency_contact_email')
                          ->disabled(fn () => ! $this->canSave)
                            ->label('Email')
                            ->email(),
                    ])->columns(2),

                // ─── Professional Info ────────────────────────────────────
                Section::make('Professional Information')
                    ->icon('heroicon-o-briefcase')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Select::make('main_workplace')
                          ->disabled(fn () => ! $this->canSave)
                            ->label('Main Workplace')
                            ->options(WorkplaceEnum::class)
                            ->native(false),

                        Forms\Components\Select::make('professional_role')
                          ->disabled(fn () => ! $this->canSave)
                            ->label('Professional Role')
                            ->options(ProfessionalRoleEnum::class)
                            ->native(false),

                        Forms\Components\Select::make('prescriber')
                          ->disabled(fn () => ! $this->canSave)
                            ->label('Prescriber')
                            ->options(PrescriberEnum::class)
                            ->native(false),

                        Forms\Components\Select::make('hcp_declaration')
                          ->disabled(fn () => ! $this->canSave)
                            ->label('HCP Declaration')
                            ->options(HcpDeclarationEnum::class)
                            ->native(false),

                        Forms\Components\TextInput::make('abstract_no')
                          ->disabled(fn () => ! $this->canSave)
                            ->label('Abstract Number'),
                    ])->columns(2),

                // ─── Consent ──────────────────────────────────────────────
                Section::make('Consent')
                    ->icon('heroicon-o-shield-check')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Toggle::make('consent')
                            ->label('I agree to the terms and consent to data processing')
                            ->onColor('success')
                            ->offColor('danger'),
                    ]),

            ]);
    }

    public function save(): void
{
    $data = $this->form->getState();

    // 🔐 الشرط (غيره حسب احتياجك)
    if ((!1 == 1)) {
        Notification::make()
            ->title('مينفعش تعدل البيانات')
            ->danger()
            ->send();

        return; // ⛔ وقف التنفيذ هنا
    }


    // ── Update or Create IfsoMember ───────────────────────────────────
    $memberFields = [
        'title', 'first_name', 'last_name', 'email',
        'additional_emails', 'city', 'country', 'mobile_phone',
        'photo', 'consent', 'facebook_url', 'instagram_url',
        'linkedin_url', 'twitter_url', 'abstract_no', 'year_of_birth',
        'gender', 'emergency_contact_name', 'emergency_contact_relationship',
        'emergency_contact_phone', 'emergency_contact_email',
        'main_workplace', 'professional_role', 'prescriber', 'hcp_declaration',
    ];

    $memberData = array_intersect_key($data, array_flip($memberFields));

    if ($this->member->exists) {
        $this->member->update($memberData);
    } else {
        $this->member = $this->user->ifsoMember()->create($memberData);
    }

    Notification::make()
        ->title('Profile updated successfully')
        ->success()
        ->send();
}
}