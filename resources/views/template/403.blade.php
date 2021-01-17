<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/ico" href="{{ asset('assets/img/favicon.ico') }}">
    <title>Forbiden | Library Management System</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/staticpage.css') }}">
</head>

<body>
    <div class="maincontainer" style="background: url('{{ asset('assets/img/HauntedHouseBackground.png') }}');">
        <div class="bat">
            <img class="wing leftwing" src="{{ asset('assets/img/bat-wing.png') }}">
            <img class="body" src="{{ asset('assets/img/bat-body.png') }}" alt="bat">
            <img class="wing rightwing" src="{{ asset('assets/img/bat-wing.png') }}">
        </div>
        <div class="bat">
            <img class="wing leftwing" src="{{ asset('assets/img/bat-wing.png') }}">
            <img class="body" src="{{ asset('assets/img/bat-body.png') }}" alt="bat">
            <img class="wing rightwing" src="{{ asset('assets/img/bat-wing.png') }}">
        </div>
        <div class="bat">
            <img class="wing leftwing" src="{{ asset('assets/img/bat-wing.png') }}">
            <img class="body" src="{{ asset('assets/img/bat-body.png') }}" alt="bat">
            <img class="wing rightwing" src="{{ asset('assets/img/bat-wing.png') }}">
        </div>
        <img class="foregroundimg" src="{{ asset('assets/img/HauntedHouseForeground.png') }}" alt="haunted house">
    </div>
    <h1 class="errorcode">ERROR 403</h1>
    <div class="errortext">This area is forbidden. Turn <a href="{{ url('/') }}">Back</a> now!</div>
</body>

</html>