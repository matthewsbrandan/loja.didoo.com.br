<br />
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
<br />
<h6 class="heading-small text-muted mb-4">{{ __('WhatsApp number') }}</h6>
<!-- Payment explanation and Mollie payments -->
@include('partials.fields',['fields'=>[
    ['required'=>false,'ftype'=>'input','name'=>'Whatsapp phone', 'placeholder'=>'Whatsapp phone to receive orders on', 'id'=>'whatsapp_phone', 'value'=>$restorant->whatsapp_phone],
]])  
@endif
<br />
<h6 class="heading-small text-muted mb-4">{{ __('Link to Instagram page') }}</h6>
<!-- Payment explanation and Mollie payments -->
@include('partials.fields',['fields'=>[
    ['required'=>false,'ftype'=>'input','name'=>'Instagram link', 'placeholder'=>'https://www.instagram.com/'.__('store').'/', 'id'=>'instagram', 'value'=>$restorant->instagram],
]])