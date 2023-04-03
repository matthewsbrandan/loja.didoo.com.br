<style>
	.footer_mobile{
		width: 100%;
		position: sticky;
		bottom: 0;
	}
	.hover-bg-secondary{ transition: .2s; }
	.hover-bg-secondary:hover{ background: #ddea; }
	.footer_mobile .text-xs{ font-size: .75rem; }

	@media(max-width: 350px){ .hide-max-350{ display: none } }
	@media(max-width: 490px){ .hide-max-490{ display: none } }

	.phpdebugbar{ display: none; }
</style>

<br><br><br> 

<!---FOOTER MOBILE------>

<footer class="continer-fluid footer_mobile d-sm-none">
	<div class="text-white text-sm font-weight-bold px-4" v-cloak v-if="totalItems > 0" id="cartResume" style="
		margin-bottom: 4rem;
		cursor: pointer;
		background: #7edc12;
	">
		<div class="justify-content-between" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: .2rem;" onClick="openNav()">
			<span>@{{ totalItems }}</span>
			<span class="text-uppercase text-center">Ver Carrinho</span>
			<span class="text-right">@{{ totalPriceFormat }}</span>
		</div>
	</div>
	<div class="card p-2 px-2 fixed bg-secondary" style="margin-top:-4rem;">
		<div style="
			display: grid;
			grid-template-columns: repeat(5, 1fr);
		">
			<div class="h-100 rounded-lg hover-bg-secondary text-center">
				<a
					target="_blank"
					href="https://www.google.com/maps/search/?api=1&query={{ urlencode($restorant->address) }}" 
					class="d-flex flex-column justify-center align-items-between h-100"
				>
					<i class="ri-map-pin-2-line text-xl"></i>
					<span class="font-weight-bolder text-xs hide-max-350">Visitar</span>
				</a>
			</div>
			<div class="h-100 rounded-lg hover-bg-secondary text-center">
				<div
					data-toggle="modal"
					data-target="#modal-forms"
					class="d-flex flex-column justify-center align-items-between h-100"
				>
					<i class="ri-instagram-line text-xl"></i>
					<span class="font-weight-bolder text-xs hide-max-350">Seguir</span>
				</div>
			</div>
			<div class="h-100 rounded-lg hover-bg-secondary text-center">
				<span style="
					position:absolute;
					margin-top: -7px;
    			margin-left: 5px;
					padding:3px 6px 3px 6px;
					border-radius:50%;
					background:#7800B4;					
					color:white;
					font-size:10px;
				"><span><?= count($avaliacoes); ?></span></span>
				<div
					data-toggle="modal"
					data-target="#avaliar"
					class="d-flex flex-column justify-center align-items-between h-100"
				>
					<i class="ri-star-line text-xl"></i>
					<span class="font-weight-bolder text-xs hide-max-350">Avaliar</span>
				</div>
			</div>
			<div class="h-100 rounded-lg hover-bg-secondary text-center">
				<a
					href="#home"
					class="d-flex flex-column justify-center align-items-between h-100"
				>
					<i class="ri-home-5-line text-xl"></i>
					<span class="font-weight-bolder text-xs hide-max-350">Início</span>
				</a>
			</div>
			<div class="h-100 rounded-lg hover-bg-secondary text-center">
				<span id="cardResumeBadge" v-cloak v-if="totalItems > 0" style="
					position:absolute;
					margin-top: -7px;
    			margin-left: 5px;
					padding:3px 6px 3px 6px;
					border-radius:50%;
					background:#7800B4;					
					color:white;
					font-size:10px;
				">@{{ totalItems }}</span>
				<div onClick="openNav()" class="d-flex flex-column justify-center align-items-between h-100">
					<i class="ri-shopping-cart-line text-xl"></i>
					<span class="font-weight-bolder text-xs hide-max-350">Finalizar</span>
				</div>
			</div>    
		</div>
	</div>
	<div class="mx-0 text-white" style="
		position: absolute;
		left: 0; right: 0;

		font-size: 12px;
		background-color: #7800B4;

		display: grid;
    grid-template-columns: repeat(3, 1fr);
	">
		<div class="p-3 d-flex align-items-center">
			<span class="font-weight-bold">Cookies</span>
		</div>
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
		<div class="p-3 d-flex align-items-center justify-content-end text-right">
			<span class="font-weight-bold">
				<span class="hide-max-490">Política de </span>Privacidade</span>
		</div>
	</div>
</footer>

@include('restorants.partials.modal_search')