<div
    id="card-cart-payment" 
    class="card card-profile shadow mt--300"
    style="{{count($timeSlots) == 0 ? 'display: none':''}}"
>
    <div class="px-4">
      <div class="mt-5">
        <h3>{{ __('Checkout') }}<span class="font-weight-light"></span></h3>
      </div>
      <div  class="border-top">
        @if(count($timeSlots) == 0)
            <br/>
            <div class="alert alert-danger" role="alert">
            {{ __('The store is currently closed. The order can only be scheduled.')}}
            </div>
        @endif
        <!-- Price overview -->
        <div id="totalPrices" v-cloak>
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span v-if="totalPrice==0">{{ __('Cart is empty') }}!</span>

                            <span v-if="totalPrice"><strong>{{ __('Subtotal') }}:</strong></span>
                            <span v-if="totalPrice" class="ammount"><strong>@{{ totalPriceFormat }}</strong></span>
                            
                            <span v-if="totalPrice&&delivery"><br /><strong>{{ __('Delivery') }}:</strong></span>
                            <span v-if="totalPrice&&delivery" class="ammount"><strong>@{{ deliveryPriceFormated }}</strong></span><br />
                            <br />
                            
                            <span v-if="totalPrice"><strong>{{ __('TOTAL') }}:</strong></span>
                            <span v-if="totalPrice" class="ammount"><strong>@{{ withDeliveryFormat   }}</strong></span>
                            <input v-if="totalPrice" type="hidden" id="tootalPricewithDeliveryRaw" :value="withDelivery" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End price overview -->

        <!-- Payment  Methods -->
        <div class="cards">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <!-- Errors on Stripe -->
                        @if (session('error'))
                            <div role="alert" class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if(!config('settings.is_whatsapp_ordering_mode') && !config('settings.whatsapp_ordering_enabled') && !config('settings.enable_facebook_ordering') && !config('settings.is_facebook_ordering_mode'))
                        <!-- COD -->
                        @if (!config('settings.hide_cod'))
                            <div class="custom-control custom-radio mb-3">
                                <input
                                    name="paymentType"
                                    class="custom-control-input"
                                    id="cashOnDelivery"
                                    type="radio"
                                    value="cod"
                                    {{ config('settings.default_payment')=="cod"?"checked":""}}
                                >
                                <label class="custom-control-label" for="cashOnDelivery"><span class="delTime">{{ config('app.isqrsaas')?__('Cash / Card Terminal'): __('Cash on delivery') }}</span> <span class="picTime">{{ __('Cash on pickup') }}</span></label>
                            </div>
                        @endif

                        @if($enablePayments)

                            <!-- STIPE CART -->
                            @if (config('settings.stripe_key')&&config('settings.enable_stripe'))
                                <div class="custom-control custom-radio mb-3">
                                    <input name="paymentType" class="custom-control-input" id="paymentStripe" type="radio" value="stripe" {{ config('settings.default_payment')=="stripe"?"checked":""}}>
                                    <label class="custom-control-label" for="paymentStripe">{{ __('Pay with card') }}</label>
                                </div>
                            @endif

                            <!-- PayPal -->
                            @if (config('settings.paypal_secret')&&config('settings.enable_paypal'))
                                <div class="custom-control custom-radio mb-3">
                                    <input name="paymentType" class="custom-control-input" id="paymentPayPal" type="radio" value="paypal" {{ config('settings.default_payment')=="paypal"?"checked":""}}>
                                    <label class="custom-control-label" for="paymentPayPal">{{ __('Pay with PayPal') }}</label>
                                </div>
                            @endif

                            <!-- PAYFAST -->
                            @if(config('settings.enable_paystack'))
                                <div class="custom-control custom-radio mb-3">
                                    <input name="paymentType" class="custom-control-input" id="paymentPaystack" type="radio" value="paystack" {{ config('settings.default_payment')=="paystack"?"checked":""}}>
                                    <label class="custom-control-label" for="paymentPaystack">{{ __('Pay with Paystack') }}</label>
                                </div>
                            @endif

                            <!-- Mollie -->
                            @if(config('settings.enable_mollie'))
                                <div class="custom-control custom-radio mb-3">
                                    <input name="paymentType" class="custom-control-input" id="paymentMollie" type="radio" value="mollie" {{ config('settings.default_payment')=="mollie"?"checked":""}}>
                                    <label class="custom-control-label" for="paymentMollie">{{ __('Pay with Mollie') }}</label>
                                </div>
                            @endif

                        @endif

                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- END Payment -->

        <!-- Payment Actions -->
        @if(!config('settings.social_mode'))

            <!-- COD -->
            @include('cart.payments.cod')

            <!-- PayPal -->
            @if(config('settings.enable_paypal'))
                @include('cart.payments.paypal')
            @endif

            <!-- Paystack -->
            @if(config('settings.enable_paystack'))
                @include('cart.payments.paystack')
            @endif

            <!-- Mollie -->
            @if(config('settings.enable_mollie'))
                @include('cart.payments.mollie')
            @endif

            </form>

            <!-- Stripe -->
            @include('cart.payments.stripe')

            

        @elseif(config('settings.whatsapp_ordering'))
            @include('cart.payments.whatsapp')
        @elseif(config('settings.facebook_ordering'))
            @include('cart.payments.facebook')
        @endif
        <!-- END Payment Actions -->

        <br/><br/>
        <div class="text-center">
            <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" id="privacypolicy" type="checkbox" checked>
                <label class="custom-control-label" for="privacypolicy">{{ __('To submit the order, accept the terms below.') }}</label>
            </div>
        </div>

      </div>
      <br />
      <br />
    </div>
  </div>

  @if(isset($restorant) && $restorant->has_delivery_tax)
  <div class="card card-profile shadow mt-4" id="card-table-delivery-taxes">
    <div class="px-4">
        <div class="mt-5">
            <h3>{{ __('Delivery fee') }}<span class="font-weight-light"></span></h3>
        </div>

        <table class="w-100 table mb-5">
            <thead>
                <th>{{ __('Neighborhood') }}</th>
                <th class="text-right">{{ __('Delivery fee') }}</th>
            </thead>
            <tbody>
                @php
                    $arrayTaxes = $restorant->arrayTaxes();
                    $defaultTax = null;
                @endphp
                @foreach($arrayTaxes as $tax)
                    <?php
                        if($tax->neighborhood == 'Standard Tax') $defaultTax = $tax;
                        else{
                    ?>
                        <tr>
                            <td>{{ $tax->neighborhood }}</td>
                            <td class="text-right">
                                R$ {{ number_format($tax->tax, 2, ',', '.') }}
                            </td> 
                        <tr>
                    <?php } ?>
                @endforeach
                <tr>
                    <th>{{ __('Other neighborhoods') }}</th>
                    <td class="text-right">
                        {{
                            $defaultTax ?
                                "R$ ".number_format($defaultTax->tax, 2, ',', '.') : 
                                __('To match')
                        }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
  </div>
  @endif

  @if(config('settings.is_demo') && config('settings.enable_stripe'))
    @include('cart.democards')
  @endif