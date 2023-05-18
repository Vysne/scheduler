<form action="{{ url('api/google/update/' . $event['id']) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="modal fade-scale" id="calendarEventEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <input type="text" id="event-title" name="summary" value="{{ $event['summary'] }}" placeholder="Title" required>
                    </div>
                    <div class="event-location-wrap">
                        <input type="text" id="event-location" name="location" placeholder="&#xf041; Location" required>
                    </div>
                    <div class="event-description-wrap">
                        <textarea id="event-description" name="description" placeholder="Description"></textarea>
                    </div>
                    <div class="event-start-wrap">
                        <div class="event-date-wrap">
                            <input type="date" id="event-start-date" name="event-start-date" value="{{ strstr(array_values($event['start'])[0], 'T', true) }}" required>
                        </div>
                        <div class="event-time-wrap">
                            <input type="time" id="event-start-time" name="event-start-time" value="{{ str_replace('T', '', strstr(strstr(array_values($event['start'])[0], 'T'), '+', true)) }}" required>
                        </div>
                    </div>
                    <div class="event-end-wrap">
                        <div class="event-date-wrap">
                            <input type="date" id="event-start-date" name="event-start-date" value="{{ strstr(array_values($event['end'])[0], 'T', true) }}" required>
                        </div>
                        <div class="event-time-wrap">
                            <input type="time" id="event-start-time" name="event-start-time" value="{{ str_replace('T', '', strstr(strstr(array_values($event['end'])[0], 'T'), '+', true)) }}" required>
                        </div>
                    </div>
                    <input type="hidden" name="timeZone" value="Europe/Vilnius">
                    <input type="hidden" name="userId" value="{{ auth()->id() }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>
