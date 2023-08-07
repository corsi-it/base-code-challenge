<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Happiness review</title>
    @livewireStyles
    <link href="{{ asset('css/review_screen.css') }}" rel="stylesheet">

</head>

<body>

<!--
<div class="language-switcher">
    <a href="{{ url('login/it') }}" class="{{ app()->getLocale() === 'it' ? 'active' : '' }}">Italiano</a>
    <a href="{{ url('login/en') }}" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">English</a>
</div>
-->
<div class="vote-card">
    <h2 class="mb-5">Anonymous happiness review</h2>
    <!--
        <div class="vote-stars">
        <span>Rate:</span>
        <ul class="list-unstyled">
            <li><i class="fas fa-star" data-rating="1"></i></li>
            <li><i class="fas fa-star" data-rating="2"></i></li>
            <li><i class="fas fa-star" data-rating="3"></i></li>
            <li><i class="fas fa-star" data-rating="4"></i></li>
            <li><i class="fas fa-star" data-rating="5"></i></li>
        </ul>
        </div>
        -->

    @section('content')
        @livewire('email-search-select')
    @endsection

    @yield('content')


</div>

@auth
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-button">
        Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
        @csrf
    </form>
@endauth

@livewireScripts
@stack('scripts')
<script>
    const stars = document.querySelectorAll('.fa-star');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const rating = star.dataset.rating;
            // Use 'rating' value as needed (e.g., send it to the server)
            console.log('You rated with ' + rating + ' stars');
        });
    });
</script>
</body>
</html>
