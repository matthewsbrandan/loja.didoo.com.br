@if($restorant &&
    $restorant->payment_info &&
    count(explode(',',$restorant->payment_info)) > 0)
<div
  id="card-cart-payment-info"
  class="card card-profile shadow"
  style="{{count($timeSlots) == 0 ? 'display: none':''}}"
>
    <div class="px-4">
      <div class="mt-5">
        <h3>{{ __('Payment method') }}<span class="font-weight-light"></span></h3>
      </div>
      <div class="card-content border-top">
        <br />

        <div class="row">
          @if ($restorant->asaas_api_key)
            <input type="hidden" id="has-asaas-key" value="true">
            <div class="col-6">
              <div class="custom-control custom-radio payment-online-delivery mb-3">
                <input name="paymentOnlineDelivery" class="custom-control-input paymentOnlineDelivery" id="paymentOnline" type="radio" value="online" {{ $restorant->asaas_api_key ? 'checked' : '' }}>
                <label class="custom-control-label paymentOnlineDeliveryLabel" for="paymentOnline">{{ __('Payment online') }}</label>
              </div>
            </div>
          @endif
  
          <div class="col-6">
            <input type="hidden" id="has-asaas-key" value="false">
            <div class="custom-control custom-radio payment-online-delivery mb-3">
              <input name="paymentOnlineDelivery" class="custom-control-input paymentOnlineDelivery" id="paymentInDelivery" type="radio" value="delivery" {{ $restorant->asaas_api_key ?: 'checked' }}>
              <label class="custom-control-label paymentOnlineDeliveryLabel" for="paymentInDelivery">{{ __('Payment in delivery') }}</label>
            </div>
          </div>
        </div>

        <?php
          $payment_infos = explode(',',$restorant->payment_info);
        ?>
        @foreach($payment_infos as $key => $payment)
        <div class="custom-control custom-radio mb-3" style="@if($restorant->asaas_api_key && !($payment == 'Credit Card' || $payment == 'Pix')) display:none; @endif">
          <input
            name="paymentMethod" class="custom-control-input paymentMethod"
            id="payment-method-{{$key}}" type="radio"
            value="{{$payment}}" 
            onClick="handleChangePaymentMethod($(this))"
            @if($restorant->asaas_api_key && in_array('Credit Card', $payment_infos) && $payment == 'Credit Card') checked @endif
            @if(!$restorant->asaas_api_key && $key == 0) checked @endif>
          <label class="custom-control-label" for="payment-method-{{$key}}">{{ __($payment) }}</label>
        </div>
        @endforeach
        @if(count($payment_infos) > 0 && in_array('Cash',$payment_infos))
        <div id="form-group-pay-change" class="form-group" style="{{ !$restorant->asaas_api_key ?: 'display: none' }}">
          <input
            type="text" name="payChange"
            id="pay-change" class="form-control{{ $errors->has('payChange') ? ' is-invalid' : '' }}"
            placeholder="{{ __('Change for $XXX') }}"
          />
          @if ($errors->has('payChange'))
            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('payChange') }}</strong></span>
          @endif
        </div>
        @endif

        @if($restorant->asaas_api_key && (in_array('Credit Card',$payment_infos) || in_array('Debit Card',$payment_infos)))
        <div class="row" id="credit-card-form">
          <div class="col-12 col-md-6">
            <div class="form-group">
              <input
                type="text" name="creditCard[number]" class="form-control {{ $errors->has('creditCard.number') ? 'is-invalid' : '' }}"
                placeholder="{{ __('Credit card number') }}"
              />
              @if ($errors->has('creditCard.number'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('creditCard.number') }}</strong></span>
            @endif
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <input
                type="text" name="creditCard[expirationDate]" class="form-control expiration-date {{ $errors->has('creditCard.expirationDate') ? 'is-invalid' : '' }}"
                placeholder="{{ __('Credit card expiration') }}"
              />
              @if ($errors->has('creditCard.expirationDate'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('creditCard.expirationDate') }}</strong></span>
              @endif
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <input
                type="text" name="creditCard[name]" class="form-control {{ $errors->has('creditCard.name') ? 'is-invalid' : '' }}"
                placeholder="{{ __('Credit card name') }}"
              />
              @if ($errors->has('creditCard.name'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('creditCard.name') }}</strong></span>
              @endif
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <input
                type="text" name="creditCard[cvc]" class="form-control {{ $errors->has('creditCard.cvc') ? 'is-invalid' : '' }}"
                placeholder="{{ __('Credit card cvc') }}"
              />
              @if ($errors->has('creditCard.cvc'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('creditCard.cvc') }}</strong></span>
              @endif
            </div>
          </div>
        </div>
        @endif
      </div>
      <br />
      <br />
    </div>
  </div>
  <br />
  <script>
    @if(count($payment_infos) > 0 && in_array('Cash',$payment_infos))
    function handleChangePaymentMethod(elem){
      if(elem.is(":checked") && elem.val() == 'Cash'){ // Cash, Debit Card, Credit Card, Pix

        $('#credit-card-form').hide('slow');
        $('#form-group-pay-change').show('slow');
        // $('#pay-change').attr('required',true);

      }else if(elem.is(":checked") && (elem.val() == 'Credit Card') && $('.paymentOnlineDelivery:checked').val() == 'online'){

        $('#credit-card-form').show('slow');
        $('#form-group-pay-change').hide('slow');
        $('#addressBox').show();
        // $('#pay-change').attr('required',false);

      }else{

        $('#credit-card-form').hide('slow');
        $('#form-group-pay-change').hide('slow');
        // $('#pay-change').attr('required',false).val('');

      }
    }
    @endif

    $(document).ready(function () {
      $('.expiration-date').inputmask("99/9999");
    });
  </script>
@endif
