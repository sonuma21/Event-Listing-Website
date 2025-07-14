<?php

namespace App\Providers\Filament;

use App\Filament\Organizer\Resources\PaymentRequestResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class OrganizerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('organizer')
            ->path('organizer')
            ->authGuard('organizer')
            ->login()
            ->passwordReset()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Organizer/Resources'), for: 'App\\Filament\\Organizer\\Resources')
            ->discoverPages(in: app_path('Filament/Organizer/Pages'), for: 'App\\Filament\\Organizer\\Pages')
            ->pages([
                \App\Filament\Organizer\Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Organizer/Widgets'), for: 'App\\Filament\\Organizer\\Widgets')
            ->widgets([
                \App\Filament\Organizer\Widgets\StatWidget::class,
                \App\Filament\Organizer\Widgets\RecentCheckout::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
