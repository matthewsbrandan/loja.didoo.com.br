@if(isset($restorant) &&
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
        <?php
          $payment_infos = explode(',',$restorant->payment_info);
        ?>
        @foreach($payment_infos as $key => $payment)
        <div class="custom-control custom-radio mb-3">
          <input
            name="paymentMethod" class="custom-control-input"
            id="payment-method-{{$key}}" type="radio"
            value="{{$payment}}" 
            onClick="handleChangePaymentMethod($(this))"
            @if($key == 0) checked @endif>
          <label class="custom-control-label" for="payment-method-{{$key}}">{{ __($payment) }}</label>
        </div>
        @endforeach
        @if(count($payment_infos) > 0 && in_array('Cash',$payment_infos))
        <div 
          id="form-group-pay-change" class="form-group" 
          @if($payment_infos[0] != 'Cash') style="display: none" @endif
        >
          <input
            type="number" name="payChange"
            id="pay-change" class="form-control"
            placeholder="{{ __('Change for $XXX') }}"
            @if($payment_infos[0] == 'Cash') required @endif
          />
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
        $('#form-group-pay-change').show('slow');
        $('#pay-change').attr('requried',true);
      }else{
        $('#form-group-pay-change').hide('slow');
        $('#pay-change').attr('requried',false).val('');
      }
    }
    @endif
  </script>
@endif
