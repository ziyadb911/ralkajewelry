<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.meta')
    @yield('head')
</head>

<body>
    <!-- Sidebar Menu -->
    <div class="ui vertical inverted sidebar accordion menu submenuadmin left">
        @include('admin.layouts.menu')
    </div>

    <div class='pusher'>
        <div class='ui fixed menu'>
            <div class='container'>
                <a class="toc item">
                    <i class="sidebar icon"></i>
                </a>
                <div class='right menu'>
                    <a class="item" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class='sign out icon'></i>Logout</a>
                </div>
            </div>
        </div>
        <div class='full height'>
            <div class='tocc'>
                <div class='ui vertical inverted sticky accordion menu submenuadmin' style="">
                    @include('admin.layouts.menu')
                </div>
            </div>
            <div class='article'>
                <div class='ui container'>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @yield('additional')

    <div class="ui small basic modal" id='messagemodal'>
        <div class="ui icon header">
            <i class="info icon" id='iconinfo'></i>
            <span id='modalinfo'>Info</span>
        </div>
        <div class="actions">
            <button type='button' class="ui green ok inverted button" id='btnOkMessage'>
                <i class="checkmark icon"></i>
                Ok
            </button>
        </div>
    </div>

    @yield('footer')

    @include('admin.layouts.script')
</body>

</html>
