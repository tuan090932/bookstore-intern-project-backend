<!-- Action Modal -->
<div style="top: 200px !important;" class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $labelId }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $labelId }}">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $body }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="{{ $formId }}" method="POST" action="{{ $formAction }}">
                    @csrf
                    @method($method)
                    <input type="hidden" name="author_ids" id="{{ $inputId }}" value="{{ $inputId }}">
                    <button type="submit" class="btn btn-danger">{{ $confirmText }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
