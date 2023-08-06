<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Office Happiness Measurement System</title>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <div class="language-switcher">
        <a href="{{ url('login/it') }}" class="{{ app()->getLocale() === 'it' ? 'active' : '' }}">Italiano</a>
        <a href="{{ url('login/en') }}" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">English</a>
    </div>
    <div class="login-card">
        <h2>Office Happiness Measurement System</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <button type="submit" class="login-button">Login</button>
            </div>

            @if ($errors->any())
                <div class="error-message">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </form>
    </div>
</body>
</html>
