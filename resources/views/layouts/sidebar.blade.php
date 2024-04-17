<div class="area"></div><nav class="main-menu">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">Jangan Lupa diganti</a>
            {{--                {{Auth::user()->name}}--}}
        </div>
    </div>
    <ul>
        <li>
            <a href="https://jbfarrow.com">
                <i class="fa fa-home fa-2x"></i>
                <span class="nav-text">
                            Dashboard
                        </span>
            </a>

        </li>
        <li class="has-subnav">
            <a href="role" >
                <i class="fa fa-globe fa-2x"></i>
                <span class="nav-text">
                            Role
                        </span>
            </a>

        </li>
        <li class="has-subnav">
            <a href="mk" class="nav-link">
                <i class="fa fa-comments fa-2x"></i>
                <span class="nav-text">
                            Mata Kuliah
                        </span>
            </a>

        </li>
        <li class="has-subnav">
            <a href="kurikulum">
                <i class="fa fa-camera-retro fa-2x"></i>
                <span class="nav-text">
                            Kurikulum
                        </span>
            </a>

        </li>
        <li>
            <a href="user">
                <i class="fa fa-film fa-2x"></i>
                <span class="nav-text">
                            User
                        </span>
            </a>
        </li>
        <li>
            <a href="pole">
                <i class="fa fa-book fa-2x"></i>
                <span class="nav-text">
                           Waktu Pole
                        </span>
            </a>
        </li>
        <li>
            <a href="poleDetail">
                <i class="fa fa-cogs fa-2x"></i>
                <span class="nav-text">
                            Pemilihan
                        </span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-map-marker fa-2x"></i>
                <span class="nav-text">
                            Member Map
                        </span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-info fa-2x"></i>
                <span class="nav-text">
                            Documentation
                        </span>
            </a>
        </li>
    </ul>

    <ul class="logout">
        <li>
            <a href="logout">
                <i class="fa fa-power-off fa-2x"></i>
                <span class="nav-text">
                            Logout
                        </span>
            </a>
        </li>
    </ul>
</nav>