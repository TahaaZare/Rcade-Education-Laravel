@extends('pwa.master')
@section('title', "ویرایش سر فصل : $sesson->name")
@section('app-menu')
    @include('pwa.app-button-menu')
@endsection
@section('header')
    @include('pwa.header')
@endsection
@section('content')
    <div class="clearfix row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="p-3 card">
                <form action="{{ route('admin.course-sesson.update', [$user->username, $course, $sesson]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="clearfix row">
                        <div class="col-12">
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="form-label" for="name">عنوان</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $sesson->name) }}" placeholder="عنوان را وارد کنید">
                                    <i class="clear-input">
                                        <ion-icon name="close-circle" role="img" class="md hydrated"
                                            aria-label="close circle"></ion-icon>
                                    </i>
                                </div>
                            </div>
                            @error('name')
                                <p class="p-4 m-1 bg-yellow-300 rounded">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-12 my-4">
                            <button type="submit" class="btn btn-block btn-primary">
                                ثبت
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\Content\Course\Sesson\UpdateSessonAdminRequest') !!}
@endsection
