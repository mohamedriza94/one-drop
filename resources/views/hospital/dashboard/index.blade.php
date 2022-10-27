<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    hospital authenticated

    <li><a href="{{ route('hospital.logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        <em class="icon ni ni-signout"></em><span>Logout</span>
    </a></li>
    <form id="logout-form" action="{{ route('hospital.logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</body>
</html>