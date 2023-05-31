 <div class="modal fade-scale" id="{{ $member['user_id'] }}messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Message for {{ $member['name'] }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/members/' . $member['id'] . '/message/' . $member['user_id']) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="message-container">
                        <textarea class="message-box" name="message"></textarea>
                        <input type="hidden" name="receiver_id" value="{{ $member['user_id'] }}">
                        <input type="hidden" name="sender_id" value="{{ Auth::id() }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Send</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
 </div>

