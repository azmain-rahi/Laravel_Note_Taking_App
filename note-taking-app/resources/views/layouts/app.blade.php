<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta tags, title, and other CSS -->
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .sidebar .nav-link {
            color: #000; /* Set the default color to black */
        }
        .sidebar .nav-link.active {
            color: #007bff; /* Set the active link color to blue */
        }
        main {
            padding-top: 2rem; /* Add some padding to the top */
        }
    </style>
</head>
<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Note taking app</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input id="searchInput" class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search notes..." aria-label="Search">
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <span class="nav-link px-3" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </span>
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <!-- Dashboard Link -->
                        @auth
                        <li class="nav-item">
                            <a class="nav-link @if(Request::route()->getName() == 'notes.index') active @endif" href="{{ route('notes.index') }}">{{ __('Dashboard') }}</a>
                        </li>
                        <!-- Create Note Link -->
                        <li class="nav-item">
                            <a class="nav-link @if(Request::route()->getName() == 'notes.create') active @endif" href="{{ route('notes.create') }}">{{ __('Create Note') }}</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                @yield('content')
            </main>
        </div>
    </div>
    <!-- Bootstrap JavaScript (optional, if you need Bootstrap JavaScript features) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('searchInput').addEventListener('keydown', function(event) {
            // Check if the key pressed is Enter (key code 13)
            if (event.keyCode === 13) {
                // Prevent the default form submission behavior
                event.preventDefault();
                // Get the search query from the input field
                var query = this.value.trim();
                // If the query is not empty, redirect to the search route with the query parameter
                if (query !== '') {
                    window.location.href = '{{ route("notes.search") }}?query=' + encodeURIComponent(query);
                }
            }
        });
    </script>
</body>
</html>