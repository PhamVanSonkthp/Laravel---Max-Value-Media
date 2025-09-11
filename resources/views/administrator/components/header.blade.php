<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="feather feather-menu">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
    </a>
    <div class="navbar-content">
        <div class="search-form" style="width: auto;">
            <div class="input-group">
                <div class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <input type="text" class="form-control" id="input_search_method" placeholder="Tìm kiếm..."
                       oninput="onSearchMethod()">
            </div>
        </div>
        <ul class="navbar-nav">

            <li class="nav-item dropdown">
                <span class="ms-1 me-1 d-none d-md-inline-block">
                    <i class="fa-regular fa-clock"></i>
                    <span class="ms-1">
                        {{optional(auth()->user())->timezone}} <span id="header_clock">{{\App\Models\Formatter::getDateTime(\Carbon\Carbon::now()->toDateTimeString())}}</span>
                    </span>
                </span>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="wd-30 ht-30 rounded-circle" src="{{optional(auth()->user())->avatar()}}" alt="profile">
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <img class="wd-80 ht-80 rounded-circle" src="{{optional(auth()->user())->avatar()}}" alt="">
                        </div>
                        <div class="text-center">
                            <p class="tx-16 fw-bolder">{{optional(auth()->user())->name}}</p>
                            <p class="tx-12 text-muted">{{optional(auth()->user())->email}}</p>
                        </div>
                    </div>
                    <ul class="list-unstyled p-1">

                        <li class="dropdown-item py-2">
                            <a href="{{route('administrator.password.index')}}" class="text-body ms-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-edit me-2 icon-md">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                <span>Change password</span>
                            </a>
                        </li>

                        <li class="dropdown-item py-2">
                            <a href="{{route('administrator.logout')}}" class="text-body ms-0 text-danger">
                                <svg style="color: red" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-log-out me-2 icon-md">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span class="text-danger">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>


<script>


    function startClock(targetId, startTime, format = "Y-m-d H:i:s") {
        const clockEl = document.getElementById(targetId);

        // Parse start time to Date
        let current = new Date(startTime);

        function pad(n) {
            return String(n).padStart(2, "0");
        }

        function render() {
            let Y = current.getFullYear();
            let m = pad(current.getMonth() + 1);
            let d = pad(current.getDate());
            let H = pad(current.getHours());
            let i = pad(current.getMinutes());
            let s = pad(current.getSeconds());

            let output = format
                .replace("Y", Y)
                .replace("m", m)
                .replace("d", d)
                .replace("H", H)
                .replace("i", i)
                .replace("s", s);

            clockEl.textContent = output;
        }

        // tick every 1s
        setInterval(() => {
            current.setSeconds(current.getSeconds() + 1);
            render();
        }, 1000);

        render();
    }

    // Example: Start from 2025-01-01 12:00:00
    startClock("header_clock", "{{\App\Models\Formatter::getDateTime(\Carbon\Carbon::now()->toDateTimeString())}}", "Y-m-d H:i:s");
</script>
