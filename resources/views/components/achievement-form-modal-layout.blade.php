<form action="{{ url('/members/' . $member['id'] . '/achievement/' . $member['user_id']) }}" method="POST">
    @csrf
    <div class="modal fade-scale" id="{{ $member['user_id'] }}achievementModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Achievement form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="achievement-creator" value="{{ Auth::user()->name }}">
                    <div class="achievement-title-wrap">
                        <span>Achievement title</span>
                        <input type="text" class="" id="achievement-title-input" name="achievement-title" required>
                    </div>
                    <div class="achievement-container">
                        <div id="{{ $member['user_id'] }}-achievement"></div>
                        <input type="hidden" id="{{ $member['user_id'] }}-achievement-descr" name="achievement-body" value=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal(this)" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>
