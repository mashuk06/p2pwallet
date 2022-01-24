<div class="flex flex-wrap overflow-hidden sm:-mx-1">
    <div class="w-1/6 overflow-hidden sm:my-1 sm:px-1 bg-orange-200 border-r-4 border-stone-400">
        <div class="h-full w-full overflow-y-auto">
            <div id="empty-cover-art" class="shadow-md rounded w-full">
                <center>
                    <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </center>
                <p class="ml-4">Welcome, {{ $user_wallet_currency->name }}</p>
                <p class="ml-4">Your Currency is {{ $user_wallet_currency->wallet->currency->currency_name }}</p>
            </div>
            <br><strong>
                <p class="text-xl ml-2">Your Current Balance</p>
                <center>
                    <p class="h-10 ml-2 mt-5 bg-gray-100 mr-2 w-94 text-3xl border-2 border-stone-900">{{
                        $user_wallet_currency->wallet->currency->currency_symbol .
                        $user_wallet_currency->wallet->available_amount }}
                    </p>
                <center>
            </strong><br>
        </div>
    </div>

  <div class="w-2/6 overflow-hidden sm:my-1 sm:px-1 bg-orange-200 border-r-4 border-stone-400">
    <div class="w-full p-5 rounded-lg lg:rounded-l-none">
            <h3 class="pt-4 text-2xl text-center">Transfer Balance!</h3>
            @if(Session::has('success'))
                <p class="text-xl text-center text-green-500">{{ Session::get('success') }}</p>
            @endif
            @if(Session::has('error'))
                <p class="text-xl text-center text-orange-500">{{ Session::get('error') }}</p>
            @endif
            <form method="post" action="{{ url('/store-transaction') }}" class="px-8 pt-6 pb-8 mb-4 bg-black-100 rounded">
                @csrf
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="selectUser">
                        Select User
                    </label>
                    <select class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="selectUser" name="receiver_id">
                        @foreach($all_users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="userCurrency">
                        User Currency
                    </label>
                    <input
                        class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="userCurrency" type="text" value="{{ $user->wallet->currency->currency_name . ' (' . $user->wallet->currency->currency_symbol .') ' }}" readonly/>
                        <input type="hidden" id="currencyName" value="{{ $user->wallet->currency->currency_name }}">
                        <input type="hidden" id="walletId" name="wallet_id" value="{{ $user_wallet_currency->wallet->id }}">
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="amount">
                        Enter Amount to Transfer
                    </label>
                    <input
                        class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="amount" type="text" name="actual_amount" placeholder="Enter Amount" />
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="description">
                        Enter Description (Optional)
                    </label>
                    <input
                        class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="description" type="text" name="transaction_description" placeholder="Enter Transaction Description" />
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="amount">
                        <p class="text-red-600">Conversion Rate : <span id="conversionRate"></span></p>
                    </label>
                </div>
                <input type="hidden" name="conversion_rate" id="convertRate">
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="amount">
                        <p class="text-red-600">Receipient will receive : <span id="receipientAmount"></span></p>
                    </label>
                </div>
                <input type="hidden" name="converted_amount" id="convertedAmount">
                <input type="hidden" name="transaction_type" value="debit">
                <div class="mb-6 text-center">
                    <button
                        class="w-full px-4 py-2 font-bold text-white bg-orange-500 rounded-full hover:bg-orange-700 focus:outline-none focus:shadow-outline"
                        type="submit">
                        Transfer
                    </button>
                </div>
            </form>
        </div>
  </div>

  <div class="w-3/6 overflow-hidden sm:my-1 sm:px-1 bg-orange-200">
    <div class="px-2 overflow-y-auto">
        <h3 class="pt-8 text-2xl text-center">Transaction History</h3>
        <table class="w-full border-collapse text-center border border-black mt-10 p-3">
            <thead>
                <tr>
                    <th class="border border-black">No</th>
                    <th class="border border-black">Transaction Id</th>
                    <th class="border border-black">Receipient</th>
                    <th class="border border-black">Transfered</th>
                    <th class="border border-black">Received</th>
                    <th class="border border-black">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactionData as $key => $transaction)
                <tr class="bg-orange-100">
                    <td class="border border-black">{{ ++$key }}</td>
                    <td class="border border-black">{{ $transaction->transaction_id}}</td>
                    <td class="border border-black">{{ $user->name }}</td>
                    <td class="border border-black">{{ $user_wallet_currency->wallet->currency->currency_symbol . $transaction->actual_amount }}</td>
                    <td class="border border-black">{{ $user->wallet->currency->currency_symbol . $transaction->converted_amount }}</td>
                    <td class="border border-black">{{ $transaction->transaction_status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#amount').on('keyup', function(e) {
            e.preventDefault();
            let value = $(this).val();
            let currentUserCurrency = "{{ $user_wallet_currency->wallet->currency->currency_name }}";
            let otherUserCurrency = $('#currencyName').val();
            if (!$.isNumeric(value)) {
                alert('Value must be numeric');
                $(this).val('');
            }else{
                setTimeout(function () {
                    let url = "{{ url('/exchange-rate') }}";
                    $.ajax({
                        url: url,
                        cache: false,
                        data: { currentUserCurrency: currentUserCurrency, otherUserCurrency: otherUserCurrency },
                        success: function (result) {
                            let convertedAmount = (parseFloat($('#amount').val() * result)).toFixed(2);
                            $('#conversionRate').text(result);
                            $('#convertRate').val(result);
                            $('#receipientAmount').text(convertedAmount);
                            $('#convertedAmount').val(convertedAmount);
                        }
                    });
                }, 500);
            }
        });
        $('.submit').on('click', function(e) {
            e.preventDefault();

        });
    });
</script>
