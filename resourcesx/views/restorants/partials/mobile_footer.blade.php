@if(isset($canDoOrdering)&&!$canDoOrdering)
<style>
  .content_menu_mobile .item_menu_mobile{
    margin-right: 0;
    display: flex;
    justify-content: center;
    align-items: flex-start;
  }
</style>
@endif
<div class="menu_mobile_footer">
@if(!(isset($canDoOrdering)&&!$canDoOrdering))
  <div onClick="openNav()" id="infoCartCuston" style="display: none;" class="infoCart">
    <div class="infoCartContent">
      <span id="qtd-here"></span>
      <svg  
        xmlns="http://www.w3.org/2000/svg" 
        viewBox="0 0 576 512"
        width="20"
      >
        <path 
          fill="#fff" 
          d="M551.991 64H129.28l-8.329-44.423C118.822 8.226 108.911 0 97.362 0H12C5.373 0 0 5.373 0 12v8c0 6.627 5.373 12 12 12h78.72l69.927 372.946C150.305 416.314 144 431.42 144 448c0 35.346 28.654 64 64 64s64-28.654 64-64a63.681 63.681 0 0 0-8.583-32h145.167a63.681 63.681 0 0 0-8.583 32c0 35.346 28.654 64 64 64 35.346 0 64-28.654 64-64 0-17.993-7.435-34.24-19.388-45.868C506.022 391.891 496.76 384 485.328 384H189.28l-12-64h331.381c11.368 0 21.177-7.976 23.496-19.105l43.331-208C578.592 77.991 567.215 64 551.991 64zM240 448c0 17.645-14.355 32-32 32s-32-14.355-32-32 14.355-32 32-32 32 14.355 32 32zm224 32c-17.645 0-32-14.355-32-32s14.355-32 32-32 32 14.355 32 32-14.355 32-32 32zm38.156-192H171.28l-36-192h406.876l-40 192z"
        >
        </path>
      </svg>
      <span>Ver carrinho</span>

      <span id="price-here"> </span>
      
    </div>

  
  </div>
  @endif

  <div class="content_menu_mobile">
    <div class="item_menu_mobile autor_footer" style="cursor:pointer;">
       <p>FEITO COM</p>
       <span>didoo</span>
       <small>app</small>
    </div>

    <div class="item_menu_mobile">
      <a target="javascript:;" style="cursor: pointer;"  data-toggle="modal" data-target="#modal-search-product">
        <svg  
          xmlns="http://www.w3.org/2000/svg" 
          viewBox="0 0 512 512"
          width="20" 
          >
          <path 
            fill="currentColor" 
            d="M508.5 481.6l-129-129c-2.3-2.3-5.3-3.5-8.5-3.5h-10.3C395 312 416 262.5 416 208 416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c54.5 0 104-21 141.1-55.2V371c0 3.2 1.3 6.2 3.5 8.5l129 129c4.7 4.7 12.3 4.7 17 0l9.9-9.9c4.7-4.7 4.7-12.3 0-17zM208 384c-97.3 0-176-78.7-176-176S110.7 32 208 32s176 78.7 176 176-78.7 176-176 176z" 
            class=""
          >
          </path>
        </svg>
        <small>Buscar</small>
      </a>
    </div>
    @if(!(isset($canDoOrdering)&&!$canDoOrdering))
    {{-- <div class="item_menu_mobile" style="cursor:pointer;" data-toggle="modal" data-target="#modal-scheduling">
      <img src="{{ asset('/images/icons/02_agenda.png') }}" alt="Agenda">
    </div> --}}
    @endif
    <div class="item_menu_mobile" >
      <a 
        @if($restorant->instagram) 
          href="{{$restorant->instagram}}" target="_blank"
        @else
          data-toggle="modal" data-target="#modal-restaurant-info"
        @endif
      >
        <svg  
          xmlns="http://www.w3.org/2000/svg" 
          viewBox="0 0 448 512" 
          class="svg-inline--fa fa-instagram fa-w-14 fa-7x"
          width="20"
        > 
          <path
            fill="currentColor" 
            d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" 
            class=""
          >
          </path>
        </svg>
        <small>Instagram</small>
      </a>    
    </div>
    <div class="item_menu_mobile" style="cursor:pointer;" onClick="document.documentElement.scrollTop = 0;">
      <svg  
        xmlns="http://www.w3.org/2000/svg" 
        viewBox="0 0 576 512" 
        class="svg-inline--fa fa-home fa-w-18 fa-7x"
        width="27"
      >
        <path 
          fill="currentColor" 
          d="M541 229.16l-61-49.83v-77.4a6 6 0 0 0-6-6h-20a6 6 0 0 0-6 6v51.33L308.19 39.14a32.16 32.16 0 0 0-40.38 0L35 229.16a8 8 0 0 0-1.16 11.24l10.1 12.41a8 8 0 0 0 11.2 1.19L96 220.62v243a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-128l64 .3V464a16 16 0 0 0 16 16l128-.33a16 16 0 0 0 16-16V220.62L520.86 254a8 8 0 0 0 11.25-1.16l10.1-12.41a8 8 0 0 0-1.21-11.27zm-93.11 218.59h.1l-96 .3V319.88a16.05 16.05 0 0 0-15.95-16l-96-.27a16 16 0 0 0-16.05 16v128.14H128V194.51L288 63.94l160 130.57z" 
          class=""
        >
        </path>
      </svg>
    <small>Home</small>
    </div>
    @if(!(isset($canDoOrdering)&&!$canDoOrdering))
    <div class="item_menu_mobile containerCart">
      <div onClick="openNav()" class="cartIconCuston">
        <i class="ni ni-cart"></i>
      </div>
    </div>
    @endif
  </div>
  {{-- <div class="autor_footer">
    <a href="https://www.didoo.com.br" target="_blank">
      <span>Feito com: Didoo Catálogo Digital {{'@'.date('Y')}}</span>
    </a>
  </div> --}}
</div>
@include('restorants.partials.modal_search')