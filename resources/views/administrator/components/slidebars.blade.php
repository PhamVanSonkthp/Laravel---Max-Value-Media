<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{route('administrator.dashboard.index')}}" class="sidebar-brand">
            <img style="width: 130px;" src="{{ \App\Models\Helper::logoImagePath() }}">
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div id="container_slidebar" class="sidebar-body ps">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{route('administrator.dashboard.index')}}" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-box link-icon">
                        <path
                            d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            @can('users-list')
                <li class="nav-item">
                    <a href="{{route('administrator.users.index')}}" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span class="link-title ms-3">Publishers</span>
                    </a>
                </li>
            @endcan

            @can('websites-list')
                <li class="nav-item"><a href="{{route('administrator.websites.index')}}" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-box link-icon">
                            <path
                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        <span class="link-title">Websites</span>
                    </a>
                </li>
            @endcan

            @can('reports-list')
                <li class="nav-item"><a
                        href="{{route('administrator.reports.index')}}?filter=%5Bdate%3Ddesc%2Cd_ecpm%3D%2Cd_impression%3Ddesc%5D"
                        class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-box link-icon">
                            <path
                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        <span class="link-title">Reports</span>
                    </a>
                </li>
            @endcan

            {{--            @can('chats-list')--}}
            {{--                <li class="nav-item">--}}
            {{--                    <a href="{{route('administrator.chats.index')}}" class="nav-link">--}}
            {{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"--}}
            {{--                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
            {{--                             class="feather feather-message-square link-icon">--}}
            {{--                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>--}}
            {{--                        </svg>--}}
            {{--                        <span class="link-title">Chat</span>--}}
            {{--                        @if(\App\Models\ParticipantChat::where('user_id', auth()->id())->sum('number_not_read'))--}}
            {{--                            <span class="badge bg-danger fw-bolder ms-auto"--}}
            {{--                                  style="position: absolute;right: 0;top: 7px;">--}}
            {{--                                {{\App\Models\ParticipantChat::where('user_id', auth()->id())->sum('number_not_read')}}--}}
            {{--                        </span>--}}
            {{--                        @endif--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endcan--}}

            {{--            <li class="nav-item nav-category">Bán hàng</li>--}}

            {{--            @can('categories-list')--}}
            {{--                <li class="nav-item">--}}
            {{--                    <a href="{{route('administrator.categories.index')}}" class="nav-link">--}}
            {{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"--}}
            {{--                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
            {{--                             class="feather feather-box link-icon">--}}
            {{--                            <path--}}
            {{--                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>--}}
            {{--                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>--}}
            {{--                            <line x1="12" y1="22.08" x2="12" y2="12"></line>--}}
            {{--                        </svg>--}}
            {{--                        <span class="link-title">Danh mục sản phẩm</span>--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endcan--}}

            {{--            @can('products-list')--}}
            {{--                <li class="nav-item">--}}
            {{--                    <a href="{{route('administrator.products.index')}}" class="nav-link">--}}
            {{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"--}}
            {{--                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
            {{--                             class="feather feather-box link-icon">--}}
            {{--                            <path--}}
            {{--                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>--}}
            {{--                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>--}}
            {{--                            <line x1="12" y1="22.08" x2="12" y2="12"></line>--}}
            {{--                        </svg>--}}
            {{--                        <span class="link-title">Sản phẩm</span>--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endcan--}}

            {{--            @can('orders-list')--}}
            {{--                <li class="nav-item">--}}
            {{--                    <a href="{{route('administrator.orders.index')}}" class="nav-link">--}}
            {{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"--}}
            {{--                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
            {{--                             class="feather feather-box link-icon">--}}
            {{--                            <path--}}
            {{--                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>--}}
            {{--                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>--}}
            {{--                            <line x1="12" y1="22.08" x2="12" y2="12"></line>--}}
            {{--                        </svg>--}}
            {{--                        <span class="link-title">Đơn hàng</span>--}}

            {{--                        @if(\App\Models\Order::where('order_status_id', 1)->count())--}}
            {{--                            <div class="badge rounded-pill bg-danger ms-auto">--}}
            {{--                                {{\App\Models\Order::where('order_status_id', 1)->count()}}--}}
            {{--                            </div>--}}
            {{--                        @endif--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endcan--}}

            {{--            @can('vouchers-list')--}}
            {{--                <li class="nav-item">--}}
            {{--                    <a href="{{route('administrator.vouchers.index')}}" class="nav-link">--}}
            {{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"--}}
            {{--                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
            {{--                             class="feather feather-box link-icon">--}}
            {{--                            <path--}}
            {{--                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>--}}
            {{--                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>--}}
            {{--                            <line x1="12" y1="22.08" x2="12" y2="12"></line>--}}
            {{--                        </svg>--}}
            {{--                        <span class="link-title">Mã giảm giá</span>--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endcan--}}

            {{--            @can('product_comments-list')--}}
            {{--                <li class="nav-item">--}}
            {{--                    <a href="{{route('administrator.product_comments.index')}}" class="nav-link">--}}
            {{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"--}}
            {{--                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
            {{--                             class="feather feather-box link-icon">--}}
            {{--                            <path--}}
            {{--                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>--}}
            {{--                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>--}}
            {{--                            <line x1="12" y1="22.08" x2="12" y2="12"></line>--}}
            {{--                        </svg>--}}
            {{--                        <span class="link-title">Bình luận sản phẩm</span>--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endcan--}}

            {{--            @can('flash_sales-list')--}}
            {{--                <li class="nav-item">--}}
            {{--                    <a href="{{route('administrator.flash_sales.index')}}" class="nav-link">--}}
            {{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"--}}
            {{--                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
            {{--                             class="feather feather-box link-icon">--}}
            {{--                            <path--}}
            {{--                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>--}}
            {{--                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>--}}
            {{--                            <line x1="12" y1="22.08" x2="12" y2="12"></line>--}}
            {{--                        </svg>--}}
            {{--                        <span class="link-title">Flash sales</span>--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endcan--}}

            {{--            <li class="nav-item nav-category">Mạng xã hội</li>--}}

            {{--            @can("posts-list")--}}
            {{--                <li class="nav-item">--}}
            {{--                    <a href="{{route("administrator.posts.index")}}" class="nav-link">--}}
            {{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"--}}
            {{--                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
            {{--                             class="feather feather-box link-icon">--}}
            {{--                            <path--}}
            {{--                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>--}}
            {{--                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>--}}
            {{--                            <line x1="12" y1="22.08" x2="12" y2="12"></line>--}}
            {{--                        </svg>--}}
            {{--                        <span class="link-title">Posts</span>--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endcan--}}

            {{--            @can("post_comments-list")--}}
            {{--                <li class="nav-item">--}}
            {{--                    <a href="{{route("administrator.post_comments.index")}}" class="nav-link">--}}
            {{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"--}}
            {{--                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
            {{--                             class="feather feather-box link-icon">--}}
            {{--                            <path--}}
            {{--                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>--}}
            {{--                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>--}}
            {{--                            <line x1="12" y1="22.08" x2="12" y2="12"></line>--}}
            {{--                        </svg>--}}
            {{--                        <span class="link-title">Bình luận</span>--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endcan--}}





            @if(env('APP_ENV') == "local")

                <li class="nav-item nav-category">Temple</li>



                /*step_1*/

            @endif

            @if(auth()->user()->can('user_withdraws-list'))

                <li class="nav-item nav-category">Finances</li>

{{--                @can('user_transactions-list')--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('administrator.user_transactions.index')}}" class="nav-link">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
{{--                                 fill="none"--}}
{{--                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                 class="feather feather-box link-icon">--}}
{{--                                <path--}}
{{--                                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>--}}
{{--                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>--}}
{{--                                <line x1="12" y1="22.08" x2="12" y2="12"></line>--}}
{{--                            </svg>--}}
{{--                            <span class="link-title">Transactions</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endcan--}}

                @can('user_withdraws-list')
                    <li class='nav-item'>
                        <a href='{{route('administrator.user_withdraws.index')}}' class='nav-link'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-box link-icon">
                                <path
                                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                <line x1="12" y1="22.08" x2="12" y2="12"></line>
                            </svg>
                            <span class="link-title">Wallet</span>
                        </a>
                    </li>
                @endcan

            @endif

            @if(auth()->user()->can('employees-list') || auth()->user()->can('roles-list'))


                <li class="nav-item nav-category">Permissions</li>

                @can('employees-list')
                    <li class="nav-item">
                        <a href="{{route('administrator.employees.index')}}" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-box link-icon">
                                <path
                                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                <line x1="12" y1="22.08" x2="12" y2="12"></line>
                            </svg>
                            <span class="link-title">Employees</span>
                        </a>
                    </li>
                @endcan

                @can('roles-list')
                    <li class="nav-item">
                        <a href="{{route('administrator.roles.index')}}" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-box link-icon">
                                <path
                                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                <line x1="12" y1="22.08" x2="12" y2="12"></line>
                            </svg>
                            <span class="link-title">Roles</span>
                        </a>
                    </li>
                @endcan

            @endif
        </ul>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
    </div>
</nav>
