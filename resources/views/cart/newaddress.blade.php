<div
  id="addressBox"
  class="card card-profile shadow {{count($timeSlots) == 0 ? 'd-none':''}}"
>
    <div class="px-4">
      <div class="mt-5">
        <h3>{{ __('Delivery Address') }}<span class="font-weight-light"></span></h3>
      </div>
      <div class="card-content border-top">
        <br />
        @include('partials.input',['ftype'=>'input','name'=>"",'id'=>"zipcodeID",'placeholder'=>"Your zip code here ...",'required'=>true])



        @include('partials.input',['ftype'=>'input','name'=>"",'id'=>"cityID",'placeholder'=>"Your city here ...",'required'=>true])
        @include('partials.input',['ftype'=>'input','name'=>"",'id'=>"neighborhoodID",'placeholder'=>"Your neighborhood here ...",'required'=>true])
        @include('partials.input',['ftype'=>'input','name'=>"",'id'=>"addressID",'placeholder'=>"Your delivery address here ...",'required'=>true])
        @include('partials.input',['ftype'=>'input','name'=>"",'id'=>"addressNumberID",'placeholder'=>"Your house number, block, fit here ...",'required'=>true])
        <br/>
        <div class="form-group">
          <textarea name="complementID" id="complementID" class="form-control" placeholder="{{ __( 'Your complement here ...' ) }}"></textarea>
        </div>
      </div>
      <br />
      <br />
    </div>
</div>
<script>
  function completeAddress(){
    let code = $('#zipcodeID').val();
    code = code.replace('-','');
    if(code.length == 8){
      $.ajax({
        url:`https://viacep.com.br/ws/${code}/json/`,
        method:'GET',
        success:function(data){
          if(data.erro === true) callModalMessage('Chatinger','CEP Inválido',true);
          else{
            $('#neighborhoodID').val(data.bairro);
            $('#cityID').val(data.localidade);
            $('#addressID').val(data.logradouro);
            $('#addressNumberID').focus();
            changeNeighborhood();
          }
        },
      });
    }
  }
</script>
