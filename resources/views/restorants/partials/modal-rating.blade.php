<div class="py-4" id="modal-rating-history" style="
	position: fixed;
	top: 0;  bottom: 4rem;
	left: 0; right: 0;
	background: #fff;
	z-index: 9999;
	overflow-y: auto;
  display: none;
">
	<div class="container">
    @php
			if(!isset($avaliacoes)){
				$loja = $restorant->id;
				$avaliacoes = DB::select("SELECT * FROM avaliacoes WHERE loja = $loja ORDER BY id DESC");
				$reTotal = 0;

				if(count($avaliacoes) > 0){
					foreach($avaliacoes as $v){ $reTotal += $v->estrelas; }
					$reTotal = $reTotal/count($avaliacoes);
				}
			}
		@endphp
		<div class="d-flex justify-content-between">
			<h3>Avaliações</h3>
			<a
				class="closebtn"
				onclick="$('#modal-rating-history').hide('slow')"
				href="javascript:void(0)"
				style="font-size: 1.8rem;"
			>×</a>
		</div>

    <button
      type="button"
      data-toggle="modal"
		  data-target="#avaliar"
      class="btn btn-sm btn-primary border-0 px-3"
      style="
        background: {{ $theme->bg_primary }};
        color: {{ $theme->text_primary }};
        text-transform: capitalize;
        font-weight: 500;
        border-radius: 1rem;
      "
    >Adicionar Avaliação</button>
		<div class="d-flex flex-column mt-3" style="gap: 1rem;">
			@foreach($avaliacoes as $avaliacao)
				<div class="card d-flex flex-row overflow-hidden shadow">
					<div style="
						background: {{ $theme->bg_primary }};
						color: {{ $theme->text_primary }};
						width: 1rem;
					"></div>
					<div class="card-body d-flex justify-content-between">
						<div>
							<h6 style="text-transform: capitalize;">{{ $avaliacao->nome }}</h6>
							@if($avaliacao->comentario)
								<p>{{ $avaliacao->comentario }}</p>
							@endif
						</div>
						@php
							$filled = $avaliacao->estrelas;
							if($filled < 0) $filled = 0;
							if($filled > 5) $filled = 5;
							$unfilled = 5 - $filled;
						@endphp
						<span>
							{!! str_repeat('<i class="ri-star-fill sfillx"></i>', $filled) !!}
							{!! str_repeat('<i class="ri-star-line sfillx"></i>', $unfilled) !!}
						</span>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>