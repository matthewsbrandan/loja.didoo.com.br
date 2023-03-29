@isset($restorant)
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
                            var currentWeekday = null;

                            function handleToggleDaySchedule(elem,weekday){
                                console.log(openingHours);
                                $('.btn-day-schedule').removeClass('btn-primary').addClass('btn-light');
                                elem.toggleClass('btn-light btn-primary');
                                currentWeekday = weekday;
                                
                                $('#span-opening-hours').html(`${openingHours[weekday+'_from']} - ${openingHours[weekday+'_to']}`);
                                $('#scheduling-time').attr('min',openingHours[weekday+'_from']).attr('max',openingHours[weekday+'_to']);
                                $('#scheduling-select-to-time').show('slow');
                            }

                            function handleSubmitSchedule(event){
                                let messages = [
                                    '{{ __('Select weekday') }}',
                                    '{{ __('Select time')}}',
                                    '{{ __('Scheduled')}}'
                                ];

                                event.preventDefault();
                                if(currentWeekday == null){
                                    $('#alert-scheduling')
                                        .addClass('alert-danger')
                                        .removeClass('alert-success')
                                        .html(messages[0])
                                        .show('slow');
                                }else if(!$('#scheduling-time').val()){
                                    $('#alert-scheduling')
                                        .addClass('alert-danger')
                                        .removeClass('alert-success')
                                        .html(messages[1])
                                        .show('slow');
                                }else{
                                    $('#alert-scheduling')
                                        .addClass('alert-success')
                                        .removeClass('alert-danger')
                                        .html(messages[2])
                                        .show('slow');

                                    $('#modal-scheduling').modal('hide');

                                    handleScheduleInCart(
                                        currentWeekday,
                                        $('#scheduling-time').val()
                                    );
                                    
                                    sessionStorage.setItem('schedule_order',JSON.stringify({
                                        weekday: currentWeekday,
                                        time: $('#scheduling-time').val()
                                    }));
                                    openNav();
                                }
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

                                $('#totalPrices').append(`
                                    <div class="card card-stats mb-4 mb-xl-0" id="scheduling-in-cart">
                                        <div class="card-body">
                                            <strong class="text-success">Agendado para:</strong><br/>
                                            ${weekdays[weekday_i]} - ${time}

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
                                if(val.length == 5){
                                    let arrVal = val.split(':');
                                    
                                    if(arrVal.length == 2 && !['00','30'].includes(arrVal[1])){
                                        if(parseInt(arrVal[1]) < 15){
                                            arrVal[1] = '00';
                                        }else
                                        if(parseInt(arrVal[1]) < 45){
                                            arrVal[1] = '30';
                                        }else{
                                            arrVal[0] = String(parseInt(arrVal[0])+1).padStart(2,"0");
                                            arrVal[1] = '00';
                                        }
                                        val = arrVal.join(':');
                                        elem.val(val);
                                    }
                                }
                            }
                        </script>
                        <!-- END:: FUNCTION SCHEDULE -->
                        <form role="form" method="post" onSubmit="handleSubmitSchedule(event)">
                            @csrf
                            <div class="alert" role="alert" id="alert-scheduling" style="display: none;"></div>
                            <div class="form-group text-center">
                                <br />
                                <label class="form-control-label">{{ __('Weekday (available)') }}</label>
                                <div class="d-flex flex-wrap justify-content-center">
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
                                    @foreach ($hours as $key => $hour)
                                        @if(isset($restorant->hours) && isset($restorant->hours[$key.'_from']) && $restorant->hours[$key.'_from'])
                                            <button type="button" class="btn btn-sm btn-light my-1 btn-day-schedule" onclick="handleToggleDaySchedule($(this),'{{$key}}')" style="min-width: 10rem;">{{ __($hour)}}</button>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group text-center" style="display: none;" id="scheduling-select-to-time">
                                <br />
                                <label class="form-control-label text-center" for="scheduling-time">{{ __('Schedule') }}
                                    <span id="span-opening-hours"></span>
                                </label>
                                <input class="form-control input active" tabindex="0" type="time" id="scheduling-time" name="scheduling-time" step="1800">
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
    <script>
        let containerImag = document.querySelector('.scrol_img');
        let productsImg = document.querySelectorAll('.item_img');
        let sliderImg = document.querySelector('#containerImg');

        let scrollX = 0;
        let widthCard = 0;
        let qtdImg = 0;
        
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
        function loadSlider(a, b) {
            // a = quantidade de imagens dentro do carrosel.
            // b = width do container que segura as imagens.
            let qtd = a * b;
            sliderImg.style.width = `${qtd}px`;
            setWidthCard(b);
            setQtdImg(a);
        }
       
        function prevImg(){
            let x = scrollX + widthCard;
            if (x > 0) {
                x = 0
            }
            setScrollX(x)
           
        }
        function nextImg(){
            let x = scrollX - widthCard;
            let listW = qtdImg * widthCard;
            if ((widthCard - listW > x)) {
                x = widthCard - listW
            }
            setScrollX(x)
        }
    </script>
</div>
@endisset