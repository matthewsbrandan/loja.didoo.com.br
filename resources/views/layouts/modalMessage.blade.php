<button
  type="button"
  data-toggle="modal"
  data-target="#modal-message"
  id="btn-modal-message"
  class="d-none"
></button>
<div class="modal fade" id="modal-message" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title-notification"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
            </div>
        </div>
    </div>
</div>
<script>
  function callModalMessage(body, head = ''){
    $('#modal-message .modal-title').html(head);
    $('#modal-message .modal-body').html(body);
    $('#btn-modal-message').click();
  }
</script>