<div class="card">
    <button onclick="onShowModalPaymentMethod()" class="btn_edit_method" aria-label="Edit" style="z-index:10;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path
                d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1.003 1.003 0 0 0 0-1.42l-2.34-2.34a1.003 1.003 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/>
        </svg>
    </button>

    @if($userPaymentMethod->payment_method_id == 1)
        <div class="row">
            <div class="col-4">
                <img src="{{optional($userPaymentMethod->paymentMethod)->avatar()}}"/>
                <div class="title">{{optional($userPaymentMethod->paymentMethod)->name}}</div>
            </div>
            <div class="col-8">

                <div class="email-box">
                    <span class="email-label">Email</span>
                    <div class="email-value">{{$userPaymentMethod->paypal_email}}</div>
                </div>
                <div class="balance-box">
                    <div class="balance-amount">
                        ${{\App\Models\Formatter::formatNumber(auth()->user()->amount, 2)}}</div>
                </div>
            </div>
        </div>
        <small>
            {{optional($userPaymentMethod->paymentMethod)->description}}
        </small>

    @elseif($userPaymentMethod->payment_method_id == 3)
        <div class="row">
            <div class="col-4">
                <img src="{{optional($userPaymentMethod->paymentMethod)->avatar()}}"/>
                <div class="title">{{optional($userPaymentMethod->paymentMethod)->name}}</div>
            </div>
            <div class="col-8">
                <div class="email-box">
                    <div class="text-center">
                        <span class="email-label" style="gap: 5px;display: flex;align-items: center;justify-content: center;">Address <i class="fa-solid fa-circle" style="font-size: 5px;"></i> {{$userPaymentMethod->crypto_coin}} <i class="fa-solid fa-circle" style="font-size: 5px;"></i> {{$userPaymentMethod->crypto_network}}</span>
                    </div>

                    <div class="email-value">{{$userPaymentMethod->crypto_address}}</div>
                </div>

                <div class="balance-box">
                    <div class="balance-amount">
                        ${{\App\Models\Formatter::formatNumber(auth()->user()->amount, 2)}}</div>
                </div>


            </div>
        </div>
        <small>
            {{optional($userPaymentMethod->paymentMethod)->description}}
        </small>

    @elseif($userPaymentMethod->payment_method_id == 7)
        <div class="row">
            <div class="col-4">
                <img src="{{optional($userPaymentMethod->paymentMethod)->avatar()}}"/>
                <div class="title">{{optional($userPaymentMethod->paymentMethod)->name}}</div>
            </div>
            <div class="col-8">
                <div>
                    <ul>
                        <li class="text-start">
                            {{$userPaymentMethod->wire_transfer_beneficiary_name}}
                        </li>
                        <li class="text-start">
                            {{$userPaymentMethod->wire_transfer_account_number}}
                        </li>
                        <li class="text-start">
                            {{$userPaymentMethod->wire_transfer_bank_name}}
                        </li>
                        <li class="text-start">
                            {{$userPaymentMethod->wire_transfer_swift_code}}
                        </li>
                        <li class="text-start">
                            {{$userPaymentMethod->wire_transfer_bank_address}}
                        </li>
                        <li class="text-start">
                            {{$userPaymentMethod->wire_transfer_routing_number}}
                        </li>
                    </ul>
                </div>

                <div class="balance-box">
                    <div class="balance-amount">
                        ${{\App\Models\Formatter::formatNumber(auth()->user()->amount, 2)}}</div>
                </div>
            </div>
        </div>
        <small>
            {{optional($userPaymentMethod->paymentMethod)->description}}
        </small>

    @elseif($userPaymentMethod->payment_method_id == 8)
        <div class="row">
            <div class="col-4">
                <img src="{{optional($userPaymentMethod->paymentMethod)->avatar()}}"/>
                <div class="title">{{optional($userPaymentMethod->paymentMethod)->name}}</div>
            </div>
            <div class="col-8">

                <div class="email-box">
                    <span class="email-label">Email</span>
                    <div class="email-value">{{$userPaymentMethod->ping_pong_email}}</div>
                </div>
                <div class="balance-box">
                    <div class="balance-amount">
                        ${{\App\Models\Formatter::formatNumber(auth()->user()->amount, 2)}}</div>
                </div>
            </div>
        </div>
        <small>
            {{optional($userPaymentMethod->paymentMethod)->description}}
        </small>
    @endif



</div>
