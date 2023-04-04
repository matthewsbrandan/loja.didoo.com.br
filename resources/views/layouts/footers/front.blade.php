<div class="d-none d-sm-block">
    @isset($restorant)
        <div class="container-fluid d-flex py-4" style="background:black">
            <div class="col-4 text-white">
                <img src="{{ $restorant->logom }}" class="rounded" />
                <h3 class="text-white">{{ $restorant->name }}</h3>
                <p class="text-white">
                    {{ $restorant->description }}
                </p>
            </div>
            <div class="col-4 text-white">
                <p>Horário de atendimento</p>
                <p><i class="ri-time-line"></i> {{(!empty($openingTime) && !empty($closingTime) ? "$openingTime - $closingTime": "FECHADO" )}}</p>
            </div>
            <div class="col-4 text-white">
                <p><i class="ri-map-pin-line h1 text-white"></i> {{ $restorant->address }}</p>
                <p>
                    <a href="https://api.whatsapp.com/send?phone=+55{{ $restorant->phone }}" target="_blank" class="btn text-white mt-3" style="width: 75%; background: #34af23; border-radius: 30px;">Enviar WhatsApp</a>
                </p>
            </div>
        </div>
    @endisset
    <div class="container-fluid bg-fixed text-white py-2" style="
        display: grid;
        grid-template-columns: repeat(3, 1fr);
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
