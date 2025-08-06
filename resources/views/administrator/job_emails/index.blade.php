@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="email-wrap">
                <div class="row">
                    <div class="col-xl-3 box-col-3 col-md-6 xl-30">
                        <div class="email-sidebar">

                            <div class="email-left-aside">
                                <div class="card">

                                    <div class="card-body">
                                        <div class="email-app-sidebar">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h6 class="f-w-600">{{env('MAIL_FROM_NAME')}}</h6>
                                                    <p>{{env('MAIL_FROM_ADDRESS')}}</p>
                                                </div>
                                            </div>
                                            <ul class="nav main-menu" role="tablist">

                                                <li>
                                                    <div>
                                                        <form action="{{route('administrator.'.$prefixView.'.store')}}"
                                                              method="post"
                                                              enctype="multipart/form-data">
                                                            @csrf

                                                            <div class="mb-3">

                                                                <label
                                                                    class="col-form-label">To:@include('administrator.components.lable_require')</label>
                                                                <select name="user_ids[]"
                                                                        class="form-control select2_init" multiple required>
                                                                    <option value=""></option>
                                                                    @foreach(\App\Models\User::all() as $item)
                                                                        <option value="{{$item->id}}">#{{$item->id}} - {{$item->name}}
                                                                            - {{$item->email}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="message-subject" class="col-form-label">Thời gian gửi @include('administrator.components.lable_require')</label>
                                                                <input name="time_send" type="date"
                                                                       class="bg-white form-control open-jquery-date-time"
                                                                       placeholder="--/--/--" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="message-subject" class="col-form-label">Tiêu đề email:@include('administrator.components.lable_require')</label>
                                                                <input name="subject" type="text" class="form-control"
                                                                       id="message-subject" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Nội
                                                                    dung email:@include('administrator.components.lable_require')</label>
                                                                <textarea name="contents" style="height: 300px;"
                                                                          class="form-control tinymce_editor_init @error('contents') is-invalid @enderror"
                                                                          id="message-text" rows="8"></textarea>
                                                                @error('contents')
                                                                <div class="alert alert-danger">{{$message}}</div>
                                                                @enderror
                                                            </div>

                                                            <button type="submit" class="btn btn-primary mt-3">Submit
                                                            </button>

                                                        </form>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-9 box-col-9 col-md-12 xl-70">
                        <div class="email-right-aside">
                            <div class="card email-body">
                                <div class="email-profile">
                                    <div>
                                        <div class="pe-0 b-r-light"></div>
                                        <div class="inbox">
                                            @foreach($items as $item)

                                                <div class="email-list-item">
{{--                                                    <div class="email-list-actions">--}}
{{--                                                        <div class="form-check">--}}
{{--                                                            <input type="checkbox" class="form-check-input">--}}
{{--                                                        </div>--}}

{{--                                                    </div>--}}
                                                    <a href="#" class="email-list-detail me-3">
                                                        <div class="content">
                                                            <span class="from">{{\App\Models\Formatter::getShortDescriptionAttribute($item->title,10)}}</span>
                                                            <p class="msg">{{\App\Models\Formatter::getShortDescriptionAttribute($item->content,20)}}</p>
                                                        </div>
                                                        <span class="date">
                            {{\App\Models\Formatter::getOnlyDate($item->time_send)}} {{\App\Models\Formatter::getOnlyTime($item->time_send)}}
                          </span>
                                                    </a>

                                                    <a style="position: absolute;right: 10px;top: 15px;font-size: 10px;"
                                                       href="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}"
                                                       data-url="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}"
                                                       class="btn-outline-danger btn-sm action_delete">
                                                        <i class="fa-solid fa-x"></i>
                                                    </a>

                                                </div>



                                            @endforeach
                                            <div>
                                                @include('administrator.components.footer_table')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
