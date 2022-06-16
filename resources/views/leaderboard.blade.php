<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Typing Test</title>
    <link href="{{ asset('css/style.css')}}" rel="stylesheet" type="text/css" />

    <!-- Import FontAwesome icons -->
    <script src="https://kit.fontawesome.com/2c9f15701e.js" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.4/jquery.validate.min.js"></script>
</head>
<body>
<div class="app">
    <div class="container">
        @include('includes.header')
        <div class="leaderboard">
            <div class="head">
                <h1>Best users</h1>
            </div>
            <div class="leaderboard-body">
                    @foreach($tests as $test)
                        <div class="leaderboard-element">
                            <div class="element">
                                {{ $test->user_name }}
                            </div>
                            <div class="element">
                                {{ $test->wpm }} WPM
                            </div>
                            <div class="element">
                                {{ $test->missed }} missed
                            </div>
                            <div class="element">
                                {{ $test->mistakes }} mistakes
                            </div>
                            <div class="element">
                                {{ date("d/m h:i", strtotime ($test->updated_at)) }}
                            </div>
                        </div>
                    @endforeach
        </div>
    </div>
    </div>
</div>
</body>
</html>
