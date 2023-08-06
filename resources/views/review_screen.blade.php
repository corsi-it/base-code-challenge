<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Happiness review</title>
    <link href="{{ asset('css/review_screen.css') }}" rel="stylesheet">
</head>
<body>
<div class="language-switcher">
    <a href="{{ url('login/it') }}" class="{{ app()->getLocale() === 'it' ? 'active' : '' }}">Italiano</a>
    <a href="{{ url('login/en') }}" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">English</a>
</div>

<div class="vote-card">
    <h2>Anonymous happiness review</h2>
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
    <form method="POST" action="{{ route('submit-review') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email of user to review:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="rating">Stars:</label>
            <select id="rating" name="rating" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea id="comment" name="comment" rows="4" required></textarea>
        </div>



        <div class="form-group">
            <button type="submit" class="login-button">Submit Vote</button>
        </div>
    </form>
</div>

@auth
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-button">
        Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
        @csrf
    </form>
@endauth


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
