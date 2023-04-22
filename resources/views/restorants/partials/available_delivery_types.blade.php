<hr/>
<h6 class="heading-small text-muted mb-4">{{ __('Tipos de entrega disponíveis') }}</h6>
@php $availableDeliveryTypes = $restorant ? $restorant->getAvailableDeliveryTypes() : []; @endphp
<div>
  <div class="form-group focused">
    @foreach([
      (object)['id' => 'delivery', 'name' => 'Delivery'],
      (object)['id' => 'pickup',   'name' => 'Pickup'],
      (object)['id' => 'table',    'name' => 'Table'],
    ] as $deliveryType)
      <div class="custom-control custom-checkbox mb-3">
        <input
          class="custom-control-input"
          id="available-delivery-type-{{ $deliveryType->id }}"
          name="available_delivery_types[]"
          type="checkbox"
          value="{{ $deliveryType->id }}" 
          @if(in_array($deliveryType->id, $availableDeliveryTypes))
            checked
          @endif
        >
        <label class="custom-control-label" for="available-delivery-type-{{ $deliveryType->id }}">{{ __($deliveryType->name) }}</label>
      </div>
    @endforeach
  </div>
</div>