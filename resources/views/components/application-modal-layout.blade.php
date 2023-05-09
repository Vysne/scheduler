<form action="{{ url('/apply') }}" method="POST">
    @foreach($application as $data)
    @csrf
    <div class="modal fade-scale" id="applicationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Course creator application</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if($data == "")
                <div class="modal-body">
                    <p>Before submitting the <b>Course creator application</b>, keep in mind that <b>your profile information</b> is used for the required procedure.</p>
                    <div class="tacbox">
                        <input id="checkbox" type="checkbox" required/>
                        <label for="checkbox"> I agree to these <a href="{{ route('terms-and-conditions') }}">Terms and Conditions</a>.</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.href='{{ route('profile') }}'">Edit profile</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                @else
                    <div class="modal-body">
                        <p><b>The Course creator application</b> is already submitted on {{ date('M d, Y', strtotime($data->created_at)) }}.</p>
                        <p>Please, be patient as response might take some time.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</form>
