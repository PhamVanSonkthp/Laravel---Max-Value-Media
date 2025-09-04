<aside id="leftsidebar" class="sidebar h_menu">
    <div class="container">
        <div class="row clearfix">
            <div class="col-12">
                <div class="menu">
                    <ul class="list">
                        <li class="header">MAIN</li>
                        <li class="{{request()->routeIs('user.dashboard') || request()->routeIs('user.index') ? 'active ' : ''}}open"> <a href="{{route('user.dashboard')}}"><span>Dashboard</span></a></li>
                        <li class="{{request()->routeIs('user.website') ? 'active ' : ''}}open"> <a href="{{route('user.website')}}"><span>Website</span></a></li>
                        <li class="{{request()->routeIs('user.report') ? 'active ' : ''}}open"> <a href="{{route('user.report')}}"><span>Report</span></a></li>
                        <li class="{{request()->routeIs('user.wallet') ? 'active  ' : ''}}open"> <a href="{{route('user.wallet')}}"><span>Wallet</span></a></li>
                        @if(session()->has('impersonate'))
                            <li class="open"> <a href="{{ route('administrator.impersonate.leave') }}"><span class="text-danger">Back to Admin</span></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</aside>

