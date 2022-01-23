<div class="flex flex-wrap -mx-6 overflow-hidden">
    <div class="my-6 px-6 w-1/3 overflow-hidden border-2">
        <div class="bg-gray-100 h-full w-full px-5 overflow-y-auto">
            <center>
                <div id="empty-cover-art" class="shadow-md rounded w-80 bg-gray-300 text-center">
                    <center>
                        <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        <p>Welcome, {{ $user_wallet_currency->name }}</p>
                        <p>Your Currency is {{ $user_wallet_currency->wallet->currency->currency_name }}</p>
                    </center>
                </div>
                <br><strong>
                    <p class="text-xl">Current Balance Is: {{
                        $user_wallet_currency->wallet->currency->currency_symbol .
                        $user_wallet_currency->wallet->available_amount }}</p>
                </strong><br>
            </center>
        </div>
    </div>
    <div class="my-6 px-6 w-1/2 overflow-hidden border-2">
        <div class="w-full bg-white p-5 rounded-lg lg:rounded-l-none">
            <h3 class="pt-4 text-2xl text-center">Transfer Balance!</h3>
            @if(Session::has('success'))
                <p class="text-xl text-center text-green-500">{{ Session::get('success') }}</p>
            @endif
            @if(Session::has('error'))
                <p class="text-xl text-center text-orange-500">{{ Session::get('error') }}</p>
            @endif
            <form method="post" action="{{ url('/store-transaction') }}" class="px-8 pt-6 pb-8 mb-4 bg-white rounded">
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
                <input type="hidden" name="transaction_type" value="credit">
                <div class="mb-6 text-center">
                    <button
                        class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                        type="submit">
                        Transfer
                    </button>
                </div>
            </form>
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
                            let convertedAmount = parseFloat($('#amount').val() * result);
                            $('#conversionRate').text(result);
                            $('#convertRate').val(result);
                            $('#receipientAmount').text(convertedAmount);
                            $('#convertedAmount').val(convertedAmount);
                        }
                    });
                }, 1000);
            }
        });
        $('.submit').on('click', function(e) {
            e.preventDefault();

        });
    });
</script>
