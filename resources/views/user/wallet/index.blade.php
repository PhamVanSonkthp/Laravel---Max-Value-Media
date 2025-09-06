@extends('user.layouts.master')

@section('title')

    <meta name="keyword" content="{{env('APP_NAME')}}">
    <meta name="promotion" content="{{env('APP_NAME')}}">
    <meta name="Description" content="{{env('APP_NAME')}}">

    <meta property="og:url" content="{{env('APP_URL')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{env('APP_NAME')}}"/>
    <meta property="og:description" content="{{env('APP_NAME')}}"/>
    <meta property="og:image" content="{{env('APP_URL') . \App\Models\Helper::logoImagePath() }}"/>

@endsection

@section('name')

@endsection

@section('css')
    <style>
        :root {
            --bg: #f9fafb;
            --card: #ffffff;
            --muted: #6b7280;
            --text: #111827;
            --accent: #2563eb;
            --radius: 12px;
            --shadow: 0 6px 16px rgba(0, 0, 0, .06);
        }

        .card {
            overflow: hidden;
            padding: 16px;
            position: relative;
            text-align: center;
        }

        .title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .paypal-logo {
            width: 70px;
            margin: 0 auto 14px;
            display: block;
        }

        .balance-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 12px;
        }

        .balance-label {
            font-size: .8rem;
            color: var(--muted);
            margin-bottom: 4px;
        }

        .balance-amount {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--accent);
        }

        .email-box {
            margin-top: 10px;
        }

        .email-label {
            font-size: .8rem;
            color: var(--muted);
            margin-bottom: 4px;
            display: block;
        }

        .email-value {
            font-size: .9rem;
            font-weight: 600;
        }

        .btn_edit_method {
            appearance: none;
            border: 0;
            cursor: pointer;
            background: transparent;
            color: var(--accent);
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 4px;
        }

        .btn_edit_method svg {
            width: 18px;
            height: 18px;
            fill: currentColor;
        }
    </style>


    <style>
        :root {
            --bg: #0b0f17;
            --modal_create_payment_method_card: #111827;
            --muted: #94a3b8;
            --text: #e5e7eb;
            --accent: #60a5fa;
            --accent-2: #34d399;
            --ring: rgba(96, 165, 250, .4);
            --radius: 16px;
            --shadow: 0 10px 30px rgba(0, 0, 0, .35);
        }


        .modal_create_payment_method_card {
            border: 1px solid rgb(255 0 155 / 6%);
            border-radius: var(--radius);
            overflow: hidden;

        }

        .modal_create_payment_method_card-header {
            padding: 20px 22px 0 22px;
        }

        .modal_create_payment_method_title {
            font-size: 1.125rem;
            font-weight: 700;
            letter-spacing: .2px;
        }

        .modal_create_payment_method_sub {
            color: var(--muted);
            font-size: .95rem;
            margin-top: 6px;
        }

        /* modal_create_payment_method_tabs */
        .modal_create_payment_method_tabs {
            margin-top: 16px;
        }

        .modal_create_payment_method_tabs [type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .modal_create_payment_method_tab-list {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
            padding: 6px;
            background: rgba(255, 255, 255, .04);
            border-radius: 12px;
        }

        .modal_create_payment_method_tab-label {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px 10px;
            border-radius: 10px;
            cursor: pointer;
            user-select: none;
            color: var(--muted);
            font-weight: 600;
            transition: color .25s ease, background .25s ease;
        }

        .modal_create_payment_method_tab-label svg {
            width: 18px;
            height: 18px;
            opacity: .9;
        }

        /* Active state via :has() fallback using adjacent sibling selectors */
        #tab-paypal:checked ~ .modal_create_payment_method_tab-list label[for="tab-paypal"],
        #tab-crypto:checked ~ .modal_create_payment_method_tab-list label[for="tab-crypto"],
        #tab-wire:checked ~ .modal_create_payment_method_tab-list label[for="tab-wire"],
        #tab-pingpong:checked ~ .modal_create_payment_method_tab-list label[for="tab-pingpong"] {
            background: linear-gradient(180deg, rgba(96, 165, 250, .18), rgba(96, 165, 250, .08));
            color: #4192ff;
            box-shadow: inset 0 0 0 1px var(--ring);
        }

        .modal_create_payment_method_panels {
            position: relative;
            padding: 18px 22px 22px 22px;
        }

        .modal_create_payment_method_panel {
            display: none;
            animation: modal_create_payment_method_fade .35s ease;
        }

        @keyframes modal_create_payment_method_fade {
            from {
                opacity: 0;
                transform: translateY(6px)
            }
            to {
                opacity: 1;
                transform: none
            }
        }

        #tab-paypal:checked ~ .modal_create_payment_method_panels #panel-paypal {
            display: block
        }

        #tab-crypto:checked ~ .modal_create_payment_method_panels #panel-crypto {
            display: block
        }

        #tab-wire:checked ~ .modal_create_payment_method_panels #panel-wire {
            display: block
        }

        #tab-pingpong:checked ~ .modal_create_payment_method_panels #panel-pingpong {
            display: block
        }

        .method {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 14px;
            border: 1px dashed rgba(255, 255, 255, .1);
            border-radius: 12px;
            background: rgba(255, 255, 255, .03);
        }

        .method h3 {
            margin: 0;
            font-size: 1.05rem;
        }

        .method p {
            margin: .35rem 0 0;
            color: var(--muted);
            line-height: 1.45;
        }

        .grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 16px;
            margin-top: 16px;
        }

        .field {
            display: grid;
            gap: 6px;
        }

        .field label {
            color: var(--muted);
            font-size: .9rem
        }

        .field input, .field select {
            background: #e5e5e5;
            color: #000000;
            border: 1px solid rgba(255, 255, 255, .08);
            outline: none;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: .98rem;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 18px;
        }

        .modal_create_payment_method_btn {
            appearance: none;
            border: 0;
            cursor: pointer;
            font-weight: 700;
            letter-spacing: .2px;
            padding: 12px 16px;
            border-radius: 12px;
            background: #1f2937;
            color: var(--text);
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .08);
        }

        .modal_create_payment_method_btn.primary {
            background: linear-gradient(180deg, #3b82f6, #2563eb);
            box-shadow: none;
            width: 100%;
        }

        .modal_create_payment_method_btn.ghost {
            background: transparent;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .14);
        }

        /* Responsive */
        @media (max-width: 720px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .modal_create_payment_method_tab-label {
                padding: 10px 8px;
                font-size: .95rem;
            }
        }
    </style>

@endsection

@section('content')
    <!-- Main Content -->
    <section class="content" style="margin-top: 140px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="row">
                        <div class="col-lg-4">
                            <div id="container_payment_method">
                                @include('user.wallet.container_paymen_method', ['userPaymentMethod' => $userPaymentMethod])
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <div class="card mb-0 mt-1">
                                <div class="text-center">
                                    Total earning
                                </div>
                                <div class="text-center">
                                    <h5>
                                        ${{\App\Models\Formatter::formatNumber($sumEarning, 2)}}
                                    </h5>
                                </div>
                            </div>
                            <div class="card mb-0 mt-1">
                                <div class="text-center">
                                    Total withdrawn
                                </div>
                                <div class="text-center">
                                    <h5>
                                        ${{\App\Models\Formatter::formatNumber($withdraw, 2)}}
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card mb-0 mt-1">
                                <div class="text-center">
                                    Total revenue referral
                                </div>
                                <div class="text-center">
                                    <h5>
                                        $0
                                    </h5>
                                </div>
                            </div>
                            <div class="card mb-0 mt-1">
                                <div class="text-center">
                                    Invalid amount
                                </div>
                                <div class="text-center">
                                    <h5>
                                        ${{\App\Models\Formatter::formatNumber($sumInvalid, 2)}}
                                    </h5>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div>
                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive product-table">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th>
                                                Reciept
                                            </th>
                                            <th>
                                                Date
                                            </th>
                                            <th>
                                                Method
                                            </th>
                                            <th>
                                                Address
                                            </th>
                                            <th>
                                                Earning
                                            </th>
                                            <th>
                                                Deductions
                                            </th>
                                            <th>
                                                Total
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                Estimate Payment Time
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="" id="body_container_item">

                                        @foreach($items as $index => $item)
                                            @include('user.wallet.row', ['item' => $item, 'index' => $index])
                                        @endforeach

                                        </tbody>

                                        <tfoot>

                                        </tfoot>
                                    </table>
                                </div>
                                <div>
                                    @include('administrator.components.footer_table')
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Modal create payment method -->
    <div class="modal fade" id="modal_create_payment_method_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Choose a payment method
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-x"></i>
                    </button>
                </div>
                <div class="modal-body" id="container_modal_create_payment_method_modal">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        function onShowModalPaymentMethod() {
            callAjax(
                "GET",
                "{{route('ajax.user.wallet.modal_create_payment_method')}}",
                {},
                (response) => {
                    $('#container_modal_create_payment_method_modal').html(response.data.html);
                    showModal('modal_create_payment_method_modal');
                },
                (error) => {

                }
            )

        }

        function onSavePaypal() {
            const paypal_email_value = $('#pp-email').val();

            if (!paypal_email_value) {
                showToastError('Email is require');
                $('#pp-email').focus();
                return;
            }

            callAjax(
                "PUT",
                "{{route('ajax.user.wallet.save_payment')}}",
                {
                    payment_method_id: 1,
                    paypal_email: paypal_email_value,
                },
                (response) => {
                    hideModal('modal_create_payment_method_modal');
                    showToastSuccess('Saved!');
                    $('#container_payment_method').html(response.data.html);
                },
                (error) => {

                }
            )
        }

        function onSaveCrypto() {
            const crypto_coin_value = $('#crypto_coin').val();
            const crypto_network_value = $('#crypto_network').val();
            const crypto_address_value = $('#crypto_address').val();

            if (!crypto_coin_value) {
                showToastError('Coin is require');
                $('#crypto_coin').focus();
                return;
            }
            if (!crypto_network_value) {
                showToastError('Network is require');
                $('#crypto_network').focus();
                return;
            }
            if (!crypto_address_value) {
                showToastError('Address is require');
                $('#crypto_address').focus();
                return;
            }

            callAjax(
                "PUT",
                "{{route('ajax.user.wallet.save_payment')}}",
                {
                    payment_method_id: 3,
                    crypto_coin: crypto_coin_value,
                    crypto_network: crypto_network_value,
                    crypto_address: crypto_address_value,
                },
                (response) => {
                    hideModal('modal_create_payment_method_modal');
                    showToastSuccess('Saved!');
                    $('#container_payment_method').html(response.data.html);
                },
                (error) => {

                }
            )
        }

        function onSaveWireTransfer() {
            const wire_transfer_beneficiary_name_value = $('#wire_transfer_beneficiary_name').val();
            const wire_transfer_account_number_value = $('#wire_transfer_account_number').val();
            const wire_transfer_bank_name_value = $('#wire_transfer_bank_name').val();
            const wire_transfer_swift_code_value = $('#wire_transfer_swift_code').val();
            const wire_transfer_bank_address_value = $('#wire_transfer_bank_address').val();
            const wire_transfer_routing_number_value = $('#wire_transfer_routing_number').val();

            if (!wire_transfer_beneficiary_name_value) {
                showToastError('Beneficiary name is require');
                $('#wire_transfer_beneficiary_name').focus();
                return;
            }
            if (!wire_transfer_account_number_value) {
                showToastError('Account number is require');
                $('#wire_transfer_account_number').focus();
                return;
            }
            if (!wire_transfer_bank_name_value) {
                showToastError('Bank_name is require');
                $('#wire_transfer_bank_name').focus();
                return;
            }
            if (!wire_transfer_swift_code_value) {
                showToastError('Swift code is require');
                $('#wire_transfer_swift_code').focus();
                return;
            }
            if (!wire_transfer_bank_address_value) {
                showToastError('Bank address is require');
                $('#wire_transfer_bank_address').focus();
                return;
            }

            callAjax(
                "PUT",
                "{{route('ajax.user.wallet.save_payment')}}",
                {
                    payment_method_id: 7,
                    wire_transfer_beneficiary_name: wire_transfer_beneficiary_name_value,
                    wire_transfer_account_number: wire_transfer_account_number_value,
                    wire_transfer_bank_name: wire_transfer_bank_name_value,
                    wire_transfer_swift_code: wire_transfer_swift_code_value,
                    wire_transfer_bank_address: wire_transfer_bank_address_value,
                    wire_transfer_routing_number: wire_transfer_routing_number_value,
                },
                (response) => {
                    hideModal('modal_create_payment_method_modal');
                    showToastSuccess('Saved!');
                    $('#container_payment_method').html(response.data.html);
                },
                (error) => {

                }
            )
        }


        function onSavePingPong() {
            const ping_pong_email_value = $('#ping_pong_email').val();

            if (!ping_pong_email_value) {
                showToastError('Email is require');
                $('#ping_pong_email').focus();
                return;
            }

            callAjax(
                "PUT",
                "{{route('ajax.user.wallet.save_payment')}}",
                {
                    payment_method_id: 8,
                    ping_pong_email: ping_pong_email_value,
                },
                (response) => {
                    hideModal('modal_create_payment_method_modal');
                    showToastSuccess('Saved!');
                    $('#container_payment_method').html(response.data.html);
                },
                (error) => {

                }
            )
        }

    </script>
@endsection
