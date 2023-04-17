<hr/>
<h6 class="heading-small text-muted mb-4">{{ __('Accepting Payments') }}</h6>
<!-- Payment explanation and Mollie payments -->

<style>
    #form-group-payment_info span.select2{
        width: 100% !important;
        height: auto !important;
    }
</style>
<?php
    $paymentInfoDefault = [
        'Cash' => 'Cash',
        'Debit Card' => 'Debit Card',
        'Credit Card' => 'Credit Card',
        'Pix' => 'Pix'
    ];
    $currentPaymentInfo = explode(',',$restorant->payment_info);
    foreach($currentPaymentInfo as $payInfo){
        if(!array_search($payInfo, $paymentInfoDefault)){
            $paymentInfoDefault[$payInfo] = $payInfo;
        }
    }
?>
@include('partials.fields',['fields'=>[
    ['required'=>false,'ftype'=>'select','placeholder'=>"Payment info",'name'=>'Payment info', 'additionalInfo'=>'Select accepted payment methods', 'id'=>'payment_info', 'value'=> explode(',',$restorant->payment_info), 'data' => $paymentInfoDefault, 'multiple'=>true],
    ['required'=>false,'ftype'=>'input','placeholder'=>'Digite separado por vírgula','name'=>'Outras formas de pagamento (opcional)', 'id'=>'outher_payment'],
    ['required'=>false,'ftype'=>'input','placeholder'=>"Mollie Payment API key",'name'=>'Mollie Payment API key', 'additionalInfo'=>'Accept Mollie.com payment by entering the mollie api key', 'id'=>'mollie_payment_key', 'value'=>$restorant->mollie_payment_key],
]])

@if (config('settings.is_whatsapp_ordering_mode'))

<hr/>
<h6 class="heading-small text-muted mb-4">{{ __('Redes Sociais') }}</h6>
<!-- Payment explanation and Mollie payments -->
@include('partials.fields',['fields'=>[
    ['required'=>false,'ftype'=>'input','name'=>'Whatsapp phone', 'placeholder'=>'Whatsapp phone to receive orders on', 'id'=>'whatsapp_phone', 'value'=>$restorant->whatsapp_phone],
]])  
@endif
<!-- Payment explanation and Mollie payments -->
@include('partials.fields',['fields'=>[
    ['required'=>false,'ftype'=>'input','name'=>'Instagram link', 'placeholder'=>'https://www.instagram.com/'.__('store').'/', 'id'=>'instagram', 'value'=>$restorant->instagram],
]])
<!-- Payment explanation and Mollie payments -->
@include('partials.fields',['fields'=>[
    ['required'=>false,'ftype'=>'input','name'=>'Facebook link', 'placeholder'=>'https://www.facebook.com/'.__('store').'/', 'id'=>'facebook', 'value'=>$restorant->facebook],
]])
<!-- Payment explanation and Mollie payments -->
@include('partials.fields',['fields'=>[
    ['required'=>false,'ftype'=>'input','name'=>'Youtube link', 'placeholder'=>'https://www.youtube.com/'.__('store').'/', 'id'=>'youtube', 'value'=>$restorant->youtube],
]])
<!-- Payment explanation and Mollie payments -->
@include('partials.fields',['fields'=>[
    ['required'=>false,'ftype'=>'input','name'=>'Tiktok link', 'placeholder'=>'https://www.tiktok.com/'.__('store').'/', 'id'=>'tiktok', 'value'=>$restorant->tiktok],
]])

<hr>
 
<h6 class="heading-small text-muted mb-4">{{ __('Área de Atendimento') }}</h6>
<!-- Payment explanation and Mollie payments -->
@include('partials.fields',['fields'=>[
    ['required'=>false,'ftype'=>'input','name'=>'Área de atendimento', 'placeholder'=>'Centro, Vieralves, Moema, tatuapé Costa sul, jardim do lago', 'id'=>'area', 'value'=>$restorant->area],
]])
 
<h6 class="heading-small text-muted mb-4">{{ __('Tempo de Entrega') }}</h6>
<!-- Payment explanation and Mollie payments -->
@include('partials.fields',['fields'=>[
    ['required'=>false,'ftype'=>'input','name'=>'Tempo de Entrega', 'placeholder'=>'30-60 Min.', 'id'=>'tempo', 'value'=>$restorant->tempo],
]])