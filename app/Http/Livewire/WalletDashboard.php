<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class WalletDashboard extends Component
{
    public function render()
    {
        $user = User::with('wallet.currency')->find(auth()->id());
        return view('livewire.wallet-dashboard',[
            'user' => $user
        ]);
    }
}
