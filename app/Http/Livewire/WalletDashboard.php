<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class WalletDashboard extends Component
{

    public $all_users;
    public $user_wallet_currency;
    public $getUserCurrency;

    public function mount(){
        $this->all_users = User::with('wallet.currency')->where('id','!=',auth()->id())->get();
        $this->user_wallet_currency = User::with('wallet.currency')->find(auth()->id());
    }

    public function render()
    {
        return view('livewire.wallet-dashboard');
    }
}
