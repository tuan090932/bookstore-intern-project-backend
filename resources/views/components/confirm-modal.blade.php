<!-- Action Modal -->
<div style="top: 200px !important;" class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $body }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form method="POST" action="{{ $url }}">
                    @csrf
                    @method($method)
                    @if(!empty($ids))
                        @foreach($ids as $id)
                            <input type="hidden" name="ids[]" value="{{ $id }}">
                        @endforeach
                    @endif
                    <button type="submit" class="btn btn-danger">{{ $confirmText }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
