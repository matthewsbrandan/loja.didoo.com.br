<nav id="navbar-main" class="navbar navbar-light navbar-expand-lg fixed-top">


    <div class="container-fluid">
        @if(!config('settings.hide_project_branding'))
          @if(isset($restorant))
            <a 
              class="navbar-brand mr-lg-5" 
              href="/store/{{$restorant->subdomain}}"
              style="display: flex; align-items: center"
            >
              <img src="{{ $restorant->logom }}" class="rounded">
              <div
              class="logoTop"
              style="
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding-left: 10px; 
              ">
                <h1 
                    style="cursor: pointer; margin: 0; padding: 0"
                >
                    {{ $restorant->name }}
                </h1>
                <p style="margin: 0; padding: 0; color: #fff; font-weight: normal;">
                  {{ $restorant->description }}
                </p>

              </div>
            </a>
          @else
            <a class="navbar-brand mr-lg-5" href="/">
              <img src="{{ config('global.site_logo') }}">
            </a>
          @endif
        @else
        <a class="navbar-brand mr-lg-5" href="/"></a>
        @endif

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
       
              <div></div>
              <div></div>
              <div></div>
    
        </button>

        <div class="navbar-collapse collapse" id="navbar_global">
          <div class="navbar-collapse-header">
            <div class="row">
              @if(!config('settings.hide_project_branding'))
              <div class="col-6 collapse-brand">
                <a href="#">
                  <img src="{{ config('global.site_logo') }}">
                </a>
              </div>
              @else
              <div class="col-6 collapse-brand">
                <a href="#">
                  
                </a>
              </div>
              @endif
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>

          <ul class="navbar-nav align-items-lg-center ml-lg-auto">
            @isset($restorant)
                @yield('addiitional_button_1')
                @yield('addiitional_button_2')
                @if(config('app.isqrsaas'))
                  
                  @if(config('settings.enable_call_waiter') && strlen(config('broadcasting.connections.pusher.app_id')) > 2 && strlen(config('broadcasting.connections.pusher.key')) > 2 && strlen(config('broadcasting.connections.pusher.secret')) > 2)
                    <li class="web-menu mr-1">
                      <button type="button" class="btn btn-neutral btn-icon btn-cart" data-toggle="modal" data-target="#modal-form">
                        <span class="btn-inner--icon">
                          <i class="fa fa-bell"></i>
                        </span>
                        <span class="nav-link-inner--text">{{ __('Call Waiter') }}</span>
                      </button>
                    </li>
                  @endif
                  
                  @if(config('settings.enable_guest_log'))
                    <li class="web-menu mr-1">
                      <a  href="{{ route('register.visit',['restaurant_id'=>$restorant->id])}}" class="btn btn-neutral btn-icon btn-cart" style="cursor:pointer;">
                            <span class="btn-inner--icon">
                              <i class="fa fa-calendar-plus-o"></i>
                            </span>
                            <span class="nav-link-inner--text">{{ __('Register visit') }}</span>
                        </a>
                    </li>
                  @endif

                  @if(isset($hasGuestOrders)&&$hasGuestOrders)
                    <li class="web-menu mr-1">
                      <a  href="{{ route('guest.orders')}}" class="btn btn-neutral btn-icon btn-cart" style="cursor:pointer;">
                        <span class="btn-inner--icon">
                          <i class="fa fa-list-alt"></i>
                        </span>
                        <span class="nav-link-inner--text">{{ __('My Orders') }}</span>
                      </a>
                    </li>
                  @endif

                @endif

            @endisset


            @if(\Request::route()->getName() != "newrestaurant.register" && config('app.ordering'))
            <li class="web-menu">

              @if(!in_array(\Request::route()->getName(),["cart.checkout","redirectToWhatsapp"]))
                <a class="btn btn-neutral btn-icon btn-cart" style="cursor:pointer; max-height: 2.6875rem;" data-toggle="modal" data-target="#modal-search-product">
                  <img src="{{ asset('/images/icons/06_search.svg') }}" alt="Pesquisa">
                </a>
                {{-- <a class="btn btn-neutral btn-icon btn-cart" style="cursor:pointer;" data-toggle="modal" data-target="#modal-scheduling">
                  <span class="btn-inner--icon">
                    <i class="ni ni-watch-time"></i>
                  </span>
                  <span class="nav-link-inner--text">Agendar</span>
                </a> --}}
                <a  id="desCartLink" onclick="openNav()" class="btn btn-neutral btn-icon btn-cart" style="cursor:pointer;">
                  <span class="btn-inner--icon">
                    <i class="fa fa-shopping-cart"></i>
                  </span>
                 
                  <span class="nav-link-inner--text">{{ __('Cart') }}</span>
              </a>
              @endif

            </li>
            @endif
            <li class="mobile-menu">

              @yield('addiitional_button_1_mobile')
              @yield('addiitional_button_2_mobile')

              @isset($restorant)
                
                @if(config('app.isqrsaas'))
                  @if(config('settings.enable_call_waiter') && strlen(config('broadcasting.connections.pusher.app_id')) > 2 && strlen(config('broadcasting.connections.pusher.key')) > 2 && strlen(config('broadcasting.connections.pusher.secret')) > 2)
                    <a type="button" class="nav-link" data-toggle="modal" data-target="#modal-form">
                      <span class="btn-inner--icon">
                        <i class="fa fa-bell"></i>
                      </span>
                      <span class="nav-link-inner--text">{{ __('Call Waiter') }}</span>
                    </a>
                  @endif


                  @if(config('settings.enable_guest_log'))
                    <a href="{{ route('register.visit',['restaurant_id'=>$restorant->id])}}" class="nav-link" style="cursor:pointer;">
                        <i class="fa fa-calendar-plus-o"></i>
                        <span class="nav-link-inner--text">{{ __('Register visit') }}</span>
                    </a>
                  @endif

                  @if(isset($hasGuestOrders)&&$hasGuestOrders)

                    <a  href="{{ route('guest.orders')}}" class="nav-link" style="cursor:pointer;">

                        <i class="fa fa-list-alt"></i>

                      <span class="nav-link-inner--text">{{ __('My Orders') }}</span>
                    </a>
                  @endif
                @endif
                @if(!in_array(\Request::route()->getName(),["redirectToWhatsapp"]))
                  @if(\Request::route()->getName() != "newrestaurant.register" && config('app.ordering'))
                  <a class="nav-link" style="cursor:pointer;" data-toggle="modal" data-target="#modal-scheduling">
                    <i class="ni ni-watch-time"></i>
                    <span class="nav-link-inner--text">Agendar</span>
                  </a>
                  <a id="mobileCartLink" onclick="openNav()" class="nav-link" style="cursor:pointer;">
                      <i class="fa fa-shopping-cart"></i>
                      <span class="nav-link-inner--text">{{ __('Cart') }}</span>
                  </a>
                  <!--
                  <a class="btn btn-block btn-neutral btn-icon btn-cart" style="cursor:pointer; max-height: 2.6875rem;" data-toggle="modal" data-target="#modal-search-product">
                    <img src="{{ asset('/images/icons/06_search.svg') }}" alt="Pesquisa" style="margin: auto;">
                  </a> -->
                  @endif
                @endif
              @endisset
            </li>
          
          </ul>
          @isset($restorant)
            <ul class="secundariList">
              <li>
                <strong>Sobre</strong>
                <li>  {{ $restorant->description }}</li>
              </li>
              <li>
                <strong>Contato</strong><br>
                    @if(!empty($openingTime) && !empty($closingTime)) <i class="ni ni-watch-time"></i> <span>{{ $openingTime }}</span> - <span>{{ $closingTime }}</span><br>
                    @endif @if(!empty($restorant->address))<i class="ni ni-pin-3"></i></i> <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($restorant->address) }}">{{ $restorant->address }}</a><br>
                    @endif @if(!empty($restorant->whatsapp_phone)) 
                    <span style="display:flex; "> <svg style="margin-right: 5px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="15" class="svg-inline--fa fa-whatsapp fa-w-14 fa-7x"><path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" class=""></path></svg>  {{$restorant->whatsapp_phone}}</span>     @endif
              </li>
            </ul>
          @endisset
        </div>
      </div>
    </nav>