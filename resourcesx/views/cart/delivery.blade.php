<div
  id="card-cart-delivery"
  class="card card-profile shadow"
  style="{{count($timeSlots) == 0 ? 'display: none':''}}"
>
    <div class="px-4">
      <div class="mt-5">
        <h3>{{ __('Delivery / Pickup') }}<span class="font-weight-light"></span></h3>
      </div>
      <div class="card-content border-top">
        <br />

        <div class="custom-control custom-radio mb-3">
          <input name="deliveryType" class="custom-control-input" id="deliveryTypeDeliver" type="radio" value="delivery" checked>
          <label class="custom-control-label" for="deliveryTypeDeliver">{{ __('Delivery') }}</label>
        </div>
        <div class="custom-control custom-radio mb-3">
          <input name="deliveryType" class="custom-control-input" id="deliveryTypePickup" type="radio" value="pickup">
          <label class="custom-control-label" for="deliveryTypePickup">{{ __('Pickup') }}</label>
        </div>
        <div class="custom-control custom-radio mb-3">
          <input name="deliveryType" class="custom-control-input" id="deliveryTypeTable" type="radio" value="table">
          <label class="custom-control-label" for="deliveryTypeTable">{{ __('Table') }}</label>
        </div>
        @include('partials.input',['ftype'=>'input','name'=>"",'id'=>"tableNumber",'placeholder'=>"Your table number here ...",'required'=>false])
        @include('partials.input',['ftype'=>'input','name'=>"",'id'=>"nameID",'placeholder'=>"Your name here ...",'required'=>true])
      </div>
      <br />
      <br />
    </div>
  </div>
  <br />
