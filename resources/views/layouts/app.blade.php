<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="d-flex flex-column min-vh-100">
    <div id="app" class="sticky-top shadow ">
        <nav class="navbar navbar-expand-md navbar-light bg-success shadow-sm">
            <div class="container-fluid">

                <a class="navbar-brand text-white" href="{{ url('/home') }}">
                    <img src="image/bmalogo.png" width="35" alt="" class="d-inline-block align-middle mr-2">
                    BMA LIBRARY SYSTEM
                </a>

                <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Left Side Of Navbar /if-else ng login-->
                @guest
                    @if (Route::has('login'))
                    @endif
                @else
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link text-white" href="home">Dashboard</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Books Management
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item dropdown-active-success" href="booklist">Books Entry</a>
                                    <a class="dropdown-item" href="bookaquired">Books Adjustment</a>
                                    <a class="dropdown-item" href="bookstatus">Books Issued / Returned</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="bookhistory">Books History</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Books Archived</a>
                                </div>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link text-white" href="usermanual">User Manual</a>
                            </li>
                    </div>
                @endguest
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                LOGIN 
                            </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item text-success" href="{{ route('login') }}">{{ __('STUDENT') }}</a>
                                    <a class="dropdown-item text-success" href="{{ route('login') }}">{{ __('FACULTY') }}</a>
                                </div>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('register') }}">{{ __('REGISTER') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            {{-- name ng profile --}}

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                {{-- dropdownlist --}}

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('settings-form').submit();">
                                    {{ __('Settings') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="settings-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none  text-white">
                                    @csrf
                                </form>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none  text-white">
                                    @csrf
                                </form>

                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
    </div>
    </nav>

    <main>
        @yield('content')

    </main>

    </div>

</body>

@guest
    @if (Route::has('login'))
    @endif
@else
    <footer class="mt-auto flex-shrink-0 py-3 bg-success text-white-50">
        <div class="container text-center">
            <small>Copyright &copy; BALIWAG MARITIME ACADEMY</small>
        </div>
    </footer>
@endguest

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

<script>

    $('.edit-button').on('click', function() {
        var id = $(this).data('id');
        $.get("/copy/" + id, function(data, status) {
            $('.modal-copy-copies').val(data.copy.copies)
        });
    });

    $(document).ready(function() {
        $(".myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".myTable .tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
    });
});

$('.edit-button').on('click', function() {
            var id = $(this).data('id');
            //$.get('url')
            $.get("/book/" + id, function(data, status) {
                $('.modal-book-id').val(data.book.id)
                $('.modal-book-title').val(data.book.booktitle)
                $('.modal-book-author').val(data.book.author)
                // $('.modal-book-copies').val(data.book.copies)
                $('.modal-book-datepublish').val(data.book.datepublish)
                $('.modal-book-isbn').val(data.book.isbn)
                $('.modal-book-genre').val(data.book.genre)
                $('.modal-book-publisher').val(data.book.publisher)
                $('.modal-book-addeddate').val(data.book.addeddate)
                // console.log(data)
            });
        });

        
</script>

@yield('script')

</html>