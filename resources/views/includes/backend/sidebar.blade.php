       
        <div class="container-sidebar">
            <a class="navbar-brand brand-logo-mini align-center" href="#" style="background-color: #fff;
            width: 100%;
            text-align: center;">
                <img src="{{ url('assets/images/kominfo-2.png') }}" alt="logo" style="height: 55px;"> </a>
<div class="userlogin p-2 mb-2" style="background-color:#ffffff; border-radius:4px;">
    <div class="row">
        <div class="col-md-9">
           <p class="font-weight-normal text-muted mb-0">Hallo, <span class="font-weight-bold">{{ Auth::user()->name }}</span></p>
            <small class="fst-italic">{{ Auth::user()->email }} |  {{ Auth::user()->roles }} </small>
        </div>
        <div class="col-md-3">
                   <form action="{{ url('logout') }}" method="post" class="mt-1">
                    @csrf
                    <button class="btn btn-sm" type="submit">
                        <span
                        class="iconify" data-icon="fa:sign-out" data-width="20"
                        data-height="20" style="vertical-align: bottom;
                        "></span>
                    </button>
                </form>
        </div>
    </div>
        </div>
            <nav>
                    <ul class="mcd-menu">
                        <li>
                            <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                                <span class="iconify icon-menu" data-icon="material-symbols:dashboard" data-width="20" data-height="20"></span>
                                <strong>Dashboard</strong>
                                <small>Map & resume</small>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dataset')}}" class="{{ request()->is('dataset*') ? 'active' : '' }}">
                                <span class="iconify icon-menu" data-icon="carbon:data-volume" data-width="20" data-height="20"></span>
                                <strong>Dataset</strong>
                                <small>Create Data & Table</small>
                            </a>
                        </li>
                        {{-- @if (Auth::user()->roles == 'ADMIN')
                        <li>
                            <a href="#" class="{{ request()->is('content*') ? 'active' : '' }}">
                                <span class="iconify icon-menu" data-icon="fluent:content-settings-24-regular" data-width="20" data-height="20"></span>
                                <strong>Content Management</strong>
                                <small>Configuration 6extual content</small>
                            </a>
                        </li> --}}
                        @if (Auth::user()->roles == 'SUPER USER')
                        <li>
                            <a href="{{ route('user-management') }}" class="{{ request()->is('user*') ? 'active' : '' }}">
                                <span class="iconify icon-menu" data-icon="fa-solid:user-cog" data-width="20" data-height="20"></span>
                                <strong>User Management</strong>
                                <small>configuration all user</small>
                            </a>
                        </li>                 
                        @else
                        @endif
                        <li>
                            <a href="">
                                <span class="iconify icon-menu" data-icon="bx:file" data-width="20" data-height="20"></span>
                                <strong>User Guide</strong>
                                <small>How to use sigap-fbb</small>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('privacy') }}" class="{{ request()->is('privacy') ? 'active' : '' }}">
                                <span class="iconify icon-menu" data-icon="ic:baseline-privacy-tip" data-width="20" data-height="20"></span>
                                <strong>Privacy Policy</strong>
                                <small>-</small>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('toc') }}" class="{{ request()->is('toc') ? 'active' : '' }}">
                                <span class="iconify icon-menu" data-icon="carbon:rule-filled" data-width="20" data-height="20"></span>
                                <strong>Term & Condition</strong>
                                <small>-</small>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>