@extends('layouts.front', ['class' => ''])
@section('content')
  <style>
    .fixed.inset-0.flex.items-end.justify-center.px-4.py-6.pointer-events-none{
      z-index: 99999 !important;
    }
  </style>
    <section class="section-profile-cover section-shaped my--1" style="height: 40vh;">
        <!-- Circles background | (old: config('global.restorant_details_cover_image'))-->
        <img class="bg-image " src="{{ $restorant->coverm }}" style="width: 100%; height: 100%; object-fit: cover;">
        <!-- SVG separator -->
        <div class="separator separator-bottom separator-skew">

        </div>
    </section>
    <section class="section bg-secondary p-0" style="{{ $pixQrCode ? 'height: calc(100vh - 70px);' : 'height: calc(60vh - 70px);' }}">
      <div class="container d-flex justify-content-center">
        <div
          class="card card-profile shadow p-4 pb-5 d-flex flex-column justify-content-center"
          style="
            margin-top: -5vh;
            width: 25rem;
            max-width: calc(100vw - 1rem) !important;
          "
        >
          @if (isset($pixQrCode) && $pixQrCode !== null)
            <p>Seu pedido foi reservado. Pague até as 23:59 de hoje para processarmos seu pedido.</p>
            <img src="data:image/png;base64, {{ $pixQrCode['encodedImage'] }}" alt="">
            <input class="form-control" id="pixCode" type="text" value={{ $pixQrCode['payload'] }} readonly>
            <button class="btn btn-secondary mt-3" id="copyPixCode" onclick="navigator.clipboard.writeText($('#pixCode').val());">Copiar código do pix</button>
          @endif
          @if($toWhatsapp)        
            <a
              href="{{ $toWhatsapp }}"
              class="btn btn-lg btn-icon btn-success mt-4 paymentbutton" 
              style="margin-right: 0 !important"
              target="_blank"
              id="to-whatsapp"
              onclick="$('#go-back-to-store').show('slow');"
            >
              <span class="btn-inner--icon lg"><i class="fa fa-whatsapp" aria-hidden="true"></i></span>
              <span class="btn-inner--text">Enviar pedido do Whatsapp</span>
            </a>
          @endif
          <a href="{{ $goBack }}" class="btn btn-lg btn-secondary mt-2" id="go-back-to-store" style="display: none;">
            <span class="btn-inner--text">
              Retornar para a Loja
            </span>
          </a>
        </div>
      </div>
  </section>
@endsection