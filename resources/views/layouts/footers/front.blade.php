<div class="d-none d-sm-block">
    @isset($restorant)
        @php $theme = $restorant->getTheme(); @endphp
        <div class="container-fluid d-flex flex-col flex-md-row py-4" style="
            background: {{ $theme->bg_footer }};
            color: {{  $theme->text_footer }};
        ">
            <div class="col-4">
                <img src="{{ $restorant->logom }}" class="rounded" />
                <h3>{{ $restorant->name }}</h3>
                <p >
                    {{ $restorant->description }}
                </p>
            </div>
            <div class="col-4">
                <p>Horário de atendimento</p>
                <p><i class="ri-time-line"></i> {{(!empty($openingTime) && !empty($closingTime) ? "$openingTime - $closingTime": "FECHADO" )}}</p>


                @if($restorant)
                    <div class="d-flex align-items-center" style="gap: .2rem;">
                        @if($restorant->facebook)
                            <a
                                class="nav-link nav-link-icon"
                                href="{{ $restorant->facebook }}"
                                target="_blank"
                                data-toggle="tooltip" title="Curta nossa página no facebook"
                            >
                                <i class="fa fa-facebook-square"></i>
                            </a>
                        @endif
                        @if($restorant->instagram)
                            <a
                                class="nav-link nav-link-icon"
                                href="{{ config('global.instagram') }}"
                                target="_blank"
                                data-toggle="tooltip"
                                title="Nos siga no instagram"
                            >
                                <i class="fa fa-instagram"></i>
                            </a>
                        @endif
                        @if($restorant->tiktok)
                            <a
                                class="nav-link nav-link-icon"
                                href="{{ config('global.tiktok') }}"
                                target="_blank"
                                data-toggle="tooltip"
                                title="Nos siga no tiktok"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"></path></svg>
                            </a>
                        @endif
                        @if($restorant->youtube)
                            <a
                                class="nav-link nav-link-icon"
                                href="{{ config('global.youtube') }}"
                                target="_blank"
                                data-toggle="tooltip"
                                title="Se inscreva no nosso canal do youtube"
                            >
                                <i class="fa fa-youtube"></i>
                            </a>
                        @endif
                    </div>          
                @endif
            </div>
            <div class="col-4">
                <p><i class="ri-map-pin-line h1"></i> {{ $restorant->address }}</p>
                <p>
                    <a href="https://api.whatsapp.com/send?phone=+55{{ $restorant->phone }}" target="_blank" class="btn text-white mt-3" style="width: 75%; background: #34af23; border-radius: 30px;">Enviar WhatsApp</a>
                </p>
            </div>
        </div>
    @endisset
    <div class="container-fluid bg-fixed text-white py-2" style="
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        background: black;
    ">
        <a href="/pages/1" class="p-3 d-flex align-items-center text-white">
            <span class="font-weight-bold">Cookies</span>
        </a>
        <a href="https://www.didoo.com.br" class="
            p-3
            d-flex
            justify-content-center
            align-items-center
            text-center
            text-white
        ">
            <span class="font-weight-bold hide-max-350" style="white-space: nowrap;">Feito com:</span>
            <img
                src="{{ asset('uploads/settings/f1827efb-1049-4022-9aa2-3a42cbe3e218_site_logo_dark.jpg') }}"
                class="d-block ml-2" style="height: 1.35rem; object-fit: contain;"
            />
        </a>
        <a href="/pages/1" class="p-3 d-flex align-items-center justify-content-end text-right text-white">
            <span class="font-weight-bold">Politica de Privacidade</span>
        </a>
    </div>
</div>
