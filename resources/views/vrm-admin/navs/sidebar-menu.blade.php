<li>
    <a href='{{ url('vrm-dashboard') }}' class="waves-effect">
        <i class="mdi mdi-airplay"></i>
        <span>Dashboard</span>
    </a>
</li>

<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="mdi mdi-server-network"></i>
        <span>Setup(s)</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        <li><a href='{{ url('setup-status') }}'>Status</a></li>
        <li><a href='{{ url('setup-country') }}'>Countries</a></li>
    </ul>
</li>

<li>
    <a href='{{ url('vrm-logout') }}' class="waves-effect sks-color-red">
        <i class="mdi mdi-login-variant sks-color-red"></i>
        <span>Logout</span>
    </a>
</li>
