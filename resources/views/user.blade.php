<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Typing Test</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS Styles -->
    <link href="{{ asset('css/style.css')}}" rel="stylesheet" type="text/css" />
    <!-- Connect FontAwesome icons -->
    <script src="https://kit.fontawesome.com/2c9f15701e.js" crossorigin="anonymous"></script>
    <!-- Import JS files -->
    <script defer type="text/javascript" src="{{asset('js/form.js') }}"></script>
</head>
    <body>
        <div class="app">
            <div class="container">
                @include('includes.header')
                @yield('content')
                <div>
                    @guest
                    @else
                        <div class="dashboard">
                            <span class="greeting">
                                Hello, {{ Auth::user()->name }}!
                            </span>
                            <div class="personal_best">
                                @if($record != null)
                                    <span class="best_result">Your best result is:</span>
                                    <div class="result_title">{{$record->wpm}} wpm</div>
                                    <div class="result_title">{{$record->missed}} missed</div>
                                    <div class="result_title">{{$record->mistakes}} mistakes</div>
                                    <div class="result_title">{{ date("d/m h:i", strtotime($record->updated_at)) }}</div>
                                @else
                                    <div class="no_result">There's no your personal best in database!</div>
                                @endif
                            </div>
                            <div class="buttons">
                            <div class="input-field button">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                    @csrf
                                    <input type="submit" value="Logout" name="submit">
                                </form>
                            </div>
                            @if($record != null)
                            <div class="input-field button">
                                <form id="delete-form" action="{{ url('/delete') }}" method="POST" >
                                    @csrf
                                    <input type="submit" id="delete" value="Delete result" name="submit">
                                </form>
                            </div>

                                    {{--                                    <div class="dashboard-button">--}}
{{--                                    Delete result--}}
{{--                                    <form id="delete-form" action="{{ url('/delete') }}" method="POST" >--}}
{{--                                        @csrf--}}
{{--                                        <input type="submit" value="Delete" name="submit">--}}
{{--                                  --}}
{{--                                </div>--}}
                            @endif
                        </div>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </body>
</html>
