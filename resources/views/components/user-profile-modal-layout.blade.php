<div class="modal fade-scale" id="{{ $enlistment['user_id'] }}userProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">User information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="main-body">
                        <div class="row gutters-sm">
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            @if($enlistment['user-image'] != 'user-profile.svg')
                                                <img src="{{ asset($enlistment['user-image']) }}" class="rounded-circle" width="100%" height="100%">
                                            @else
                                                <img src="{{ asset('/img/' . $enlistment['user-image']) }}" class="rounded-circle" width="100%" height="100%">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">User Title</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <span>{{ $enlistment['title'] }}</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <span>{{ $enlistment['email'] }}</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Mobile</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <span>{{ $enlistment['mobile'] }}</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Location</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <span data-status="static">{{ $enlistment['location'] }}</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Joined</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <span data-status="static">{{ date('M d, Y', strtotime($enlistment['created_at'])) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body card">
                                <div class="about-me-container">
                                    <h2>About me</h2>
                                    <div id="{{ $enlistment['id'] }}-about-me"></div>
                                    <input type="hidden" id="{{ $enlistment['id'] }}-descr-body" value="{{ $enlistment['aboutme-descr-body'] }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

