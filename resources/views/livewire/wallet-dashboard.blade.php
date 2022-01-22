<div class="min-w-screen bg-gray-200 flex items-center justify-center px-5 py-5">
    <div class="bg-white text-gray-800 rounded-xl shadow-lg overflow-hidden relative flex"
        style="width:414px">
        <div class="bg-white h-full w-full px-5 pt-6 pb-5 overflow-y-auto">
            <center>
                <div id="empty-cover-art"
                    class="shadow-md rounded w-80 bg-cyan-100 text-5xl text-center opacity-50">
                    <center><svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>My Wallet</center>
                </div>
                <br><strong><p class="text-xl opacity-50">Current Balance Is: {{ $user->wallet->currency->currency_symbol . $user->wallet->available_amount }}</p></strong><br>
                <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Transfer Money') }}
                </x-jet-secondary-button>
            </center>
        </div>
    </div>
    <x-jet-dialog-modal wire:model="confirmingUserDeletion">
        <x-slot name="title">
            {{ __('Delete Account') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data
            will be permanently deleted. Please enter your password to confirm you would like to permanently delete your
            account.') }}

            <div class="mt-4" x-data="{}"
                x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                <x-jet-input type="password" class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" x-ref="password"
                    wire:model.defer="password" wire:keydown.enter="deleteUser" />

                <x-jet-input-error for="password" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
                {{ __('Delete Account') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
