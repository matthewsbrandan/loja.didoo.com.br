<div class="pl-lg-4">
    <form method="post" action="{{ route('admin.restaurants.update', $restorant) }}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('put')
        <input type="hidden" id="rid" value="{{ $restorant->id }}"/>
        @include('partials.fields',['fields'=>[
            ['ftype'=>'input','name'=>"Restaurant Name",'id'=>"name",'placeholder'=>"Restaurant Name",'required'=>true,'value'=>$restorant->name],
            ['ftype'=>'input','name'=>"Slogan da Loja",'id'=>"subname",'placeholder'=>"Slogan da Loja",'required'=>true,'value'=>$restorant->subname],
            ['ftype'=>'input','name'=>"Restaurant Description",'id'=>"description",'placeholder'=>"Restaurant description",'required'=>true,'value'=>$restorant->description],
            ['ftype'=>'input','name'=>"Restaurant Address",'id'=>"address",'placeholder'=>"Restaurant description",'required'=>true,'value'=>$restorant->address],
            ['ftype'=>'input','name'=>"Restaurant Phone",'id'=>"phone",'placeholder'=>"Restaurant phone",'required'=>true,'value'=>$restorant->phone],
        ]])
        @if(config('settings.multi_city'))
            @include('partials.fields',['fields'=>[
                ['ftype'=>'select','name'=>"Restaurant city",'id'=>"city_id",'data'=>$cities,'required'=>true,'value'=>$restorant->city_id],
            ]])
        @endif
        @if(config('app.ordering'))
            <div class="form-group{{ $errors->has('minimum') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-description">{{ __('Minimum order') }}</label>
                <input type="number" name="minimum" id="input-minimum" class="form-control form-control-alternative{{ $errors->has('minimum') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter Minimum order value') }}" value="{{ old('minimum', $restorant->minimum) }}" required autofocus>
                @if ($errors->has('minimum'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('minimum') }}</strong>
                    </span>
                @endif
            </div>
        @endif
        @if(auth()->user()->hasRole('admin'))
            <br/>
            <div class="row">
                <div class="col-6 form-group{{ $errors->has('fee') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-description">{{ __('Fee percent') }}</label>
                    <input type="number" name="fee" id="input-fee" step="any" min="0" max="100" class="form-control form-control-alternative{{ $errors->has('fee') ? ' is-invalid' : '' }}" value="{{ old('fee', $restorant->fee) }}" required autofocus>
                    @if ($errors->has('fee'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('fee') }}</strong>
                        </span> 
                    @endif
                </div>
                <div class="col-6 form-group{{ $errors->has('static_fee') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-description">{{ __('Static fee') }}</label>
                    <input type="number" name="static_fee" id="input-fee" step="any" min="0" max="100" class="form-control form-control-alternative{{ $errors->has('static_fee') ? ' is-invalid' : '' }}" value="{{ old('static_fee', $restorant->static_fee) }}" required autofocus>
                    @if ($errors->has('static_fee'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('static_fee') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <br/>
            <div class="form-group">
                <label class="form-control-label" for="item_price">{{ __('Is Featured') }}</label>
                <label class="custom-toggle" style="float: right">
                    <input type="checkbox" name="is_featured" <?php if($restorant->is_featured == 1){echo "checked";}?>>
                    <span class="custom-toggle-slider rounded-circle"></span>
                </label>
            </div>
        @endif
        <br/>
        @if(config('app.isft'))
        
        @include('partials.fields',['fields'=>[
            ['ftype'=>'bool','name'=>"Pickup",'id'=>"can_pickup",'value'=>$restorant->can_pickup == 1 ? "true" : "false"],
            ['ftype'=>'bool','name'=>"Delivery",'id'=>"can_deliver",'value'=>$restorant->can_deliver == 1 ? "true" : "false"],
            ['ftype'=>'bool','name'=>"Self Delivery",'id'=>"self_deliver",'value'=>$restorant->self_deliver == 1 ? "true" : "false"],
            ['ftype'=>'bool','name'=>"Free Delivery",'id'=>"free_deliver",'value'=>$restorant->free_deliver == 1 ? "true" : "false"],
        ]])

        @endif
        
        <div class="row">
            <?php
                $images=[
                    ['name'=>'resto_logo','label'=>__('Restaurant Image'),'value'=>$restorant->logom,'style'=>'max-width: 100%; object-fit: cover;'],
                    ['name'=>'resto_cover','label'=>__('Restaurant Cover Image'),'value'=>$restorant->coverm,'style'=>'max-width: 100%; height: 100px;']
                ]
            ?>
            @foreach ($images as $image)
                <div class="col-md-6">
                    @include('partials.images',$image)
                </div>
            @endforeach
        </div>

        @include('restorants.partials.theme')

        @include('restorants.partials.available_delivery_types')
        
        @include('restorants.partials.localisation')

        @if (config('settings.social_mode'))
            @include('restorants.partials.social_info')
        @endif
        

        <div class="text-center">
            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
        </div>
    </form>
</div>
