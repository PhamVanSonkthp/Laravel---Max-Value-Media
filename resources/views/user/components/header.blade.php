<!-- Top Bar -->
<nav class="top_navbar">
    <div class="container">
        <div class="row clearfix">
            <div class="col-12">
                <div class="navbar-logo">
                    <a href="javascript:void(0);" class="bars"></a>
                    <a class="navbar-brand" href="{{route('user.index')}}"><img src="{{asset('assets/images/YxPIef1UWMmT7hFjDUxN.png')}}" style="width: 157px;margin-left: -20px;"><span class="m-l-10">Maxvalue.media</span></a>
                </div>
                <ul class="nav navbar-nav">

                    <li class="dropdown notifications">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="icon-bell"></i><span class="label-count"></span></a>
                        <ul class="dropdown-menu">
                            <li class="header">New Message</li>
                            <li class="body">
                                <ul class="menu list-unstyled">
                                    <li class="text-center">
                                        Nothing
                                    </li>
{{--                                    <li>--}}
{{--                                        <a href="javascript:void(0);">--}}
{{--                                            <div class="media">--}}
{{--                                                <img class="media-object" src="{{asset('user/assets/images/xs/avatar5.jpg')}}" alt="">--}}
{{--                                                <div class="media-body">--}}
{{--                                                    <span class="name">Alexander <span class="time">13min ago</span></span>--}}
{{--                                                    <span class="message">Meeting with Shawn at Stark Tower by 8 o'clock.</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}

                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown profile">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <img class="rounded-circle" src="{{optional(auth()->user())->avatar()}}" alt="User">
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="user-info">
                                    <h6 class="user-name m-b-0">{{optional(auth()->user())->email}}</h6>
                                    <p class="user-position">Balance: <strong>${{\App\Models\Formatter::formatMoney(optional(auth()->user())->amount, 2)}}</strong></p>
                                    <hr>
                                </div>
                            </li>
                            <li><a href="{{route('user.profile')}}"><i class="icon-user m-r-10"></i> <span>Profile</span></a></li>
                            <li><a href="{{route('user.logout')}}"><i class="icon-power m-r-10"></i><span>Sign Out</span></a></li>
                        </ul>
                    </li>


                </ul>
            </div>
        </div>
    </div>
</nav>
