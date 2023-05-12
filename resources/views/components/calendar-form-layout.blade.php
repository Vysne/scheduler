<form action="{{ url('/apply') }}" method="POST">
    @csrf
    <div class="modal fade-scale" id="calendarEventAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="event-title-wrap">
                        <input type="text" id="event-title" name="event-title" placeholder="Title">
                    </div>
                    <div class="event-start-wrap">
                        <div class="event-date-wrap">
                            <input type="date" id="event-start-date" name="event-start-date">
                        </div>
                        <div class="event-time-wrap">
                            <input type="time" id="event-start-time" name="event-start-time">
                        </div>
                    </div>
                    <div class="event-end-wrap">
                        <div class="event-date-wrap">
                            <input type="date" id="event-end-date" name="event-end-date">
                        </div>
                        <div class="event-time-wrap">
                            <input type="time" id="event-end-time" name="event-end-time">
                        </div>
                    </div>
                    <div class="event-location-wrap">

                        <input type="text" id="event-location" name="event-location">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>
