<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\User; // Import model User

class TotalUsersWidget extends Widget
{
    protected static string $view = 'filament.widgets.total-users-widget';

    // Gunakan ini jika ingin widget ditampilkan di dashboard Filament
    protected static ?int $sort = 1;

    public function getData(): array
    {
        return [
            'totalUsers' => User::count(), // Menghitung total user
        ];
    }
}
