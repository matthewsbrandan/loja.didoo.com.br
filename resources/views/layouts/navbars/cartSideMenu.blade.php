@php 
	if(isset($restorant)){
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
<div id="cartSideNav" class="sidenav-cart sidenav-cart-close">
    
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    
    <div class="offcanvas-menu-inner " style="padding:10px 5px 10px 10px;"> 
        <div class="minicart-content">
            <div class="minicart-heading text-center pt-3">
                <h4 style="color:black; font-weight:bold">{{ __('Meu carrinho') }} <i class="ri-shopping-cart-line" style="color:black"></i> </h4>
            </div>
            <div class="searchable-container">
                <div id="cartList">
                    <div v-for="item in items" class="items col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
                        <div class="row mb-2 mx-0">
                            <div class="col-4">
                                <img :src="item.attributes.image"  class="productImage" alt="">
                            </div>
                            <div class="col">
                                <div style="font-size:13px; font-weight:bold; color:black">@{{ item.name }} </div>
                                <div class="mt-2" style="font-size:13px; font-weight:bold; color:black">@{{ item.attributes.friendly_price }}</div>
                                
                                <div class="bg-white mt-2">
                                    <div class="row">
                                        <div class="col-4">
                                            <span type="button" v-on:click="decQuantity(item.id)" :value="item.id" class="btn">
                                                <span class="btn-inner--icon btn-cart-icon"><i class="fa fa-minus"></i></span>
                                            </span>   
                                        </div>
                                        <div class="col-4 text-center">
                                            <span class="btn">
                                                @{{ item.quantity }}
                                            </span>
                                        </div>
                                        <div class="col-4">
                                            <span type="button" v-on:click="incQuantity(item.id)" :value="item.id" class="btn bg-white">
                                                <span class="btn-inner--icon btn-cart-icon"><i class="fa fa-plus"></i></span>
                                            </span>     
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="button" v-on:click="remove(item.id)"  :value="item.id" class="btn" style="margin-top:40px">
                                    <span class="btn-inner--icon btn-cart-icon"><i class="fa fa-trash" style="font-size: 20px;"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="bg-white mb-2 w-100" style="padding:1px"></div>
                         
                    </div>
                </div>
                <div id="totalPrices" v-cloak class="mx-2">
                    <div  class="mb-4 mb-xl-0">
                        <div class="">
                            <div class="row">
                                <div class="col text-center mt-3">
                                    <span v-if="totalItems==0">{{ __('Cart is empty') }}!</span>
                                    <span v-if="totalPrice"><strong style="color:black">{{ __('Total') }}:</strong></span>
                                    <span v-if="totalPrice" class="ammount"><strong style="color:black">@{{ totalPriceFormat }}</strong></span>
                                </div>
                            </div>
                        </div>
                    </div> 
                   <br>
                    <div class="mb-2" data-toggle="modal" data-target="#modal-scheduling">
                        <a 
                            class="btn text-white font-weight-normal"
                            style="text-transform:none; border-radius:40px; background-color: gray; font-size: 1rem;line-height: 1;padding: .7rem; cursor: pointer;"
                        >Agendar para outra data</a>
                    </div>
                    <div class="mb-2 text-center" v-if="totalPrice" v-cloak>
                        <a
                            class="btn-sm"
                            style="
                                background-color: {{ $theme->bg_primary }};
                                color: {{ $theme->text_primary }};
                                border-radius:40px;
                                font-size: 1rem;
                                line-height: 1;
                                padding: .7rem;
                            "
                            onclick="closeNav()"
                        >{{ __('Continue Shopping') }}</a>
                    </div>
                    <div v-if="totalPrice" v-cloak>
                        <a
                            href="/cart-checkout"
                            class="btn-sm text-center text-white"
                            style="background-color: #009900;; border-radius:40px; font-size: 1rem;line-height: 1;padding: .7rem;"
                        >
                            {{ __('Finalizar Pedido') }}
                        </a>
                    </div>
                    <br>
                   
                </div>
            </div>
        </div>
    </div>
</div> 