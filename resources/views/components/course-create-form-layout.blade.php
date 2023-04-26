<div class="course-single-wrapper">
    <div class="course-single-container">
        <form action="{{ route('create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-course-single-header-layout></x-course-single-header-layout>
            <x-course-content-form-layout></x-course-content-form-layout>
        </form>
    </div>
</div>
