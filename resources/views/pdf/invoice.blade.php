<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $payment->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .invoice-box {
            max-width: 800px;
            margin: 20px auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .invoice-header img {
            max-width: 150px;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-details h2 {
            margin: 0;
            color: #555;
        }

        .invoice-details p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background: #f5f5f5;
        }

        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="invoice-box">
    <!-- Header -->
    <div class="invoice-header">
        <img src="{{ public_path('assets/images/YxPIef1UWMmT7hFjDUxN.png') }}" alt="Logo">
        <div>
            <h1>Invoice</h1>
            <p>Code: #{{ $payment->id }}</p>
        </div>
    </div>

    <!-- Customer Info -->
    <div class="invoice-details">
        <p><strong>Customer ID:</strong> {{ optional($payment->user)->id }}</p>
        <p><strong>Email:</strong> {{ optional($payment->user)->email }}</p>
        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($payment->to)->toDateString() }}</p>

        <div>
            @if(optional($payment->userPaymentMethod)->payment_method_id == 1)
                <div class="row">
                    <div class="col-4">
                        <div class="title">{{optional(optional($payment->userPaymentMethod)->paymentMethod)->name}}</div>
                    </div>
                    <div class="col-8">

                        <div class="email-box">
                            <span class="email-label">Email</span>
                            <div class="email-value">{{optional($payment->userPaymentMethod)->paypal_email}}</div>
                        </div>
                    </div>
                </div>

            @elseif(optional($payment->userPaymentMethod)->payment_method_id == 3)
                <div class="row">
                    <div class="col-4">
                        <div class="title">{{optional(optional($payment->userPaymentMethod)->paymentMethod)->name}}</div>
                    </div>
                    <div class="col-8">
                        <div class="email-box">
                            <div class="text-center">
                                <span class="email-label" style="gap: 5px;display: flex;align-items: center;justify-content: center;">Address <i class="fa-solid fa-circle" style="font-size: 5px;"></i> {{optional($payment->userPaymentMethod)->crypto_coin}} <i class="fa-solid fa-circle" style="font-size: 5px;"></i> {{optional($payment->userPaymentMethod)->crypto_network}}</span>
                            </div>

                            <div class="email-value">{{optional($payment->userPaymentMethod)->crypto_address}}</div>
                        </div>
                    </div>
                </div>

            @elseif(optional($payment->userPaymentMethod)->payment_method_id == 7)
                <div class="row">
                    <div class="col-4">
                        <div class="title">{{optional(optional($payment->userPaymentMethod)->paymentMethod)->name}}</div>
                    </div>
                    <div class="col-8">
                        <div>
                            <ul>
                                <li class="text-start">
                                    {{optional($payment->userPaymentMethod)->wire_transfer_beneficiary_name}}
                                </li>
                                <li class="text-start">
                                    {{optional($payment->userPaymentMethod)->wire_transfer_account_number}}
                                </li>
                                <li class="text-start">
                                    {{optional($payment->userPaymentMethod)->wire_transfer_bank_name}}
                                </li>
                                <li class="text-start">
                                    {{optional($payment->userPaymentMethod)->wire_transfer_swift_code}}
                                </li>
                                <li class="text-start">
                                    {{optional($payment->userPaymentMethod)->wire_transfer_bank_address}}
                                </li>
                                <li class="text-start">
                                    {{optional($payment->userPaymentMethod)->wire_transfer_routing_number}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            @elseif(optional($payment->userPaymentMethod)->payment_method_id == 8)
                <div class="row">
                    <div class="col-4">
                        <div class="title">{{optional(optional($payment->userPaymentMethod)->paymentMethod)->name}}</div>
                    </div>
                    <div class="col-8">

                        <div class="email-box">
                            <span class="email-label">Email</span>
                            <div class="email-value">{{optional($payment->userPaymentMethod)->ping_pong_email}}</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Items Table -->
    <table>
        <thead>
        <tr>
            <th>Item</th>
            <th>Total</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td>Earning</td>
            <td>${{\App\Models\Formatter::formatMoney($payment->earning , 2)}}</td>
        </tr>
        <tr>
            <td>Deduction</td>
            <td>${{\App\Models\Formatter::formatMoney($payment->deduction , 2)}}</td>
        </tr>

        <tr>
            <td class="total">Total Amount:</td>
            <td>${{ \App\Models\Formatter::formatMoney($payment->total, 2)}}</td>
        </tr>
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        Contact us: {{\App\Models\Setting::first()->email_contact}} | {{\App\Models\Setting::first()->phone_contact}}
    </div>
</div>
</body>
</html>
