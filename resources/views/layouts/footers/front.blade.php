<style>
@media(max-width:598px){
    .d-nnone {
        display:none; 
    }
}
</style>
<div class="d-nnone">
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

    <div class="container-fluid d-flex bg-fixed text-white py-2">
        <div class="col-4 text-white">
            <p class="text-white">
                LGPD e Cookies
            </p>
        </div>
        <div class="col-4 text-white">
            <p>
                Criado orgulhosamente: Didoo
            </p>
        </div>
        <div class="col-4 text-white">
            <p>Politica de Privacidade</p>
        </div>
    </div>
</div>
