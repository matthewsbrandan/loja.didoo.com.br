@extends('layouts.front', ['class' => ''])
@section('content')
  <style>
    .fixed.inset-0.flex.items-end.justify-center.px-4.py-6.pointer-events-none{
      z-index: 99999 !important;
    }
  </style>
    <section class="section-profile-cover section-shaped my--1 d-none d-md-none d-lg-block d-lx-block">
        <!-- Circles background | (old: config('global.restorant_details_cover_image'))-->
        <img class="bg-image " src="{{ $restorant->coverm }}" style="width: 100%;">
        <!-- SVG separator -->
        <div class="separator separator-bottom separator-skew">

        </div>
    </section>
    <section class="section bg-secondary">
  
      <div class="container">


        <x:notify-messages />

          <div class="row">

            <!-- Left part -->
            <div class="col-md-7">

              <!-- List of items -->
              @include('cart.items')
                <form
                  id="order-form" role="form"
                  method="post" action="{{route('order.store')}}"
                  autocomplete="off" enctype="multipart/form-data"
                >
                <input type="hidden" id="deliveryToMatch" name="deliveryToMatch">
                <input type="hidden" id="deliveryCost" name="deliveryCost" value="0">
                @csrf
                @if(!config('settings.social_mode'))
                    @if (config('app.isft') && count($timeSlots)>0)
                    <!-- FOOD TIGER -->
                        <!-- Delivery method -->
                        @if($restorant->can_pickup == 1)
                            @if($restorant->can_deliver == 1)
                              @include('cart.delivery')
                            @endif
                        @endif

                        <!-- Delivery time slot -->
                        @include('cart.time')

                        <!-- Delivery address -->
                        <div id='addressBox'>
                            @include('cart.address')
                        </div>

                        <!-- Comment -->
                        @include('cart.comment')

                    @else

                      <!-- QRSAAS -->
                      
                      <!-- DINE IN OR TAKEAWAY -->
                      @if (config('settings.enable_pickup'))
                          @include('cart.localorder.dineiintakeaway')
                          <!-- Takeaway time slot -->
                          <div class="takeaway_picker" style="display: none">
                              @include('cart.time')
                          </div>
                      @endif

                      <!-- LOCAL ORDERING -->
                      @include('cart.localorder.table')


                      <!-- Local Order Phone -->
                      @include('cart.localorder.phone')

                      <!-- Comment -->
                      @include('cart.comment')
                        

                    @endif
                @else
                    <!-- Social MODE -->
                    <!-- @ if(count($timeSlots)>0) -->
                        <!-- Delivery method -->
                        @include('cart.payment_info')
                        @include('cart.delivery')
                        <!-- BEGIN:: SCHEDULE -->
                        <div class="card card-profile shadow" id="schedule_order" style="display: none;">
                          <div class="px-4">
                            <div class="mt-5">
                              <h3>{{ __('Scheduled to') }}</h3>
                            </div>
                            <div class="card-content border-top">
                              <br />
                              
                            </div>
                            <br />
                            <br />
                          </div>
                        </div>
                        <!-- END:: SCHEDULE -->
                        <!-- Delivery time slot -->
                        @include('cart.time')

                        <!-- Delivery adress -->
                        @include('cart.newaddress')

                        <!-- Comment -->
                        @include('cart.comment')
                    <!-- @ endif -->
                @endif

              <!-- Restaurant -->
              @include('cart.restaurant')
            </div>


          <!-- Right Part -->
          <div class="col-md-5">

            @if (count($timeSlots)>0)
                <!-- Payment -->
                @include('cart.payment')
                <!--
                  <br/>
                  @include('cart.coupons')
                -->
            @else
                <!-- Closed restaurant -->
                @include('cart.payment')
                @include('cart.closed')
            @endif
          </div>
        </div>
    </div>
    @include('clients.modals')
    <input type="hidden" id="deliveryCost" value="0">
  </section>
@endsection
@section('js')

  <script async defer src= "https://maps.googleapis.com/maps/api/js?key=<?php echo config('settings.google_maps_api_key'); ?>&callback=initAddressMap"></script>
  <!-- Stripe -->
  <script src="https://js.stripe.com/v3/"></script>
  <script>
    "use strict";
    var RESTORANT = <?php echo json_encode($restorant) ?>;
    var STRIPE_KEY="{{ config('settings.stripe_key') }}";
    var ENABLE_STRIPE="{{ config('settings.enable_stripe') }}";
    var initialOrderType = 'delivery';
    if(RESTORANT.can_deliver == 1 && RESTORANT.can_pickup == 0){
        initialOrderType = 'delivery';
    }else if(RESTORANT.can_deliver == 0 && RESTORANT.can_pickup == 1){
        initialOrderType = 'pickup';
    }
    // BEGIN:: FUNCTION SCHEDULE
    $(function(){
      let schedule_order = sessionStorage.getItem('schedule_order');
      
      @if(count($timeSlots) == 0)
        handleStoreClosed(schedule_order && schedule_order !== "null");
      @endif

      if(schedule_order && schedule_order !== "null"){
        schedule_order = JSON.parse(schedule_order);
        
        handleScheduleInCart(
          schedule_order.weekday,
          schedule_order.time
        );
        $('#schedule_order').show().next().hide();
      }
    });

    function handleScheduleInCart(weekday_i,time){
      let weekdays = [
          '{{__('Monday')}}',
          '{{__('Tuesday')}}',
          '{{__('Wednesday')}}',
          '{{__('Thursday')}}',
          '{{__('Friday')}}',
          '{{__('Saturday')}}',
          '{{__('Sunday')}}'
      ];

      handleRemoveSchedule(false);

      let dateFormatted = new Date(time).toLocaleDateString('pt-BR', {
        day: '2-digit',
        month: '2-digit',
        year: '2-digit',
        hour: 'numeric',
        minute: 'numeric'
      })

      $('#schedule_order .card-content').append(`
        <div class="card card-stats mb-4 mb-xl-0" id="scheduling-in-cart">
          <div class="card-body">
            <strong class="text-success">{{__('Scheduled to')}}:</strong><br/>
            ${weekdays[weekday_i]} - ${dateFormatted}
            @if(count($timeSlots)>0)
            <button type="button" class="close" aria-label="Close" style="position: absolute; top: .4rem; right: .2rem;" onclick="handleRemoveSchedule()">
              <span aria-hidden="true">×</span>
            </button>
            @endif
            <input type="hidden" name="weekday" value="${weekday_i}"/>
            <input type="hidden" name="time" value="${time}"/>
          </div>
        </div>
        <br/>
      `);
    }
    function handleRemoveSchedule(removeFromSession = true){
      if($('#scheduling-in-cart').length){
        $('#scheduling-in-cart').remove();
      }
      if(removeFromSession){
        sessionStorage.setItem('schedule_order', null);
        $('#schedule_order').hide().next().show();
      }
    }
    // END:: FUNCTION SCHEDULE
  </script>
  <script src="{{ asset('custom') }}/js/checkout.js"></script>
  <script>
    function handleStoreClosed(scheduled){
      if(scheduled){
        $('#card-cart-payment').show();
        $('#card-cart-closed').hide();
       
        $('#card-cart-payment-info').show();
        $('#card-cart-delivery').show();
        $('#card-cart-time').show();
        $('#addressBox').removeClass('d-none');
        $('#card-cart-comment').show();
      }
    }
    // ================
    $('#neighborhoodID').on('change', changeNeighborhood);
    function changeNeighborhood(){
      let deliveryCost = 0;
      $('#deliveryToMatch').val(null);
      if($('input[name=deliveryType]:checked').val() === 'delivery' && !!$('#neighborhoodID')){
        let currentTax = restorantTaxes.find(tax => tax.neighborhood === $('#neighborhoodID').val());
        if(currentTax) deliveryCost = Number(currentTax.tax);
        else{
          standardTax = restorantTaxes.find(tax => tax.neighborhood === 'Standard Tax');
          if(standardTax && standardTax.tax) deliveryCost = Number(standardTax.tax);
          else{
            $('#deliveryToMatch').val(true);
          }
        }
      }

      chageDeliveryCost(deliveryCost);
    }
    // ================
  </script>
@endsection

