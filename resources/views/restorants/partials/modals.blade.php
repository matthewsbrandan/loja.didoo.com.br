<style>
  @media (max-width: 575px){
    #productModal .modal-dialog{
      margin: 8% 0 0;
      width: 100%;
    }
    #productModal .modal-content{
      width: 100%;
      border-top-left-radius: 1rem;
      border-top-right-radius: 1rem;
    }
    #productModal .modal-header{
      padding: 1.4rem 1.6rem 0;
      border: none;
    }
    #productModal #modalTitle{
      font-weight: bold;
      font-size: 1.15rem;
    }
    #productModal #modalPrice{
      font-weight: bold;
      font-size: 1.35rem;
      padding-top: .4rem;
      color: #32325d;
      display: block;
    }
    #productModal #addToCart1{
      background: #e9e9e9;
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 1.6rem 1.2rem;
      border-top-left-radius: 1rem;
      border-top-right-radius: 1rem;
    }
    #productModal #addToCart1 > button{ width: 100%; }
  }
  #variants-area-inside .btn-outline-primary:hover,
  #variants-area-inside .btn-outline-primary.active{
    background: #6B238E !important;
    color: white !important;
  }
  #variants-area-inside .btn-outline-primary{
    border-color: #6B238E !important;
    color: #6B238E !important;
    border-radius: .6rem;
    font-size: .8rem;
    cursor: pointer;
    padding: .4rem;
    font-weight: 700;
  }
</style>
<div class="modal fade" id="productModal" z-index="9999" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-" role="document" id="modalDialogItem">
    <div class="modal-content">
      <div class="modal-mobile-header d-sm-none" style="
        background: #6B238E;
        padding: .4rem 1rem;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
      ">
        <button
          onclick="clearDot()"
          type="button"
          style="gap: .5rem; opacity: 1; align-items: center;"
          class="close d-flex"
          data-dismiss="modal"
          aria-label="Close"
        >
          <p class="my-auto text-white" style="font-size: .8rem;">Voltar</p>
          <span aria-hidden="true" class="text-white" style="
            border: 2px solid white;
            border-radius: 50%;
            line-height: 1.1;
            height: 1.1rem;
            width: 1.1rem;
            font-size: .8rem;
          ">×</span>
        </button>
      </div>
      <div class="modal-header">
        <h5 id="modalTitle" class="modal-title" id="modal-title-new-item"></h5>
        <button onclick="clearDot()" type="button" class="close d-none d-sm-inline-block" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <div class="card bg-secondary shadow border-0">
          <div class="card-body px-lg-5 py-lg-5 pt-2 pt-sm-4 pb-8 pb-sm-4">
            <div class="row">
              <!-- carrocel de imagens -->
              <div class="col-sm col-md col-lg text-center" id="modalImgPart">
                <div class="container_carrocel">
                  <button onclick="prevImg()" class="btn-left">
                    <span class="material-icons-outlined">chevron_left</span>
                  </button>
                  <button onclick="nextImg()" class="btn-right">
                    <span class="material-icons-outlined">chevron_right</span>
                  </button>
                  <div class="scrol_img">
                    <a data-src data-fancybox="modal-gallery" id="containerImg">
                      <img class="item_img" id="modalImg" src=""/>
                    </a>
                  </div>
                  <div id="indicatingImageIndex"></div>
                </div>
              </div>
              <div class="col-sm col-md col-lg col-lg" id="modalItemDetailsPart">
                <input id="modalID" type="hidden"/>
                <span id="modalPrice" class="new-price"></span>
                <p id="modalDescription"></p>
                <div id="variants-area">
                  <label
                    class="form-control-label font-weight-bold"
                    style="color: #32325d;"
                  >{{ __('Select your options') }}</label>
                  <div id="variants-area-inside">
                  </div>
                </div>
                <div id="exrtas-area">
                  <br />
                  <label
                    class="form-control-label font-weight-bold"
                    style="color: #32325d;"
                    for="quantity"
                  >{{ __('Extras') }}</label>
                  <div id="exrtas-area-inside">
                  </div>
                </div>
                @if(  !(isset($canDoOrdering)&&!$canDoOrdering)   )
                  <div class="quantity-area">
                    <div class="form-group">
                      <br class="d-none d-sm-block"/>
                      <label
                        class="form-control-label font-weight-bold"
                        style="color: #32325d;"
                        for="quantity"
                      >{{ __('Quantity') }}</label>

                      <div
                        class="d-flex form-control form-control-alternative p-0"
                        style="width: fit-content; border: 2px solid #6B238E; border-radius: .6rem;"
                      >
                        <button
                          type="button"
                          style="padding: .625rem .75rem;"
                          onclick="if(Number($(this).next().val() ?? 0) > 1) $(this).next().val(Number($(this).next().val() ?? 0) - 1)"
                        ><i style="color: #6B238E;" class="fa fa-minus"aria-hidden="true"></i></button>
                        <input
                          required
                          autofocus
                          value="1"
                          type="number"
                          id="quantity"
                          name="quantity"
                          class="text-center"
                          placeholder="{{ __('1') }}"
                          style="flex: 1; padding: .625rem .25rem; max-width: 5rem; color: #32325d;"
                          min="1"
                        />
                        <button
                          type="button"
                          style="padding: .625rem .75rem;"
                          onclick="$(this).prev().val(Number($(this).prev().val() ?? 0) + 1)"
                        ><i style="color: #6B238E;" class="fa fa-plus" aria-hidden="true"></i></button>
                      </div>
                    </div>
                    <div class="quantity-btn">
                      <div id="addToCart1">
                        <button
                          class="btn btn-primary"
                          v-on:click='addToCartAct'
                          style="background: #6B238E; border-radius: 1rem;"
                        >{{ __('Add To Cart') }}</button>
                      </div>
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-import-restaurants" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modal-title-new-item">{{ __('Import restaurants from CSV') }}</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <div class="card bg-secondary shadow border-0">
          <div class="card-body px-lg-5 py-lg-5">
            <div class="col-md-10 offset-md-1">
            <form role="form" method="post" action="{{ route('import.restaurants') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group text-center{{ $errors->has('item_image') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="resto_excel">Import your file</label>
                <div class="text-center">
                  <input type="file" class="form-control form-control-file" name="resto_excel" accept=".csv, .ods, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                </div>
              </div>
              <input name="category_id" id="category_id" type="hidden" required>
              <div class="text-center">
                <button type="submit" class="btn btn-primary my-4">{{ __('Save') }}</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@isset($restorant)
  <div class="modal fade" id="modal-about-us" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h3 class="modal-title">Sobre Nós</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body pt-0">
          <p class="mb-2">  {{ $restorant->description }}</p>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal-scheduling" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">{{ __('To schedule') }}</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body p-0">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="col-md-10 offset-md-1">
              <!-- BEGIN:: FUNCTION SCHEDULE -->
              <script>
                var openingHours = @json($restorant->hours);

                function handleSubmitSchedule(event){
                  $('#modal-scheduling').scrollTop(0);
                  let messages = [
                    '{{ __('Select date') }}',
                    '{{ __('Store closed, select another date') }}',
                    "<?php echo __("Unavailable hours, click 'Available Hours' to see the store's schedule."); ?>",
                    '{{ __('Scheduled') }}'
                  ];

                  event.preventDefault();

                  if(!$('#scheduling-time').val()){
                    $('#alert-scheduling')
                      .addClass('alert-danger')
                      .removeClass('alert-success')
                      .html(messages[0])
                      .show('slow');
                    return;
                  }

                  let newDate = new Date($('#scheduling-time').val());
                  let weekday = newDate.getDay() - 1; /* 0 - 6 Domingo - Sábado */
                  if(weekday == -1) weekday = 6; /* 0 - 6 Segunda - Domingo */
                  if(!openingHours[weekday+'_from']){
                    $('#alert-scheduling')
                      .addClass('alert-danger')
                      .removeClass('alert-success')
                      .html(messages[1])
                      .show('slow');
                    return;
                  }
                  let hours = newDate.getHours();
                  let minutes = newDate.getMinutes();
                  // BEGIN:: HANDLE TIME
                  let parsedHour = String(hours).padStart(2,'0');
                  let parsedMin = '00';
                  if(![0,30].includes(minutes)){
                    if(minutes < 15){
                      minutes = 0;
                      parsedMin = '00';
                    }
                    else if(minutes > 45){
                      minutes = 0;
                      parsedMin = '00';
                      hours++;
                      parsedHour = String(hours).padStart(2,'0');
                    }
                    else{
                      minutes = 30;
                      parsedMin = '30';
                    }
                    let parsedTime = `${parsedHour}:${parsedMin}`;
                    let val = $('#scheduling-time').val();
                    val = val.substr(0,val.length - 5) + parsedTime;

                    $('#scheduling-time').val(val);
                  }
                  // END:: HANDLE TIME
                  let hoursOpen = {
                    from: {
                      h: Number(openingHours[weekday+'_from'].split(':')[0]),
                      m: Number(openingHours[weekday+'_from'].split(':')[1])
                    },
                    to: {
                      h: Number(openingHours[weekday+'_to'].split(':')[0]),
                      m: Number(openingHours[weekday+'_to'].split(':')[1])
                    }
                  };
                  let hourClosed = false;
                  if(hours < hoursOpen.from.h || hours > hoursOpen.to.h) hourClosed = true;
                  else if(hours == hoursOpen.from.h && minutes < hoursOpen.from.m) hourClosed = true;
                  else if(hours == hoursOpen.to.h && minutes > hoursOpen.to.m) hourClosed = true;
                  if(hourClosed){
                    $('#alert-scheduling')
                      .addClass('alert-danger')
                      .removeClass('alert-success')
                      .html(messages[2])
                      .show('slow');
                    return;
                  }
                  $('#alert-scheduling')
                    .addClass('alert-success')
                    .removeClass('alert-danger')
                    .html(messages[3])
                    .show('slow');
                  
                  $('#modal-scheduling').modal('hide');

                  handleScheduleInCart(
                    weekday,
                    $('#scheduling-time').val()
                  );
                  
                  sessionStorage.setItem('schedule_order',JSON.stringify({
                    weekday: weekday,
                    time: $('#scheduling-time').val()
                  }));
                  openNav();
                  return;
                }
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

                  $('#totalPrices').append(`
                    <div class="card card-stats mb-4 mb-xl-0" id="scheduling-in-cart">
                      <div class="card-body">
                        <strong class="text-success">Agendado para:</strong><br/>
                        ${weekdays[weekday_i]} - ${dateFormatted}

                        <button type="button" class="close" aria-label="Close" style="position: absolute; top: .4rem; right: .2rem;" onclick="handleRemoveSchedule()">
                          <span aria-hidden="true">×</span>
                        </button>
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
                  }
                }
                function handleInputTime(elem){
                  let val = elem.val();
                  try{
                    let date = new Date(val);
                    let minutes = date.getMinutes();
                    let parsedMin = '00';
                    
                    if(minutes && ![0,30].includes(minutes)){
                      if(minutes > 15 && minutes < 45){
                        parsedMin = '30';
                      }
                      val = val.substr(0,val.length - 2) + parsedMin;
                      elem.val(val);
                    }
                  }catch{ return; }
                }
              </script>
              <!-- END:: FUNCTION SCHEDULE -->
              <form role="form" method="post" onSubmit="handleSubmitSchedule(event)">
                @csrf
                <div class="alert" role="alert" id="alert-scheduling" style="display: none;"></div>
                <div class="form-group text-center" id="scheduling-select-to-time">
                  <br />
                  <label class="form-control-label text-center" for="scheduling-time">{{ __('Day / Time') }}
                    <span id="span-opening-hours"></span>
                  </label>
                  <?php
                    $dateNow = \Carbon\Carbon::now()->setTimezone('America/Sao_Paulo')->format('Y-m-dTH:i');
                    $dateNow = str_replace('-03', 'T', $dateNow);
                  ?>
                  <input class="form-control input active" tabindex="0" type="datetime-local" id="scheduling-time" name="scheduling-time" min="{{ $dateNow }}">
                </div>
                <div class="form-group text-center">
                  <?php 
                    $hours = [
                      '0' => 'Monday',
                      '1' => 'Tuesday',
                      '2' => 'Wednesday',
                      '3' => 'Thursday',
                      '4' => 'Friday',
                      '5' => 'Saturday',
                      '6' => 'Sunday'
                    ];
                  ?>
                  <button
                    type="button" style="min-width: 10rem; margin-bottom: 1.2rem !important; display: inline-block;"
                    class="btn btn-light my-1 btn-day-schedule"
                    onclick="$(this).next().toggle()"
                  >
                    {{ __('Available times') }}
                  </button>
                  <table class="table" style="display: none;">
                    @foreach ($hours as $key => $hour)
                      @if(isset($restorant->hours) && isset($restorant->hours[$key.'_from']) && $restorant->hours[$key.'_from'])
                        <tr>
                          <td>{{ __($hour)}}</td>
                          <td>
                            {{ $restorant->hours[$key.'_from']. ' - ' .$restorant->hours[$key.'_to'] }}
                          </td>
                        </tr>
                      @endif
                    @endforeach
                  </table>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">{{ __('To schedule') }}</button>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal-restaurant-info" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document" >
      <div class="modal-content">
        <div class="modal-body p-0">
          <div class="card">
            <div class="card-header bg-white text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
              <img class="rounded" src="{{ $restorant->icon }}" width="90px" height="90px"></img>
              <h4 class="heading mt-4">{{ $restorant->name }} &nbsp;@if(count($restorant->ratings))<span><i class="fa fa-star" style="color: #dc3545"></i> <strong>{{ number_format($restorant->averageRating, 1, '.', ',') }} <span class="small">/ 5 ({{ count($restorant->ratings) }})</strong></span></span>@endif</h4>
              <p class="description">{{ $restorant->description }}</p>
              @if(!empty($openingTime) && !empty($closingTime))
                <p class="description">{{ __('Open') }}: {{ $openingTime }} - {{ $closingTime }}</p>
              @endif
            </div>
            <div class="card-body">
              <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">{{ __('About') }}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{ __('Reviews') }}</a>
                  </li>
                </ul>
              </div>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                  <div class="row">
                    <div class="col-md-6">
                      <h6 class="heading-small">{{ __('Phone') }}</h6>
                      <p class="heading-small text-muted">{{ $restorant->phone }}</p>
                      <br/>
                      <h6 class="heading-small">{{ __('Address') }}</h6>
                      <p class="heading-small text-muted">{{ $restorant->address }}</p>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div id="map3" class="form-control form-control-alternative"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                  @if(count($restorant->ratings) != 0)
                    <br/>
                    <h5>{{ count($restorant->ratings) }} {{ count($restorant->ratings) == 1 ? __('Review') : __('Reviews')}}</h5>
                    <hr />
                    
                    @foreach($restorant->ratings as $rating)
                      <div class="strip">
                        <span class="res_title"><b>{{ $rating->user->name }}</b></span><span class="float-right"><i class="fa fa-star" style="color: #dc3545"></i> <strong>{{ number_format($rating->rating, 1, '.', ',') }} <span class="small">/ 5</strong></span></span><br />
                        <span class="text-muted"> {{ $rating->created_at->format(env('DATETIME_DISPLAY_FORMAT','d M Y')) }}</span><br/>
                        <br/>
                        <span class="res_description text-muted">{{ $rating->comment }}</span><br />
                      </div>
                    @endforeach
                  @else
                  <p>{{ __('There are no reviews yet.') }}<p>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal-import-restaurants" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="modal-title-new-item">{{ __('Import restaurants from CSV') }}</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body p-0">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="col-md-10 offset-md-1">
              <form role="form" method="post" action="{{ route('import.restaurants') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group text-center{{ $errors->has('item_image') ? ' has-danger' : '' }}">
                  <label class="form-control-label" for="resto_excel">Import your file</label>
                  <div class="text-center">
                    <input type="file" class="form-control form-control-file" name="resto_excel" accept=".csv, .ods, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                  </div>
                </div>
                <input name="category_id" id="category_id" type="hidden" required>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">{{ __('Save') }}</button>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    <script>
      let containerImag = document.querySelector('.scrol_img');
      let productsImg = document.querySelectorAll('.item_img');
      let sliderImg = document.querySelector('#containerImg');
      let dot = 0;
      let scrollX = 0;
      let widthCard = 0;
      let qtdImg = 0;
      // Dot mobile
      let currentR = 0;

    
    

      const nextDotMobile = () => {
        const lateralDistance = sliderImg.scrollLeft;
        if(lateralDistance == widthCard){
          currentR += lateralDistance + widthCard
          if(dot < qtdImg - 1){
          setDot(dot + 1)
          dotActive(dot)
        }

        }else if( lateralDistance == currentR){
          currentR += widthCard
          if(dot < qtdImg - 1){
          setDot(dot + 1)
          dotActive(dot)
          }   
        }
      }
      const prevDotMobile = () => {
        const lateralDistance = sliderImg.scrollLeft;
          currentR = currentR - widthCard
          if(dot >  0){
          setDot(dot - 1)
          dotActive(dot)}
      }
      sliderImg.addEventListener('scroll',(e)=>{
        const lateralDistance = sliderImg.scrollLeft;           
          if(lateralDistance >= currentR){
            nextDotMobile()
          }else if( lateralDistance + widthCard < currentR){
            prevDotMobile()
          
          }
      })
    



  
      function setScrollX(v) {
        scrollX = v;
        sliderImg.style.marginLeft = `${scrollX}px`;
      }

      function setWidthCard(v){ 
        widthCard = v;  
      }
      function setQtdImg(v){
        qtdImg = v;
      }
      const setDot = (v) => dot = v;
    
      function loadSlider(a, b) {
        // a = quantidade de imagens dentro do carrosel.
        // b = width do container que segura as imagens.
        let qtd = a * b;
        sliderImg.style.width = `${qtd}px`;
        setWidthCard(b);
        setQtdImg(a);
        indexImage()
      }
    
      function prevImg(){
        let x = scrollX + widthCard;
        if (x > 0) {
          x = 0
          
        }
        setScrollX(x)
        if(dot >  0){
          setDot(dot - 1)
          dotActive(dot)
        }
      
      }
      function nextImg(){
        let x = scrollX - widthCard;
        let listW = qtdImg * widthCard;
        if ((widthCard - listW > x)) {
          x = widthCard - listW
          
        }
        setScrollX(x)
        if(dot < qtdImg - 1){
          setDot(dot + 1)
          dotActive(dot)
        }
      }
      function indexImage(){
        let containerDot = document.getElementById('indicatingImageIndex');
      
        for(let i = 0; i < qtdImg; i++){
          containerDot.innerHTML += `<div class='dot'></div>`
        }
        let dots = document.querySelectorAll('.dot');
        dots[0].classList.add('dotActive');
      }
      const dotActive = (v) =>{
        let dots = document.querySelectorAll('.dot');
        for(let i = 0; i < qtdImg; i++ ){
          dots[i].classList.remove('dotActive');
        }
        dots[v].classList.add('dotActive');

      }
      const clearDot = () => {
        let containerDot = document.getElementById('indicatingImageIndex');
        containerDot.innerHTML = ''
        dot = 0;
        scrollX = 0;
        widthCard = 0;
        qtdImg = 0;
        setScrollX(0);
      }
    </script>
  </div>
@endisset