<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @vite([
    'resources/sass/app.scss', 'resources/js/app.js',
    'resources/sass/navbar.scss', 'resources/js/navbar.js',
    'resources/sass/sidebar.scss', 'resources/js/sidebar.js',
    'resources/sass/content.scss', 'resources/js/content.js',
    'resources/sass/page-title.scss',
    'resources/sass/filter.scss', 'resources/js/filter.js',
    'resources/sass/calendar.scss', 'resources/js/calendar.js',
    'resources/sass/application.scss'
    ])

</head>
<body>
<div class="app">
    <x-sidebar-layout></x-sidebar-layout>
    <div class="catalog-wrap">
        <x-navbar-layout></x-navbar-layout>
{{--        <div class="container rounded bg-white mt-5 mb-5">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-3 border-right">--}}
{{--                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">--}}
{{--                        <img class="rounded-circle mt-5" src="{{ asset('/img/user-profile.svg') }}" width="90">--}}
{{--                        <span class="font-weight-bold">Test User</span>--}}
{{--                        <span class="text-black-50">testuser@gmail.com</span>--}}
{{--                        <span>Joined: 2023-01-01</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-5 border-right">--}}
{{--                    <div class="p-3 py-5">--}}
{{--                        <div class="d-flex justify-content-between align-items-center mb-3">--}}
{{--                            <h6 class="text-right">Edit your profile</h6>--}}
{{--                        </div>--}}
{{--                        <div class="row mt-2">--}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="labels">Name</label>--}}
{{--                                <input type="text" class="form-control" placeholder="first name" value="Test">--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="labels">Surname</label>--}}
{{--                                <input type="text" class="form-control" value="User" placeholder="User">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row mt-3">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <label class="labels">Headline</label>--}}
{{--                                <input type="text" class="form-control" placeholder="headline" value="UI/UX Developer">--}}
{{--                            </div>--}}
{{--                            <div class="col-md-12">--}}
{{--                                <label class="labels">Current position</label>--}}
{{--                                <input type="text" class="form-control" placeholder="headline" value="Unemployed">--}}
{{--                            </div>--}}
{{--                            <div class="col-md-12">--}}
{{--                                <label class="labels">Education</label>--}}
{{--                                <input type="text" class="form-control" placeholder="education" value="Kaunas University of Technology">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row mt-3">--}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="labels">Country</label>--}}
{{--                                <input type="text" class="form-control" placeholder="country" value="Lithuania">--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="labels">State/Region</label>--}}
{{--                                <input type="text" class="form-control" value="Kaunas" placeholder="state">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mt-5 text-center">--}}
{{--                            <button class="btn btn-primary profile-button" type="button">Apply</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="p-3 py-5">--}}
{{--                        <div class="d-flex justify-content-between align-items-center experience">--}}
{{--                            <span>Edit Experience</span><span class="border px-3 p-1 add-experience">--}}
{{--                                <i class="fa fa-plus"></i>--}}
{{--                                &nbsp;Experience--}}
{{--                            </span>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-row mt-3 exp-container">--}}
{{--                            <img src="https://img.icons8.com/color/100/000000/twitter.png" width="45" height="45">--}}
{{--                            <div class="work-experience ml-1">--}}
{{--                                <span class="font-weight-bold d-block">Senior UI/UX Designer</span>--}}
{{--                                <span class="d-block text-black-50 labels">Twitter Inc.</span>--}}
{{--                                <span class="d-block text-black-50 labels">March,2017 - May 2020</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <hr>--}}
{{--                        <div class="d-flex flex-row mt-3 exp-container"><img src="https://img.icons8.com/color/100/000000/facebook.png" width="45" height="45">--}}
{{--                            <div class="work-experience ml-1">--}}
{{--                                <span class="font-weight-bold d-block">Senior UI/UX Designer</span>--}}
{{--                                <span class="d-block text-black-50 labels">Facebook Inc.</span>--}}
{{--                                <span class="d-block text-black-50 labels">March,2017 - May 2020</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <hr>--}}
{{--                        <div class="d-flex flex-row mt-3 exp-container"><img src="https://img.icons8.com/color/50/000000/google-logo.png" width="45" height="45">--}}
{{--                            <div class="work-experience ml-1">--}}
{{--                                <span class="font-weight-bold d-block">UI/UX Designer</span>--}}
{{--                                <span class="d-block text-black-50 labels">Google Inc.</span>--}}
{{--                                <span class="d-block text-black-50 labels">March,2017 - May 2020</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
</body>
