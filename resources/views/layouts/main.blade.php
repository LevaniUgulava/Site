<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Your Page Title</title>
</head>

<body>
    <header>
        <h1>Your Website Title</h1>
        <nav>
            <ul>
                <li><a href="{{url('/home')}}">Home</a></li>
                <li><a href="{{url('/all')}}">All</a></li>
                <li><a href="{{url('/Cart')}}">Cart</a></li>
                <li><a href="{{url('/create')}}">Insert</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    @yield('content')
    <footer>
        
        <p>&copy; 2024 Your Website Name. All rights reserved.</p>
    </footer>
</body>

</html>