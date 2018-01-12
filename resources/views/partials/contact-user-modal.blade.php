
<!-- The Modal -->
<div class="modal fade" id="user_sprava">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Správa pre {{ $post->user->fullname ?? $user->fullname }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                @include('messenger.contact-form-user')
            </div>

        </div>
    </div>
</div>





