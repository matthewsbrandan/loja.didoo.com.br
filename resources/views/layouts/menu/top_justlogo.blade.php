<style>
  @media(min-width:992px){
    .bg-w {
        background: white;
      }
    }
  @media(max-width:991px){
    #navbar_global {
      margin-left: -2%;
      margin-top: -1%;
      padding-bottom:300px;
    }
  }
</style>
<nav id="navbar-main" class="navbar navbar-light navbar-expand-lg  bg-w p-0 fixed-top">
      <div class="container-fluid"> 
        @if(isset($restorant))
          <a 
            class="navbar-brand d-none d-lg-flex align-items-center mr-lg-5 my-1"
            href="/store/{{$restorant->subdomain}}"
          >
            <img src="{{ $restorant->logom }}" class="rounded" style="object-fit: cover;">
            <h5 style="
              font-weight: bold;
              margin: 0 0 0 1rem;
            ">{{ $restorant->name }}</h5>
          </a>
        @else
          <a class="navbar-brand mr-lg-5" href="/">
            <img src="{{ config('global.site_logo') }}">
          </a>
        @endif 

        <span class="navbar-toggler ml-2 mt-1" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">       
          <div class="w-75"></div>
          <div></div>
          <div></div>
        </span>
        
        <span class="navbar-toggler mr-2 mt-1 text-center" type="button" data-toggle="modal" data-target="#modal-search-product">
          <i class="fa fa-search"></i>
        </span>

        <div class="navbar-collapse collapse" id="navbar_global" style="
          overflow-y: auto;
          max-height: calc(100vh + 10%);
        ">
          <div class="navbar-collapse-header" style="border-bottom:solid 1px transparent; padding:0px">
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
                  <a class="btn btn-neutral btn-icon btn-cart d-lg-none" style="cursor:pointer; max-height: 2.6875rem;" data-toggle="modal" data-target="#modal-search-product">
                    <img src="{{ asset('/images/icons/06_search.svg') }}" alt="Pesquisa">
                  </a>
                  <a href="/store/{{$restorant->subdomain}}" class="d-none d-lg-inline-block mr-3 b-bottom">
                    Catálogo
                  </a> 
                  <a href="/store/{{$restorant->subdomain}}/sobre-nos" class="d-none d-lg-inline-block">
                    Sobre nós
                  </a>                  
                  <a href="/login" class="d-none d-lg-inline-block mx-4">
                    Entrar
                  </a>
                  
                  |
                  
                  {{--
                    <a class="btn btn-neutral btn-icon btn-cart" style="cursor:pointer;" data-toggle="modal" data-target="#modal-scheduling">
                      <span class="btn-inner--icon">
                        <i class="ni ni-watch-time"></i>
                      </span>
                      <span class="nav-link-inner--text">Agendar</span>
                    </a>
                  --}}

                  <a  id="desCartLink" onclick="openNav()" style="cursor:pointer;">
                    <span class="btn-inner--icon ml-3">
                      <i class="fa fa-shopping-cart" style="font-size:20px"></i>
                    </span>
                    <span class="bg-primary text-white" style="border-radius:50%; font-size:11px; padding: 2px 5px 2px 5px; position:fixed; top:15px; margin-right:10px">
                        <span id="numCart">0</span>
                    </span>
                  </a>
                @endif
              </li>
            @endif
            <li class="mobile-menu d-none">

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
                    
                    {{--
                      <a class="btn btn-block btn-neutral btn-icon btn-cart" style="cursor:pointer; max-height: 2.6875rem;" data-toggle="modal"   data-target="#modal-search-product">
                        <img src="{{ asset('/images/icons/06_search.svg') }}" alt="Pesquisa" style="margin: auto;">
                      </a>
                    --}}                    
                  @endif
                @endif
              @endisset
            </li>
            <li class="mobile-menu ml-3"> 
              <div class="d-flex flex-column flex-sm-row mb-2">
                <div class="rounded-lg" style="
                  background: #dde;
                  background-image: url('{{ $restorant->logom }}');
                  background-size: cover;
                  padding:30px;
                  height: 12rem;
                  width: 12rem;
                ">
                  <a class="d-none" href="/store/{{$restorant->subdomain}}" style="display: flex; align-items: center;">
                    <img src="{{ $restorant->logom }}" class="w-100"> 
                  </a>
                </div>
                <div class="mt-2 mt-sm-0 ml-sm-3" style="color:black">
                  @if($restorant->name)
                    <h5 class="mb-0" style="font-weight: bold;">{{ $restorant->name }}</h5>
                  @endif
                  @if($restorant->subname){{ $restorant->subname }} @endif
                </div>
              </div>
            </li>   
          </ul>

          @isset($restorant)
            <ul class="secundariList ml-3 mt-3" style="color:black">
              <li>
                <strong>Sobre</strong>
                <li class="mb-2">  {{ $restorant->description }}</li>
              </li>
              <li class="mb-2">
                <strong>E-mail:</strong><br>
                <?php echo \App\User::where(['id' => $restorant->user_id])->first()->email; ?>
              </li>
              <li class="mb-2">
                <strong>Tempo de Entrega:</strong><br>
                @if(!$restorant->tempo)
                  30-60 Min.
                @endif
                @if($restorant->tempo)
                  {{ $restorant->tempo }}
                @endif
              </li>
              <li class="mb-2">
                <strong>Area de atendimento:</strong><br>
                @if(!$restorant->area)
                  Centro, Vieralves, Moema, tatuap�� <br> Costa sul, jardim do lago
                @endif
                @if($restorant->area)
                  {{ $restorant->area }}
                @endif
              </li>
              <li class="mb-3">
                <hr class="mb-2" style="color:black">
                <strong>Loja Fisica:</strong>
                <div class="d-flex align-items-center mb-2 mt-1">
                  <i class="ri-map-pin-line h3"></i>  
                  <strong class="d-block ml-2" style="font-weight: 550;">{{ $restorant->address }}</strong>
                </div>
                <hr class="m-0"  style="color:black">
              </li>
              <li>
                <a href="https://api.whatsapp.com/send?phone={{$restorant->whatsapp_phone}}" class="btn w-100 text-white py-2 mt-4" style="border-radius:30px; background:#34AF23">
                  Enviar WhatsApp
                </a>
                <br><br>
                <div class="d-flex flex-column align-items-center justify-content-center text-center mt-3">
                  <span style="font-size: 12px" class="text-uppercase font-weight-bold">
                    Desenvolvido por:
                  </span>
                  <img
                    src="{{ asset('/uploads/settings/85d2c9e4-ef10-4834-8bd1-36c577b53f56_logo.jpg') }}"
                    class="d-block mt-2" style="width: 10rem;"
                  />
                </div>
              </li>
            </ul>
          @endisset
        </div>
      </div>
    </nav>