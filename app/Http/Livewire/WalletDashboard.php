<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Transaction;

class WalletDashboard extends Component
{

    public $all_users;
    public $user_wallet_currency;
    public $transactionData;

    public function mount(){
        $this->all_users = User::with('wallet.currency')->where('id','!=',auth()->id())->get();
        $this->user_wallet_currency = User::with('wallet.currency')->find(auth()->id());
        $this->transactionData = Transaction::select('transaction_id','actual_amount','converted_amount','transaction_status')->where('sender_id',auth()->id())->get();
    }

    public function render()
    {
        return view('livewire.wallet-dashboard');
    }
}
