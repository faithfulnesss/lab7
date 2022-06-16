<div class="header">
    <div class="logo">
        <a href="{{ url('/') }}">
            <div id="icon_with_text">
                <img class="icon" src="{{asset('svg_icon.svg')}}">
                </img>
                <div class="text"><span>
                    Typing Test
                  </span>
                </div>
            </div>
        </a>
        <div class="menu">
            <div class="menu_button kb_button">
                <i class="fa-solid fa-keyboard"></i>
            </div>
            <div class="menu_button settings_button">
                <a href="{{ url('user') }}">
                <i class="fa-solid fa-user"></i>
                </a>
            </div>
            <div class="menu_button leaderboard_button">
                <a href="{{ url('leaderboard') }}">
                <i class="fa-solid fa-trophy"></i>
                </a>
            </div>
        </div>
    </div>
</div>
