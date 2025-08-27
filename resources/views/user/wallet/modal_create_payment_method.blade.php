<div class="modal_create_payment_method_card" role="region" aria-label="Payment methods">
    <div class="modal_create_payment_method_card-header">
        <div class="modal_create_payment_method_sub">Select one of the options below to proceed with checkout.</div>

        <div class="modal_create_payment_method_tabs" role="tablist" aria-label="Payment modal_create_payment_method_tabs">
            <!-- Radios (visually hidden) -->
            <input type="radio" name="modal_create_payment_method_tabs" id="tab-paypal" {{$userPaymentMethodPaypal->is_default ? 'checked' : ''}}>
            <input type="radio" name="modal_create_payment_method_tabs" id="tab-crypto" {{$userPaymentMethodCrypto->is_default ? 'checked' : ''}}>
            <input type="radio" name="modal_create_payment_method_tabs" id="tab-wire" {{$userPaymentMethodWireTransfer->is_default ? 'checked' : ''}}>
            <input type="radio" name="modal_create_payment_method_tabs" id="tab-pingpong" {{$userPaymentMethodPingpong->is_default ? 'checked' : ''}}>

            <!-- Tab Labels -->
            <div class="modal_create_payment_method_tab-list">
                <label class="modal_create_payment_method_tab-label" for="tab-paypal" role="tab" aria-controls="panel-paypal" aria-selected="true">
                    <!-- PayPal icon -->
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" aria-hidden="true">
                        <path d="M6 21l1.5-9H15a4.5 4.5 0 0 0 0-9H8.5L7 12H5"/>
                        <path d="M7 12h7.5a3 3 0 0 1 0 6H9.5L9 21"/>
                    </svg>
                    PayPal
                </label>
                <label class="modal_create_payment_method_tab-label" for="tab-crypto" role="tab" aria-controls="panel-crypto" aria-selected="false">
                    <!-- Crypto icon -->
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M8 12h8M12 6v12"/>
                    </svg>
                    Crypto
                </label>
                <label class="modal_create_payment_method_tab-label" for="tab-wire" role="tab" aria-controls="panel-wire" aria-selected="false">
                    <!-- Bank icon -->
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" aria-hidden="true">
                        <path d="M3 10l9-6 9 6"/>
                        <path d="M4 10h16v8H4z"/>
                        <path d="M9 14h6"/>
                    </svg>
                    Wire Transfer
                </label>
                <label class="modal_create_payment_method_tab-label" for="tab-pingpong" role="tab" aria-controls="panel-pingpong"
                       aria-selected="false">
                    <!-- PingPong icon (arrows) -->
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" aria-hidden="true">
                        <path d="M4 7h11l-3-3M20 17H9l3 3"/>
                    </svg>
                    PingPong
                </label>
            </div>

            <!-- Panels -->
            <div class="modal_create_payment_method_panels">
                <section class="modal_create_payment_method_panel" id="panel-paypal" role="tabpanel" aria-labelledby="tab-paypal">
                    <div class="method">
                        <div>
                            <h3>Pay with PayPal</h3>
                            <p>( Minimum Payment: $25. Paypal may charge a transaction fee, we don't take this fee )</p>
                        </div>
                    </div>
                    <div>
                        <div class="field">
                            <label for="pp-email">PayPal
                                Email @include('administrator.components.lable_require')</label>
                            <input type="email" id="pp-email" placeholder="you@example.com" value="{{$userPaymentMethodPaypal->paypal_email}}"/>
                        </div>
                    </div>
                    <div class="actions">
                        <button onclick="onSavePaypal()" class="modal_create_payment_method_btn primary text-white" type="button">Save and make default</button>
                    </div>
                </section>

                <section class="modal_create_payment_method_panel" id="panel-crypto" role="tabpanel" aria-labelledby="tab-crypto">
                    <div class="method">
                        <div>
                            <h3>Pay with Crypto</h3>
                            <p>( Minimum Payment: $50. Crypto networks may charge a transaction fee, we don't take this
                                fee )</p>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="field">
                            <label for="crypto_coin">Select coin @include('administrator.components.lable_require')</label>
                            <select id="crypto_coin">
                                <option value="USDT" {{$userPaymentMethodCrypto->crypto_coin == "USDT" ? 'selected' : ''}}>USDT</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="crypto_network">Network @include('administrator.components.lable_require')</label>
                            <select id="crypto_network">
                                <option value="BSN Smart Chain (BEP20)" {{$userPaymentMethodCrypto->crypto_network == "BSN Smart Chain (BEP20)" ? 'selected' : ''}}>BSN Smart Chain (BEP20)</option>
                                <option value="Tron (TRC20)" {{$userPaymentMethodCrypto->crypto_network == "Tron (TRC20)" ? 'selected' : ''}}>Tron (TRC20)</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="field mt-3">
                            <label for="crypto_address">USDT
                                Address @include('administrator.components.lable_require')</label>
                            <input id="crypto_address" type="text" placeholder="USDT Address" value="{{$userPaymentMethodCrypto->crypto_address}}"/>
                        </div>
                    </div>

                    <div class="actions">
                        <button onclick="onSaveCrypto()" class="modal_create_payment_method_btn primary text-white" type="button">Save and make default</button>
                    </div>
                </section>

                <section class="modal_create_payment_method_panel" id="panel-wire" role="tabpanel" aria-labelledby="tab-wire">
                    <div class="method">
                        <div>
                            <h3>Wire Transfer</h3>
                            <p>( Minimum Payment: $200. The bank may charge a transaction fee, we don't take this fee
                                )</p>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="field col-6">
                            <label for="wire_transfer_beneficiary_name">Beneficiary
                                Name @include('administrator.components.lable_require')</label>
                            <input id="wire_transfer_beneficiary_name" type="text" placeholder="Beneficiary Name" value="{{$userPaymentMethodWireTransfer->wire_transfer_beneficiary_name}}"/>
                        </div>

                        <div class="field col-6">
                            <label for="wire_transfer_account_number">Account
                                Number @include('administrator.components.lable_require')</label>
                            <input id="wire_transfer_account_number" type="text" placeholder="Account Number" value="{{$userPaymentMethodWireTransfer->wire_transfer_account_number}}"/>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="field col-6">
                            <label for="wire_transfer_bank_name">Bank Name @include('administrator.components.lable_require')</label>
                            <input id="wire_transfer_bank_name" type="text" placeholder="Bank Name" value="{{$userPaymentMethodWireTransfer->wire_transfer_bank_name}}"/>
                        </div>

                        <div class="field col-6">
                            <label for="wire_transfer_swift_code">SWIFT/BIC
                                Code @include('administrator.components.lable_require')</label>
                            <input id="wire_transfer_swift_code" type="text" placeholder="SWIFT/BIC Code" value="{{$userPaymentMethodWireTransfer->wire_transfer_swift_code}}"/>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="field col-6">
                            <label for="wire_transfer_bank_address">Bank
                                Address @include('administrator.components.lable_require')</label>
                            <input id="wire_transfer_bank_address" type="text" placeholder="Bank Address" value="{{$userPaymentMethodWireTransfer->wire_transfer_bank_address}}"/>
                        </div>

                        <div class="field col-6">
                            <label for="wire_transfer_routing_number">Routing Number</label>
                            <input id="wire_transfer_routing_number" type="text" placeholder="Routing Number" value="{{$userPaymentMethodWireTransfer->wire_transfer_routing_number}}"/>
                        </div>
                    </div>

                    <div class="actions">
                        <button onclick="onSaveWireTransfer()" class="modal_create_payment_method_btn primary text-white" type="button">Save and make default</button>
                    </div>
                </section>

                <section class="modal_create_payment_method_panel" id="panel-pingpong" role="tabpanel" aria-labelledby="tab-pingpong">
                    <div class="method">
                        <div>
                            <h3>PingPong Payments</h3>
                            <p>( Minimum Payment: $50. )</p>
                        </div>
                    </div>
                    <div>
                        <div class="field">
                            <label for="ping_pong_email">PingPong
                                Email @include('administrator.components.lable_require')</label>
                            <input id="ping_pong_email" type="email" placeholder="Pingpong Email" value="{{$userPaymentMethodPingpong->ping_pong_email}}"/>
                        </div>

                    </div>
                    <div class="actions">
                        <button onclick="onSavePingPong()" class="modal_create_payment_method_btn primary text-white" type="button">Save and make default</button>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

