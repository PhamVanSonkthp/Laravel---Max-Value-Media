@extends('user.layouts.master')

@section('title')

    <meta name="keyword" content="{{env('APP_NAME')}}">
    <meta name="promotion" content="{{env('APP_NAME')}}">
    <meta name="Description" content="{{env('APP_NAME')}}">

    <meta property="og:url" content="{{env('APP_URL')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{env('APP_NAME')}}"/>
    <meta property="og:description" content="{{env('APP_NAME')}}"/>
    <meta property="og:image" content="{{env('APP_URL') . \App\Models\Helper::logoImagePath() }}"/>

@endsection

@section('name')

@endsection

@section('css')
    <style>

        .avatar-upload {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .avatar-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #ddd;
            margin-bottom: 15px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endsection

@section('content')

    <!-- Main Content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <h4 class="mb-4">Profile Settings</h4>

                                <!-- Avatar -->
                                <div class="form-group avatar-upload">
                                    <div class="avatar-preview" id="avatarPreview">
                                        <img src="{{optional(auth()->user())->avatar()}}" alt="Avatar">
                                    </div>
                                    <div>

                                        <input type="file" id="avatarInput" accept="image/*" class="form-control-file" name="image">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" id="email" class="form-control" value="user@example.com"
                                           disabled>
                                </div>

                                <!-- Change Password -->
                                <div class="form-group">
                                    <label for="currentPassword">Current Password</label>
                                    <input type="password" id="currentPassword" class="form-control" name="current_password">
                                    @if(session('current_password'))
                                        <div class="alert alert-danger mt-2">
                                            <strong>{{ session('current_password') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="newPassword">New Password</label>
                                    <input type="password" id="newPassword" class="form-control" name="new_password">
                                    @if(session('new_password'))
                                        <div class="alert alert-danger mt-2">
                                            <strong>{{ session('new_password') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="confirmPassword">Confirm New Password</label>
                                    <input type="password" id="confirmPassword" class="form-control" name="new_password_confirm">
                                    @if(session('new_password_confirm'))
                                        <div class="alert alert-danger mt-2">
                                            <strong>{{ session('new_password_confirm') }}</strong>
                                        </div>
                                    @endif
                                </div>

                                @if(session('success'))
                                    <div class="alert alert-success mt-2">
                                        <strong>{{ session('success') }}</strong>
                                    </div>
                                @endif

                                <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                            </form>


                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        // Avatar preview
        $('#avatarInput').on('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#avatarPreview img').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
