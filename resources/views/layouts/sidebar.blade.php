<div class="area"></div><nav class="main-menu">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2 rounded mx-auto d-block" alt="User Image">
        </div>
    </div>
    <ul>
{{--        @php--}}
{{--            $testingAdmin = \Illuminate\Support\Facades\DB::table('role')--}}
{{--                           ->select('id')--}}
{{--                           ->where(\Illuminate\Support\Str::upper('nama_role'),'ADMIN')->first();--}}
{{--            $admin = $testingAdmin->id;--}}

{{--        @endphp--}}

        <li>
            <a href="home">
                <i class="fa fa-home fa-2x"></i>
                <span class="nav-text">
                            Dashboard
                        </span>
            </a>

        </li>
{{--        @if(Auth::user()->role == $admin)--}}
        <li class="has-subnav">
            <a href="{{route('role-index')}}" >
                <i class="fa fa-globe fa-2x"></i>
                <span class="nav-text">
                            Role
                        </span>
            </a>
        </li>
        <li>
            <a href="{{route('user-index')}}">
                <i class="fa fa-film fa-2x"></i>
                <span class="nav-text">
                            User
                        </span>
            </a>
        </li>
{{--        @endif--}}
{{--        @php--}}
{{--            $testingProdi = \Illuminate\Support\Facades\DB::table('role')--}}
{{--                           ->select('id')--}}
{{--                           ->where(\Illuminate\Support\Str::upper('nama_role'),'PRODI')->first();--}}
{{--            $prodi = $testingProdi->id;--}}

{{--        @endphp--}}

{{--    @if(Auth::user()->role == $prodi)--}}
            <li class="has-subnav">
                <a href="{{route('kurikulum-index')}}">
                    <i class="fa fa-camera-retro fa-2x"></i>
                    <span class="nav-text">
                                Kurikulum
                            </span>
                </a>
            </li>
            <li class="has-subnav">
                <a href="{{route('mk-index')}}" class="nav-link">
                    <i class="fa fa-comments fa-2x"></i>
                    <span class="nav-text">
                                Mata Kuliah
                            </span>
                </a>
            </li>
            <li>
                <a href="{{route('pole-index')}}">
                    <i class="fa fa-clock fa-2x"></i>
                    <span class="nav-text">
                               Waktu Pole
                            </span>
                </a>
            </li>

            <li>
                <a href="{{route('poleDetailProdi-index')}}">
                    <i class="fa fa-book fa-2x"></i>
                    <span class="nav-text">
                           Hasil Pole
                    </span>
                </a>
            </li>
{{--        @endif--}}
{{--        @php--}}
{{--            $testingUser = \Illuminate\Support\Facades\DB::table('role')--}}
{{--                           ->select('id')--}}
{{--                           ->where(\Illuminate\Support\Str::upper('nama_role'),'USER')->first();--}}
{{--            $user = $testingUser->id;--}}

{{--        @endphp--}}
{{--        @if(Auth::user()->role == $user)--}}
        <li>
            <a href="{{route('poleDetail-index')}}">
                <i class="fa fa-cogs fa-2x"></i>
                <span class="nav-text">
                            Pemilihan
                        </span>
            </a>
        </li>
{{--        @endif--}}
    </ul>
</nav>