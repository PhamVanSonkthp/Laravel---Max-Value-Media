<div class="modal_create_payment_method_card" role="region" aria-label="Payment methods">
    <div class="modal_create_payment_method_card-header">
        <div class="modal_create_payment_method_sub">Select one of the options below to proceed with checkout.</div>

        <div class="modal_create_payment_method_tabs" role="tablist" aria-label="Payment modal_create_payment_method_tabs">
            <!-- Radios (visually hidden) -->
            <input type="radio" name="modal_create_payment_method_tabs" id="tab-paypal" checked>
            <input type="radio" name="modal_create_payment_method_tabs" id="tab-crypto">
            <input type="radio" name="modal_create_payment_method_tabs" id="tab-wire">
            <input type="radio" name="modal_create_payment_method_tabs" id="tab-pingpong">

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
            <div class="panels">
                <section class="panel" id="panel-paypal" role="tabpanel" aria-labelledby="tab-paypal">
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
                            <input type="email" id="pp-email" placeholder="you@example.com"/>
                        </div>
                    </div>
                    <div class="actions">
                        <button class="modal_create_payment_method_btn primary text-white" type="button">Continue to PayPal</button>
                    </div>
                </section>

                <section class="panel" id="panel-crypto" role="tabpanel" aria-labelledby="tab-crypto">
                    <div class="method">
                        <div>
                            <h3>Pay with Crypto</h3>
                            <p>( Minimum Payment: $50. Crypto networks may charge a transaction fee, we don't take this
                                fee )</p>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="field">
                            <label for="coin">Select coin @include('administrator.components.lable_require')</label>
                            <select id="coin">
                                <option>USDT</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="network">Network @include('administrator.components.lable_require')</label>
                            <select id="network">
                                <option>BSN Smart Chain (BEP20)</option>
                                <option>Tron (TRC20)</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="field mt-3">
                            <label for="pp-email">USDT
                                Address @include('administrator.components.lable_require')</label>
                            <input type="text" placeholder="USDT Address"/>
                        </div>
                    </div>

                    <div class="actions">
                        <button class="modal_create_payment_method_btn primary text-white" type="button">Generate Address</button>
                    </div>
                </section>

                <section class="panel" id="panel-wire" role="tabpanel" aria-labelledby="tab-wire">
                    <div class="method">
                        <div>
                            <h3>Wire Transfer</h3>
                            <p>( Minimum Payment: $200. The bank may charge a transaction fee, we don't take this fee
                                )</p>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="field col-6">
                            <label for="acc-name">Beneficiary
                                Name @include('administrator.components.lable_require')</label>
                            <input type="text" placeholder="Beneficiary Name"/>
                        </div>

                        <div class="field col-6">
                            <label for="acc-name">Account
                                Number @include('administrator.components.lable_require')</label>
                            <input type="text" placeholder="Account Number"/>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="field col-6">
                            <label for="acc-name">Bank Name @include('administrator.components.lable_require')</label>
                            <input type="text" placeholder="Bank Name"/>
                        </div>

                        <div class="field col-6">
                            <label for="acc-name">SWIFT/BIC
                                Code @include('administrator.components.lable_require')</label>
                            <input type="text" placeholder="SWIFT/BIC Code"/>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="field col-6">
                            <label for="acc-name">Bank
                                Address @include('administrator.components.lable_require')</label>
                            <input type="text" placeholder="Bank Address "/>
                        </div>

                        <div class="field col-6">
                            <label for="acc-name">Routing Number</label>
                            <input type="text" placeholder="Routing Number"/>
                        </div>
                    </div>

                    <div class="actions">
                        <button class="modal_create_payment_method_btn primary text-white" type="button">Get Instructions</button>
                    </div>
                </section>

                <section class="panel" id="panel-pingpong" role="tabpanel" aria-labelledby="tab-pingpong">
                    <div class="method">
                        <div>
                            <h3>PingPong Payments</h3>
                            <p>( Minimum Payment: $50. )</p>
                        </div>
                    </div>
                    <div>
                        <div class="field">
                            <label for="ppg-email">PingPong
                                Email @include('administrator.components.lable_require')</label>
                            <input type="email" placeholder="Pingpong Email"/>
                        </div>

                    </div>
                    <div class="actions">
                        <button class="modal_create_payment_method_btn primary text-white" type="button">Continue with PingPong</button>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

