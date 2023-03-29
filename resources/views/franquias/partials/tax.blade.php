<div class="card card-profile bg-secondary shadow" id="container-taxes">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="h3 mb-0">{{ __("Delivery fee")}}</h5>
    <div
      class="custom-control custom-checkbox"
      style="margin-top: -2.2rem;"
      onclick="window.location.href = '{{ route('restaurant.untax',['rid' => $restorant->id]) }}'"
    >
      <input
        type="checkbox"
        name="days"
        class="custom-control-input"
        id="has_delivery_tax"
        @if($restorant->has_delivery_tax) checked @endif
      />
      <label class="custom-control-label" for="has_delivery_tax"></label>
    </div>
  </div>
  @if($restorant->has_delivery_tax)
  <div class="card-body">
    <form method="post" action="{{ route('restaurant.tax') }}" autocomplete="off" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="rid" value="{{ $restorant->id }}"/>
      <div class="form-group">
        <div class="row" style="margin-bottom: -0.5rem;">
          <div class="col-6"><strong>{{ __('Neighborhood') }}</strong></div>
          <div class="col-4"><strong>{{ __('Tax') }}</strong></div>
          <div class="col-2">
            <button class="btn btn-icon btn-1 btn-sm btn-primary d-block ml-auto" type="button" style="
              height: 1.4rem;
              font-size: .6rem !important;
            " onclick="addNewInputTax()">
              <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
            </button>
          </div>
          
        </div>
        <div id="tax_container">
          @php $defaultTax = null; @endphp
          @foreach($restorant->arrayTaxes() as $tax)
            <?php
              if($tax->neighborhood == 'Standard Tax') $defaultTax = $tax;
              else{
            ?>
            <div class="row" style="margin-top: 1rem;">
              <div class="col-6">
                <div class="input-group">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="{{ __('Neighborhood') }}"
                    value="{{ $tax->neighborhood }}"
                    name="tax_neighborhood[]"
                    required
                  />
                </div>
              </div>
              <div class="col-6 d-flex align-items-center">
                <div class="input-group">
                  <input
                    type="number"
                    class="form-control"
                    placeholder="0.00"
                    value="{{ $tax->tax }}"
                    name="tax_value[]"
                    required
                  />
                </div>
                <button
                  class="btn btn-icon btn-1 btn-sm btn-danger d-block"
                  type="button" style="margin-left: 0.4rem;"
                  onclick="$(this).parent().parent().remove();"
                >
                  <span class="btn-inner--icon"><i class="fa fa-trash"></i></span>
                </button>
              </div>
            </div>
            <?php } ?>
          @endforeach
        </div>
        <hr/>
        <div class="row">
          <div class="col-6">
            <strong>{{ __('Standard Tax') }}</strong><br/>
            <small class="text-muted">{!! __("If you leave this field empty, the rate will be <br/>'To match'") !!}</small>
          </div>
          <div class="col-6">
            <div class="input-group">
              <input
                type="number"
                class="form-control"
                placeholder="0.00"
                name="standard_tax"
                value="{{ $defaultTax ? $defaultTax->tax : '' }}"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="text-center">
          <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
      </div>
    </form>
  </div>
  @endif
</div>
<script>
  function addNewInputTax(){
    let html = `
      <div class="row" style="margin-top: 1rem;">
        <div class="col-6">
          <div class="input-group">
            <input
              type="text"
              class="form-control"
              placeholder="{{ __('Neighborhood') }}"
              name="tax_neighborhood[]"
              required
            />
          </div>
        </div>
        <div class="col-6 d-flex align-items-center">
          <div class="input-group">
            <input
              type="number"
              class="form-control"
              placeholder="0.00"
              name="tax_value[]"
              required
            />
          </div>
          <button
            class="btn btn-icon btn-1 btn-sm btn-danger d-block"
            type="button" style="margin-left: 0.4rem;"
            onclick="$(this).parent().parent().remove();"
          >
            <span class="btn-inner--icon"><i class="fa fa-trash"></i></span>
          </button>
        </div>
      </div>
    `;
    $('#tax_container').append(html);
  }
</script>