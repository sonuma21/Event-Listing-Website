<?php

namespace App\Filament\Organizer\Pages;

use App\Models\Checkout;
use Filament\Actions\Action;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseDashboard
{
    protected function getHeaderActions(): array
    {

        $totalRevenue = Checkout::where('organizer_id', Auth::id())->sum('total_amount');
        

        return [
            Action::make('requestPayment')
                ->label('Request Payment')
                ->button()
                ->color('primary')
                ->action(function () {

                        return redirect()->route('filament.organizer.resources.payment-requests.create');

                })
                ->disabled($totalRevenue == 0)
                ->tooltip($totalRevenue == 0 ? 'No revenue available to request.' : null),
        ];
    }


}
