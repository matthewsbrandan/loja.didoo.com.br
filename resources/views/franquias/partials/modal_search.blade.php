<div class="modal fade" id="modal-search-product" z-index="9999" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
              <form onsubmit="return handleSearchProduct(event);">
                <div class="form-group m-0" style="position: relative;">
                  <input type="text" class="form-control" id="search-product" placeholder="Pesquisar Produto" autofocus/>
                  <button type="submit" class="btn" style="position: absolute; top: 0; right: 0;">
                    <img src="{{ asset('/images/icons/06_search.svg') }}" alt="Pesquisa" style="margin: auto;">
                  </button>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
<script>
  function handleSearchProduct(event){
    event.preventDefault();
    $('.handle-search-product').hide();
    $(`.handle-search-product:contains('${$('#search-product').val()}')`).show();
    // each(card => {
    //   let title = $(`#${card.id}`).attr('data-title');
    //   if(title.indexOf($('#search-product').val())) $(`#${card.id}`).show();
    //   else $(`#${card.id}`).hide();
    // });
    $('#modal-search-product').modal('hide');
  }
</script>