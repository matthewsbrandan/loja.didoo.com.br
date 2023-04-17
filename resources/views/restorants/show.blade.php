@extends('layouts.front', ['class' => ''])
@section('head')
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
  />
  <style> .fancybox__container{ z-index: 999999; } </style>
@endsection
@section('content')
@include('restorants.partials.modals')
@include('restorants.partials.modal-taxes')

@php
  $loja = $restorant->id;
  $avaliacoes = DB::select("SELECT * FROM avaliacoes WHERE loja = $loja");
  $reTotal = 0;

  if(count($avaliacoes) > 0){
    foreach($avaliacoes as $v){ $reTotal += $v->estrelas; }
    $reTotal = $reTotal/count($avaliacoes);
  }
	if($restorant){
		$theme = $restorant->getTheme();
	}else{
		$theme = (object)[
			'bg_primary' => '#6B238EFF',
			'text_primary' => '#FFFFFFFF',
			'bg_footer' => '#000000FF',
			'text_primary' => '#FFFFFFFF'
		];
	}
@endphp

<style>
  .active {
    border-bottom:solid 1px white; 
  }
  li {
    margin-right:20px;
  }
  .bg-fixed {
    background: {{ $theme->bg_primary }} !important;
    color: {{ $theme->text_primary }} !important;
  }
  .card-img-top {
    height:280px;
    cursor:pointer;
  }
  .paragrafo{
     display: flex;
     align-items: center; 
  }
  
  .paragrafo hr{
     background: gray;
     flex: 1;
     margin-left: 10px;
     height: 1px;
     border: none; 
  }
  .btn-whatsApps {
    position: fixed;
    right: 20px;
    bottom: 270px;
  }
  @media(max-width:991px){
    .bb-sm {
      /* margin-bottom:60px; */
      margin-bottom: .3rem;
    }
  }
  .stps {
    position: absolute;
    bottom: 75px;
    right: 40px;
    font-size:11px;
    background: {{ $theme->bg_primary }};
    padding: 3px 5px 3px 5px;
    border-radius:50%;
    color: {{ $theme->text_primary }};
  }
   
  ul.scrollmenu { 
    overflow: auto;
    white-space: nowrap;
  }

  ul.scrollmenu > li.items{
    display: inline-block; 
    text-align: center;
    padding: 14px;
    font-weight:bold;
    color:black;
    text-decoration: none;
  }

  ul.scrollmenu > li.items > a.active{
    color: {{ $theme->bg_primary }};
    border-bottom:solid 2px {{ $theme->bg_primary }};
  }
  .sfillx {
    color: #edbf23;
    font-size:18px;
  }
  .slinex {
    color: gray;
    font-size: 18px; 
  }
  .slines {
    color: #edbf23; 
  }

  ::-webkit-scrollbar{
    width: 4px;
    height: 3px;
  }
  ::-webkit-scrollbar-thumb{
    background: #d1d7df;
  }
  ::-webkit-scrollbar-track{
    background: #e2e8f0;
  }
  @media(max-width: 575px){
    #home > .bg-image{
      height: 180px;
      object-fit: cover;
      filter: brightness(0.4);
    }
  }
</style>

<section id="home" class="custon-banner vh-100 section-profile-cover section-shaped d-lg-block d-lx-block bg-secondary">
  <img class="bg-image" src="{{ $restorant->coverm }}" style="width: 100%;">

  <div class="checkIsopen d-none">
    <span style="{{!empty($openingTime) && !empty($closingTime) ? 'background-color: #d9d375 ': 'background-color: red ' }}">
      {{(!empty($openingTime) && !empty($closingTime) ? "Aberto $openingTime - $closingTime": "FECHADO"  )}}
      
    </span>
  </div> 
</section> 
 

<section class="bg-fixed text-white p-2 h5 d-none d-lg-block">
  <div class="container">
    @if(!$restorant->categories->isEmpty())
      <nav class="tabbable sticky" style="top: {{ config('app.isqrsaas') ? 100 : 100 }}px; z-index: 999;">
        <ul class="nav nav-pills" style="
          padding-bottom: .5rem;
          margin-bottom: -.3rem;
        ">
          <li class="nav-item nav-item-category ">
            <a class="mb-sm-3 mb-md-0 text-white active" data-toggle="tab" role="tab" href="">{{ __('Tudo') }}</a>
          </li>
          @foreach ( $restorant->categories as $key => $category)
            @if(!$category->items->isEmpty())
              <li class="nav-item nav-item-category" id="{{ 'cat_'.clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">
                <a
                  style="
                    white-space: nowrap;
                    text-overflow: ellipsis;
                    overflow-x: hidden;
                    max-width: 15rem;
                    display: block;
                  "
                  class="mb-sm-3 mb-md-0 text-white"
                  data-toggle="tab" role="tab"
                  id="{{ 'nav_'.clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}" href="#{{ clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}"
                >{{ $category->name }}</a>
              </li>
            @endif
          @endforeach
        </ul>
      </nav>
    @endif
  </div>
</section>
<!-- COMEÇO DA IMAHGEM -->
<div class="row justify-content-center my-5 w-100 d-none d-sm-flex">
  <img loading="lazy" src="/uploads/settings/logo.png" width="50%">
</div> 
<!-- FIM DA IMAGEM -->

<section class="section pt-lg-0 mb--5 mt--9 d-none">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="title white" <?php
          if($restorant->description || $openingTime && $closingTime) {
            echo 'style="border-bottom: 1px solid #f2f2f2;"';
          }
        ?>>
          {{-- <h1 class="display-3 text-white"
            data-toggle="modal"
            data-target="#modal-restaurant-info"
            style="cursor: pointer;"
          >{{ $restorant->name }}</h1> --}}
          <p class="display-4" style="margin-top: 120px; opacity: 0;">
            {{ $restorant->description }}
          </p>
           
          <p>
            @if(!empty($openingTime) && !empty($closingTime))
              <i class="ni ni-watch-time"></i><span>{{ $openingTime }}</span> - <span>{{ $closingTime }}</span> | 
            @endif 
            @if(!empty($restorant->address))
              <i class="ni ni-pin-3"></i> 
              <a
                target="_blank"
                href="https://www.google.com/maps/search/?api=1&query={{ urlencode($restorant->address) }}"
              >{{ $restorant->address }}</a> | 
            @endif 
            @if(!empty($restorant->phone))
              <i class="ni ni-mobile-button"></i> <a href="tel:{{$restorant->phone}}">{{ $restorant->phone }} </a> 
            @endif
            @if($restorant->has_delivery_tax)
              <span
                class="d-inline-flex align-items-center mx-2"
                onclick="$('#modal-taxes').modal('show');"
                style="cursor: pointer;"
              >
                <i class="ni ni-pin-3"></i> <small class="d-block ml-1" style="font-weight: bold;">VER TAXAS</small>
              </span>
            @endif
          </p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        @include('partials.flash')
      </div>
    </div>
  </div>
</section>

<!-- MOBILE -->

<section class="section section-lg d-md-block d-lg-none d-lx-none p-sm-0" style="padding-bottom: 0px">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        @include('partials.flash')
      </div>
    </div>
    <div class="mt-3">
      <div class="d-flex">
        <div class="shadow bg-secondary mr-3" style="
          border-radius: 50%;
          min-width: 4.5rem;
          height: 4.5rem;
        ">
          <img src="{{ $restorant->logom }}" style="
            border-radius:50%;
            width: 4.5rem;
            height: 4.5rem;
            object-fit: cover;
          "/>
        </div>
        <style>
          #header-mobile-title-and-functions{ flex-direction: column; }
          #header-mobile-title-and-functions .container-functions{ flex-direction: row; gap: .5rem; margin-bottom: .5rem }
          @media(min-width: 360px){
            #header-mobile-title-and-functions{ flex-direction: row; }
            #header-mobile-title-and-functions .container-functions{ flex-direction: column; gap: 0; margin-bottom: 0; }
          }
        </style>
        <div style="flex: 1;" class="d-flex" id="header-mobile-title-and-functions">
          <div style="flex: 1;">
            <style>
              @media (max-width: 359px){
                #menu-mobile-title-restorant{
                  max-width: calc(100vw - 7rem) !important;
                }
              }
            </style>
            <h4 class="m-0 font-weight-bold d-block text-truncate" style="
              color:black;
              line-height: 1.2;
              max-width: calc(100vw - 5rem - 7rem);
            " id="menu-mobile-title-restorant">{{ $restorant->name }}</h4>
            <p class="mb-1" style="
              font-size:12px;
              line-height: 1.4;
              max-width: 12rem;
            "><?php echo mb_strimwidth($restorant->description, 0, 45, "..."); ?></p>
          </div>
          <div class="d-flex flex-wrap container-functions">
            <span class="d-flex align-items-center" style="font-size: .75rem; gap: .2rem;">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 24 24"
                style="fill: currentColor;"
              ><path d="M19.15 8a2 2 0 0 0-1.72-1H15V5a1 1 0 0 0-1-1H4a2 2 0 0 0-2 2v10a2 2 0 0 0 1 1.73 3.49 3.49 0 0 0 7 .27h3.1a3.48 3.48 0 0 0 6.9 0 2 2 0 0 0 2-2v-3a1.07 1.07 0 0 0-.14-.52zM15 9h2.43l1.8 3H15zM6.5 19A1.5 1.5 0 1 1 8 17.5 1.5 1.5 0 0 1 6.5 19zm10 0a1.5 1.5 0 1 1 1.5-1.5 1.5 1.5 0 0 1-1.5 1.5z"></path></svg>
              <span>Delivery</span>
            </span>
            <span class="d-flex align-items-center" style="font-size: .75rem; gap: .2rem;">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 24 24"
                style="fill: currentColor;"
              ><path d="M19.148 2.971A2.008 2.008 0 0 0 17.434 2H6.566c-.698 0-1.355.372-1.714.971L2.143 7.485A.995.995 0 0 0 2 8a3.97 3.97 0 0 0 1 2.618V19c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-8.382A3.97 3.97 0 0 0 22 8a.995.995 0 0 0-.143-.515l-2.709-4.514zm.836 5.28A2.003 2.003 0 0 1 18 10c-1.103 0-2-.897-2-2 0-.068-.025-.128-.039-.192l.02-.004L15.22 4h2.214l2.55 4.251zM10.819 4h2.361l.813 4.065C13.958 9.137 13.08 10 12 10s-1.958-.863-1.993-1.935L10.819 4zM6.566 4H8.78l-.76 3.804.02.004C8.025 7.872 8 7.932 8 8c0 1.103-.897 2-2 2a2.003 2.003 0 0 1-1.984-1.749L6.566 4zM10 19v-3h4v3h-4zm6 0v-3c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v3H5v-7.142c.321.083.652.142 1 .142a3.99 3.99 0 0 0 3-1.357c.733.832 1.807 1.357 3 1.357s2.267-.525 3-1.357A3.99 3.99 0 0 0 18 12c.348 0 .679-.059 1-.142V19h-3z"></path></svg>
              Retirada
            </span>
            <span class="d-flex align-items-center" style="font-size: .75rem; gap: .2rem;">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 24 24"
                style="fill: currentColor;"
              ><path d="M7 11h2v2H7zm0 4h2v2H7zm4-4h2v2h-2zm0 4h2v2h-2zm4-4h2v2h-2zm0 4h2v2h-2z"></path><path d="M5 22h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zM19 8l.001 12H5V8h14z"></path></svg>
              Agendar
            </span>
          </div>
        </div>
      </div>
      <div class="text-center">
        <span
          class="text-uppercase font-weight-bold text-white"
          style="{{
            !empty($openingTime) && !empty($closingTime) ? 'background-color: #009900 ': 'background-color: #dc1c39 ' }};
            border-radius:20px;
            font-size: .75rem;
            padding: .25rem 2rem;
          "
        >{{(!empty($openingTime) && !empty($closingTime) ? "Aberto": "Fechado"  )}}</span>
      </div>
    </div> 
    <div class="row d-none">
      <div class="col-lg-12">
        <br>
        <div class="title">
          {{-- <h1 class="display-3 text" data-toggle="modal" data-target="#modal-restaurant-info" style="cursor: pointer;">{{ $restorant->name }}</h1> --}}
          {{-- <p class="display-5 text">{{ $restorant->description }}</p> --}}
          <p>@if(!empty($openingTime) && !empty($closingTime)) <i class="ni ni-watch-time"></i> <span>{{ $openingTime }}</span> - <span>{{ $closingTime }}</span> | @endif @if(!empty($restorant->address))<i class="ni ni-pin-3"></i></i> <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($restorant->address) }}">{{ $restorant->address }}</a> | @endif @if(!empty($restorant->phone)) <i class="ni ni-mobile-button"></i> <a href="tel:{{$restorant->phone}}">{{ $restorant->phone }} </a> @endif</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid"> 
  @if(!$restorant->categories->isEmpty())
    <nav class="tabbable sticky" style="top: {{ config('app.isqrsaas') ? 100 : 100 }}px; z-index: 999;">
      <ul class="nav nav-pills scrollmenu">
        <li class="nav-item nav-item-category items">
          <a class="mb-sm-3 mb-md-0 active text-sm" data-toggle="tab" role="tab" href="">{{ __('Tudo') }}</a>
        </li>
        @foreach ( $restorant->categories as $key => $category)
        @if(!$category->items->isEmpty())
        <li class="nav-item nav-item-category items" id="{{ 'cat_'.clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">
          <a class="mb-sm-3 mb-md-0 text-sm" data-toggle="tab" role="tab" id="{{ 'nav_'.clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}" href="#{{ clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">{{ $category->name }}</a>
        </li>
        @endif
        @endforeach
      </ul>
    </nav>
  @endif
  </div>
</section> 

<section class="section pt-lg-0 pb-0 pb-lg-6" id="restaurant-content" style="
  padding-top: 0px;
  max-width: 1300px;
  margin: auto;
">
  <input type="hidden" id="rid" value="{{ $restorant->id }}" />
  <div class="container-fluid container-restorant">
    @if(!$restorant->categories->isEmpty())
      @foreach ( $restorant->categories as $key => $category)
        @if(!$category->aitems->isEmpty())
          <div id="{{ clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}" class="{{ clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">      
            <div class="paragrafo">
              <h4 class="font-weight-bold mb-1" style="color:gray">{{ $category->name }}</h4> <hr>
            </div>
          </div>
        @endif
        <div class="row  {{ clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">
          @foreach ($category->aitems as $item)
            <div class="col-xl-3 col-sm-4 col-6 handle-search-product px-1" data-title="{{ $item->name }}" id="product-{{ $item->id }}">
              <div class="card mb-4 box-shadow" onClick="setCurrentItem({{ $item->id }})">
                @if(!empty($item->image))
                  <div class="card-img-top" style="
                    background-image:url({{ $item->logom }});
                    background-size: cover;
                    background-position: center;
                  "></div>
                @endif
                @if(empty($item->image))
                  <img
                    class="card-img-top"
                    src="https://via.placeholder.com/150x150"
                    style="object-fit: cover; object-position: center;"
                  />
                @endif
                <div class="card-body text-center px-2 px-md-4 d-flex flex-column justify-content-between" style="min-height: 14rem;">
                  <div>
                    <h6 class="card-title font-weight-bold mb-1 text-sm overflow-hidden" style="max-height: 2.6rem;">
                      <b><a onClick="setCurrentItem({{ $item->id }})" href="javascript:void(0)">{{ $item->name }}</a></b>
                    </h6>
                    <p class="card-text text-sm overflow-hidden" style="max-height: 2.6rem; line-height: 1.4;">{{ $item->short_description}}</p>
                  </div>
                  <div>
                    <p class="card-text h5 font-weight-bold mb-2">
                      @money($item->price, config('settings.cashier_currency'),config('settings.do_convertion'))
                    </p> 
                    <a
                      onClick="setCurrentItem({{ $item->id }})"
                      href="javascript:void(0)"
                      class="btn btn-sm px-4 px-md-5 py-2 bg-fixed text-white"
                      style="border-radius:40px; max-width: 100%;"
                    >Comprar</a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endforeach
    @else
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
          <p class="text-muted mb-0">{{ __('Hmmm... Nothing found!')}}</p>
          <br /><br /><br />
          <div class="text-center" style="opacity: 0.2;">
            <img src="https://www.jing.fm/clipimg/full/256-2560623_juice-clipart-pizza-box-pizza-box.png" width="200" height="200"></img>
          </div>
        </div>
      </div>
    @endif
  </div>
  @if(!empty($restorant->whatsapp_phone))
    <a href="https://api.whatsapp.com/send?phone={{$restorant->whatsapp_phone}}"
    target="_blank" class="btn-whatsApp bb-sm">
      <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="">
    </a> 
  @endif
  @if(!(isset($canDoOrdering)&&!$canDoOrdering))
    <div
      onClick="openNav()"
      class="
        callOutShoppingButtonBottom icon icon-shape bg-gradient-red text-white rounded-circle shadow mb-4
        d-none d-sm-block d-lg-none
      "
      style="
        position: fixed;
        bottom: .8rem;
        right: 17px;
        width: 2.9rem;
        height: 2.9rem;
      "
    >
      <i class="fa fa-shopping-cart"></i>
    </div>
  @endif
  
  @include('restorants.partials.mobile_footer')

</section>



<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary shadow border-0">
          <div class="card-header bg-transparent pb-2">
            <h4 class="text-center mt-2 mb-3">{{ __('Call Waiter') }}</h4>
          </div>
          <div class="card-body px-lg-5 py-lg-5">
            <form role="form" method="post" action="{{ route('call.waiter') }}">
              @csrf
              @include('partials.fields',$fields)
              <div class="text-center">
                <button type="submit" class="btn btn-primary my-4">{{ __('Call Now') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-forms" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary shadow border-0">
          <div class="card-header bg-transparent pb-2">
            <h4 class="text-center mt-2 mb-3">{{ __('SIGA-NOS') }}</h4>
          </div>
          <div class="card-body px-lg-5 py-lg-5">
            @if(!empty($restorant->facebook))
            <p>
              <a href="{{ $restorant->facebook }}" target="_blank"><i class="fa fa-facebook-f mr-2"></i> Facebook </a>
            </p>
            @endif
            @if(!empty($restorant->instagram))
            <p>
              <a href="{{ $restorant->instagram}}" target="_blank"><i class="fa fa-instagram mr-2"></i> Instagram </a>
            </p>
            @endif
            @if(!empty($restorant->youtube))
            <p>
              <a href="{{ $restorant->youtube }}" target="_blank"><i class="fa fa-youtube mr-2"></i> YouTube </a>
            </p>
            @endif
            @if(!empty($restorant->tiktok))
            <p>
              <a href="{{ $restorant->tiktok }}" target="_blank"><i class="ri-global-line mr-2"></i> TikTok </a>
            </p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="avaliar" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary shadow border-0">
          <div class="card-header bg-transparent pb-2">
            <h4 class="text-center mt-2 mb-3">{{ __('Fazer uma avaliação') }}</h4>
          </div>
          <div class="card-body px-lg-5 py-lg-5">
            <form method="POST" action="{{ route('newrestaurant.store') }}"  autocomplete="off">              
              @csrf
              <?php if (Auth::check()) {  $user = Auth::user(); ?>                           
                <input name="nome" type="hidden" class="form-control mb-2" value="<?= $user->name; ?>" required>
                <input name="email" type="hidden" class="form-control mb-2" value="<?= $user->email; ?>" required>
              <?php } else { ?>
                <input name="nome" type="text" class="form-control mb-2" placeholder="Digite seu nome" required>
                <input name="email" type="email" class="form-control mb-2" placeholder="Digite seu e-mail" required>
              <?php } ?>
              
              <textarea name="comentario" class="form-control mb-2" placeholder="Escreva um comentário..." required=""></textarea>              
              <input name="update"  type="hidden" value="{{ $restorant->id }}"> 
              
              <div class="mb-2">
                <?php if (Auth::check()) { ?>
                <div>
                  <input name="estrela" class="d-none" id="d1" value="1" type="radio" required="">
                  <label id="dd1" for="d1" onclick="estrelas(1)">
                    <span id="dd1">
                      <i class="ri-star-line sfillx"></i>
                      <i class="ri-star-line slinex"></i>
                      <i class="ri-star-line slinex"></i>
                      <i class="ri-star-line slinex"></i>
                      <i class="ri-star-line slinex"></i>
                    </span>
                  </label>  
                </div>
                <div>
                  <input name="estrela" class="d-none" id="d2" value="2" type="radio" required="">
                  <label id="dd2" for="d2" onclick="estrelas(2)">
                    <span id="dd2"> 
                      <i class="ri-star-line sfillx"></i>
                      <i class="ri-star-line sfillx"></i>
                      <i class="ri-star-line slinex"></i>
                      <i class="ri-star-line slinex"></i>
                      <i class="ri-star-line slinex"></i>
                    </span>
                  </label>  
                </div>
                
                
                <div>
                  <input name="estrela" class="d-none" id="d3" value="3" type="radio" required="">
                  <label for="d3" onclick="estrelas(3)">
                    <span id="dd3">
                      <i class="ri-star-line sfillx"></i>
                      <i class="ri-star-line sfillx"></i>
                      <i class="ri-star-line sfillx"></i>
                      <i class="ri-star-line slinex"></i>
                      <i class="ri-star-line slinex"></i>
                    </span>
                  </label>  
                </div>
                <?php } ?> 
                <div>
                  <input name="estrela" class="d-none"  id="d4" value="4" type="radio" required="">
                  <label for="d4" onclick="estrelas(4)">
                    <span id="dd4">
                      <i class="ri-star-line sfillx"></i>
                      <i class="ri-star-line sfillx"></i>
                      <i class="ri-star-line sfillx"></i>
                      <i class="ri-star-line sfillx"></i> 
                      <i class="ri-star-line slinex"></i>
                    </span>
                  </label>  
                </div>
                <div>
                  <input name="estrela" class="d-none" id="d5" value="5" type="radio" required="">
                  <label for="d5" onclick="estrelas(5)">
                    <span id="dd5">
                      <i class="ri-star-line sfillx"></i>
                      <i class="ri-star-line sfillx"></i>
                      <i class="ri-star-line sfillx"></i>
                      <i class="ri-star-line sfillx"></i>
                      <i class="ri-star-line sfillx"></i>
                    </span>
                  </label>  
                </div> 
              </div>
              
              <center> 
                <input type="submit" value="Avaliar" class="btn bg-primary mt-3 text-white">
              </center>
              
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@if ($showLanguagesSelector)
@section('addiitional_button_1')
<div class="dropdown web-menu">
  <a href="#" class="btn btn-neutral dropdown-toggle " data-toggle="dropdown" id="navbarDropdownMenuLink2">
    <!--<img src="{{ asset('images') }}/icons/flags/{{ strtoupper(config('app.locale'))}}.png" /> --> {{ $currentLanguage }}
  </a>
  <ul class="dropdown-menu" aria-labelledby="">
    @foreach ($restorant->localmenus()->get() as $language)
    @if ($language->language!=config('app.locale'))
    <li>
      <a class="dropdown-item" href="?lang={{ $language->language }}">
        <!-- <img src="{{ asset('images') }}/icons/flags/{{ strtoupper($language->language)}}.png" /> --> {{$language->languageName}}
      </a>
    </li>
    @endif
    @endforeach
  </ul>
</div>
@endsection
@section('addiitional_button_1_mobile')
<div class="dropdown mobile_menu">

  <a type="button" class="nav-link  dropdown-toggle" data-toggle="dropdown" id="navbarDropdownMenuLink2">
    <span class="btn-inner--icon">
      <i class="fa fa-globe"></i>
    </span>
    <span class="nav-link-inner--text">{{ $currentLanguage }}</span>
  </a>
  <ul class="dropdown-menu" aria-labelledby="">
    @foreach ($restorant->localmenus()->get() as $language)
    @if ($language->language!=config('app.locale'))
    <li>
      <a class="dropdown-item" href="?lang={{ $language->language }}">
        <!-- <img src="{{ asset('images') }}/icons/flags/{{ strtoupper($language->language)}}.png" /> ---> {{$language->languageName}}
      </a>
    </li>
    @endif
    @endforeach
  </ul>
</div>
@endsection
@endif
@section('js')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
@include('restorants.partials.cookies')
<script>
  "use strict";
  var items = [];
  var currentItem = null;
  var currentItemSelectedPrice = null;
  var lastAdded = null;
  var previouslySelected = [];
  var extrasSelected = [];
  var variantID = null;
  var CASHIER_CURRENCY = "<?php echo  config('settings.cashier_currency') ?>";
  var LOCALE = "<?php echo  App::getLocale() ?>";
  var debug = true;

  function debugMe(title, message) {
    if (debug) {
      console.log("#" + title);
      console.log(message);
      console.log("--------");
    }
  }

  /*
   * Price formater
   * @param {Nummber} price
   */
   
  function estrelas(d1){
    
    var ds1 = '<i class="ri-star-line sfillx"></i> <i class="ri-star-line slinex"></i> <i class="ri-star-line slinex"></i> <i class="ri-star-line slinex"></i> <i class="ri-star-line slinex"></i>';
    var ds2 = '<i class="ri-star-line sfillx"></i> <i class="ri-star-line sfillx"></i> <i class="ri-star-line slinex"></i> <i class="ri-star-line slinex"></i> <i class="ri-star-line slinex"></i>';
    var ds3 = '<i class="ri-star-line sfillx"></i> <i class="ri-star-line sfillx"></i> <i class="ri-star-line sfillx"></i> <i class="ri-star-line slinex"></i> <i class="ri-star-line slinex"></i>';
    var ds4 = '<i class="ri-star-line sfillx"></i> <i class="ri-star-line sfillx"></i> <i class="ri-star-line sfillx"></i> <i class="ri-star-line sfillx"></i> <i class="ri-star-line slinex"></i>';
    var ds5 = '<i class="ri-star-line sfillx"></i> <i class="ri-star-line sfillx"></i> <i class="ri-star-line sfillx"></i> <i class="ri-star-line sfillx"></i> <i class="ri-star-line sfillx"></i>';
    
    $("#dd1").html(ds1);
    $("#dd2").html(ds2);
    $("#dd3").html(ds3);
    $("#dd4").html(ds4);
    $("#dd5").html(ds5);
    
    if(d1 == 1){
      var ds = '<i class="ri-star-fill sfillx"></i> <i class="ri-star-line sfillx"></i> <i class="ri-star-line sfillx"></i> <i class="ri-star-line sfillx"></i> <i class="ri-star-line sfillx"></i>';
    }
    if(d1 == 2){
      var ds = '<i class="ri-star-fill sfillx"></i> <i class="ri-star-fill sfillx"></i> <i class="ri-star-line sfillx"></i> <i class="ri-star-line sfillx"></i> <i class="ri-star-line sfillx"></i>';
    }
    if(d1 == 3){
      var ds = '<i class="ri-star-fill sfillx"></i> <i class="ri-star-fill sfillx"></i> <i class="ri-star-fill sfillx"></i> <i class="ri-star-line sfillx"></i> <i class="ri-star-line sfillx"></i>';
    }
    if(d1 == 4){
      var ds = '<i class="ri-star-fill sfillx"></i> <i class="ri-star-fill sfillx"></i> <i class="ri-star-fill sfillx"></i> <i class="ri-star-fill sfillx"></i> <i class="ri-star-line sfillx"></i>';
    }
    if(d1 == 5){
      var ds = '<i class="ri-star-fill sfillx"></i> <i class="ri-star-fill sfillx"></i> <i class="ri-star-fill sfillx"></i> <i class="ri-star-fill sfillx"></i> <i class="ri-star-fill sfillx"></i>';
    }
     
    $("#dd" + d1).html(ds);
     
      
  }
  
  function formatPrice(price) {
    var locale = LOCALE;
    if (CASHIER_CURRENCY.toUpperCase() == "USD") {
      locale = locale + "-US";
    }

    var formatter = new Intl.NumberFormat(locale, {
      style: 'currency',
      currency: CASHIER_CURRENCY,
    });

    var formated = formatter.format(price);

    return formated;
  }

  /**
   * Load extras for variant
   * @param {Number} variant_id the variant id
   * */
  function loadExtras(variant_id) {
    //alert("Load extras for "+variant_id);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type: 'GET',
      url: '/items/variants/' + variant_id + '/extras',
      success: function(response) {
        if (response.status) {
          response.data.forEach(element => {
            $('#exrtas-area-inside').append('<div class="custom-control custom-checkbox mb-3"><input onclick="recalculatePrice(' + element.item_id + ');" class="custom-control-input" id="' + element.id + '" name="extra"  value="' + element.price + '" type="checkbox"><label class="custom-control-label" for="' + element.id + '">' + element.name + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+' + formatPrice(element.price) + '</label></div>');
          });
          $('#exrtas-area').show();

        }
      },
      error: function(response) {
        //return callback(false, response.responseJSON.errMsg);
      }
    })
  }




  /**
   *
   * Set the selected variant, set price and shows qty area and calls load extras
   * */
  function setSelectedVariant(element) {

    //console.log(formated);
    $('#modalPrice').html(formatPrice(element.price));

    //Set current item price
    currentItemSelectedPrice = element.price;

    //Show QTY
    $('.quantity-area').show();

    //Set variantID
    variantID = element.id;

    //Empty the extras, and call it
    $('#exrtas-area-inside').empty();
    loadExtras(variantID);

  }

  function getTheDataForTheFoundVariable() {
    console.log(previouslySelected);
    var comparableObject = {};
    previouslySelected.forEach(element => {
      comparableObject[element.option_id] = element.name.trim().toLowerCase().replace(/\s/g, "-");
    });
    comparableObject = JSON.stringify(comparableObject)
    //console.log("Comparable");
    //console.log(comparableObject);
    currentItem['variants'].forEach(element => {
      //console.log("Compare to");
      //console.log(JSON.stringify(JSON.parse(element.options)));
      if (comparableObject == JSON.stringify(JSON.parse(element.options))) {
        //console.log("This are the options");
        //console.log(element.options);
        //console.log(element.optionsiconv);
        setSelectedVariant(element);
      }
    });

  }


  function checkIfVariableExists(forOption, optionValue) {

    var newElement = {
      "option_id": forOption,
      "name": optionValue
    };
    //console.log('NEW ELEMNGT');
    //console.log(newElement);

    var possibleSelection = JSON.parse(JSON.stringify(previouslySelected));
    possibleSelection.push(newElement);
    //console.log(possibleSelection);

    var filteredObjects = [];
    //possibleSelection.forEach(element => {
    currentItem.variants.forEach(theVariant => {
      var theOptions = JSON.parse(theVariant.optionsiconv ? theVariant.optionsiconv : theVariant.options);
      var ok = true;
      Object.keys(theOptions).map((key) => {

        //console.log(key+" : "+theOptions[key])
        possibleSelection.forEach(element => {
          if (key == element.option_id) {
            if (theOptions[key] + "" != element.name.trim().toLowerCase().replace(/\s/g, "-") + "") {
              ok = false;
            }
          }
        });

      })

      if (ok) {
        filteredObjects.push(theVariant);
        //console.log("ok")
      } else {
        //console.log("not ok")
      }

      //comparableObject[element.option_id]=element.name.trim().toLowerCase().replace(/\s/g , "-");
    });

    //});


    return filteredObjects.length > 0;

  }

  function appendOption(name, id) {
    lastAdded = id;
    $('#variants-area-inside').append(`
      <div id="variants-area-${id}">
        <br />
        <label class="form-control-label font-weight-bold" style="color: #32325d;">${name}</label>
        <div>
          <div
            id="variants-area-inside-${id}"
            class="btn-group btn-group-toggle"
            data-toggle="buttons"
            style="flex-wrap: wrap; gap: .4rem;"
          ></div>
        </div>
      </div>
    `);
  }

  function optionChanged(option_id, name) {

    var newElement = {
      "option_id": option_id,
      "name": name
    };
    debugMe("selected option", JSON.stringify(newElement));


    //Append / insert the new selectioin
    var newSelectionState = [];
    var userClickedOnAlreadySelectedOption = false;
    previouslySelected.forEach(element => {

      if (userClickedOnAlreadySelectedOption) {
        $("#variants-area-" + element.option_id).remove();
      }

      if (element.option_id != newElement.option_id) {
        //If we haven't yet found the item add this in the selection
        if (!userClickedOnAlreadySelectedOption) {
          newSelectionState.push(element);
        }
      } else {
        userClickedOnAlreadySelectedOption = true;
      }


    });



    if (userClickedOnAlreadySelectedOption && lastAdded != newElement.option_id) {
      //remove also last inserted, and readded it
      $("#variants-area-" + lastAdded).remove();
    }

    newSelectionState.push(newElement);
    previouslySelected = newSelectionState;
    debugMe("Selection", JSON.stringify(previouslySelected));
    setVariants();


  }

  function appendOptionValue(name, value, enabled, option_id) {
    $('#variants-area-inside-' + option_id).append('<label style="opacity: ' + (enabled ? 1 : 0.5) + '" class="btn btn-outline-primary"><input  onchange="optionChanged(' + option_id + ',\'' + value + '\')"  ' + (enabled ? "" : "disabled") + ' type="radio" name="option_' + option_id + '" value="option_' + option_id + "_" + name + '" autocomplete="off" />' + name + '</label>')
  }

  function setVariants() {
    //1. Determine previously selected variants
    // var previouslySelected=[];

    //HIDE QTY
    //$('.quantity-area').hide();
    $('#exrtas-area-inside').empty();
    $('#exrtas-area').hide();

    //2. Get the new option to show
    var newOptionToShow = null;
    debugMe("previouslySelected length", previouslySelected.length);
    newOptionToShow = currentItem.options[previouslySelected.length];
    debugMe("newOptionToShow", JSON.stringify(newOptionToShow));

    if (newOptionToShow != undefined) {
      //2.1 Add the options in the table
      appendOption(newOptionToShow.name, newOptionToShow.id);


      var values = (newOptionToShow.optionsiconv ? newOptionToShow.optionsiconv : newOptionToShow.options).split(",");
      var titles = (newOptionToShow.options).split(",");

      for (let index = 0; index < values.length; index++) {
        const theValue = values[index];
        const theTitle = titles[index];

        if (checkIfVariableExists(newOptionToShow.id, theValue)) {
          //Next variable exists
          //console.log("Exists: "+theValue);
          appendOptionValue(theTitle, theValue, true, newOptionToShow.id);
        } else {
          //Varaiable with the next option value doens't exists
          //console.log("Does not exists: "+theValue);
          appendOptionValue(theTitle, theValue, false, newOptionToShow.id);
        }

      }

    } else {
      console.log("No more options");
      getTheDataForTheFoundVariable();
    }




    //3. Add the new option options
    //3.1 If new option is null, show the variant price
  }


  function setCurrentItem(id) {
    clearDot();
    var item = items[id];
    currentItem = item;
    previouslySelected = [];
    $('#modalTitle').text(item.name);
    $('#modalName').text(item.name);
    $('#modalPrice').html(item.price);
    $('#modalID').text(item.id);
    
    if (item.image != "/default/restaurant_large.jpg") {
      $("#modalImg").attr("src", item.image).parent().attr('data-src', item.image);
      $("#modalDialogItem").addClass("modal-lg");
      $("#modalImgPart").show();

      $("#modalItemDetailsPart").removeClass("col-sm-6 col-md-6 col-lg-6 offset-3");
      $("#modalItemDetailsPart").addClass("col-sm col-md col-lg");
    } else {
      $("#modalImgPart").hide();
      $("#modalItemDetailsPart").removeClass("col-sm col-md col-lg");
      $("#modalItemDetailsPart").addClass("col-sm-6 col-md-6 col-lg-6 offset-3");
      $("#modalDialogItem").removeClass("modal-lg");
      $("#modalDialogItem").addClass("col-sm-6 col-md-6 col-lg-6 offset-3");
    }
    $('.image_variations').remove();
    if(item.image_variations != null){
      
      item.image_variations.forEach(image => { 
        $('#containerImg').append(`
          <a data-src="${image}" data-fancybox="modal-gallery">
            <img class="item_img image_variations" src="${image}" alt="">
          </a>
        `);
        
      });
      
    }
    
    try{
      $('#modalImg, #containerImg [data-fancybox]').on('click',() => {Fancybox.bind('[data-fancybox="modal-gallery"]', { })});
      // Start Fancybox on page load
      // Fancybox.fromNodes(Array.from(document.querySelectorAll('[data-fancybox="modal-gallery"]')));
    }catch(e){
      console.error(e);
    }

    $('#modalDescription').html(item.description);


    if (item.has_variants) {
      //Vith variants
      //Hide the counter, and extrasts
      $('.quantity-area').hide();

      //Now show the variants options
      $('#variants-area-inside').empty();
      $('#variants-area').show();
      setVariants();
      //$('#modalPrice').html("dynamic");
    } else {
      //Normal
      currentItemSelectedPrice = item.priceNotFormated;
      $('#variants-area').hide();
      $('.quantity-area').show();
    }


    $('#productModal').modal('show');
    if(item.image_variations && item.image_variations.length > 0){
      setTimeout(() => {
        loadSlider(item.image_variations.length + 1, containerImag.clientWidth)
      }, 1000);
    }

     
    extrasSelected = [];

    variantID = null;

    //Now set the extrast
    if (item.extras.length == 0 || item.has_variants) {
      console.log('has no extras');
      $('#exrtas-area-inside').empty();
      $('#exrtas-area').hide();
      
    } else {
      console.log('has extras');
      $('#exrtas-area-inside').empty();
      item.extras.forEach(element => {
        console.log(element);
        $('#exrtas-area-inside').append('<div class="custom-control custom-checkbox mb-3"><input onclick="recalculatePrice(' + id + ');" class="custom-control-input" id="' + element.id + '" name="extra"  value="' + element.price + '" type="checkbox"><label class="custom-control-label" for="' + element.id + '">' + element.name + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+' + element.priceFormated + '</label></div>');
      });
      $('#exrtas-area').show();
    }
  }
  

  function recalculatePrice(id, value) {
    //console.log("Triger price recalculation: "+id);
    // console.log(items[id]);
    var mainPrice = parseFloat(currentItemSelectedPrice);
    extrasSelected = [];

    //Get the selected check boxes
    $.each($("input[name='extra']:checked"), function() {
      mainPrice += parseFloat(($(this).val() + ""));
      extrasSelected.push($(this).attr('id'));
    });
    $('#modalPrice').html(formatPrice(mainPrice));

  }
  <?php
    function clean($string)
    {
      $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

      return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    $items = [];
    $categories = [];
    foreach ($restorant->categories as $key => $category) {

      array_push($categories, clean(str_replace(' ', '', strtolower($category->name)) . strval($key)));

      foreach ($category->items as $key => $item) {

        $formatedExtras = $item->extras;

        foreach ($formatedExtras as &$element) {
          $element->priceFormated = @money($element->price, config('settings.cashier_currency'), config('settings.do_convertion')) . "";
        }

        //Now add the variants and optins to the item data
        $itemOptions = $item->options;

        $theArray = [
          'name' => $item->name,
          'id' => $item->id,
          'priceNotFormated' => $item->price,
          'price' => @money($item->price, config('settings.cashier_currency'), config('settings.do_convertion')) . "",
          'image' => $item->logom,
          'image_variations' => $item->getImageVariations(),
          'extras' => $formatedExtras,
          'options' => $item->options,
          'variants' => $item->variants,
          'has_variants' => $item->has_variants == 1 && $item->options->count() > 0,
          'description' => $item->description
        ];
        echo "items[" . $item->id . "]=" . json_encode($theArray) . ";";
      }
    }
  ?>
</script>
<script type="text/javascript">
  $(function(){
    @if(session()->has('fixed-temp-message'))
    @php $fixedTempMessageId = bin2hex(random_bytes(16)); @endphp
    $('body').append(`
      <div
        class="alert alert-success alert-dismissible fade show pr-5"
        id="fixed-temp-message-{{ $fixedTempMessageId }}"
        role="alert"
        style="
          position: fixed;
          top: 4rem;
          right: 0;
        "
      >
        {{ session()->get('fixed-temp-message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    `);
    setTimeout(() => {
      $('#fixed-temp-message-{{ $fixedTempMessageId }}').remove();
    },5000);
    @endif
  });



  function getLocation(callback) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type: 'GET',
      url: '/get/rlocation/' + $('#rid').val(),
      success: function(response) {
        if (response.status) {
          return callback(true, response.data)
        }
      },
      error: function(response) {
        return callback(false, response.responseJSON.errMsg);
      }
    })
  }

  function initializeMap(lat, lng) {
    var map_options = {
      zoom: 13,
      center: new google.maps.LatLng(lat, lng),
      mapTypeId: "terrain",
      scaleControl: true
    }

    map_location = new google.maps.Map(document.getElementById("map3"), map_options);
  }

  function initializeMarker(lat, lng) {
    var markerData = new google.maps.LatLng(lat, lng);
    marker = new google.maps.Marker({
      position: markerData,
      map: map_location,
      icon: start
    });
  }

  var start = "https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/48/Map-Marker-Ball-Pink.png"
  var area = "https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/48/Map-Marker-Ball-Chartreuse.png"
  var map_location = null;
  var map_area = null;
  var marker = null;
  var infoWindow = null;
  var lat = null;
  var lng = null;
  var circle = null;
  var isClosed = false;
  var poly = null;
  var markers = [];
  var markerArea = null;
  var markerIndex = null;
  var path = null;

  var categories = <?php echo json_encode($categories); ?>;

  window.onload ? window.onload() : null;

  window.onload = function() {
    //var map, infoWindow, marker, lng, lat;

    getLocation(function(isFetched, currPost) {
      if (isFetched) {


        if (currPost.lat != 0 && currPost.lng != 0) {
          //initialize map
          initializeMap(currPost.lat, currPost.lng)

          //initialize marker
          initializeMarker(currPost.lat, currPost.lng)

          //var isClosed = false;
        }
      }
    });

  }


  $(".nav-item-category").on('click', function() {
    $.each(categories, function(index, value) {
      $("." + value).show();

      //$("#nav_"+value).removeClass("active");
    });

    var id = $(this).attr("id");
    var category_id = id.substr(id.indexOf("_") + 1, id.length);
    //$("#nav_"+category_id).addClass("active");

    //$("."+category_id).hide();

    $.each(categories, function(index, value) {
      if (value != category_id) {
        $("." + value).hide();
      }
    });
  });
</script>
@endsection