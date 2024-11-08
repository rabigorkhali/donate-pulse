<header id="header" class="header">
    <div
        class="header-nav navbar-fixed-top header-dark navbar-white navbar-transparent bg-transparent-1 navbar-sticky-animated animated-active">
        <div class="header-nav-wrapper">
            <div class="container">
                <nav id="menuzord-right" class="menuzord default no-bg">
                    <a class="menuzord-brand pull-left flip" href="{{ url('/') }}"><img
                            src="{{ asset(getConfigTableData()->logo) }}" alt=""></a>
                    <ul class="menuzord-menu">
                        <li class="{{ frontendActiveButton('fontendDefaultPage') }}"><a
                                href="{{ route('fontendDefaultPage') }}">Home</a></li>
                        <li class=""><a href="{{ route('campaigns.create') }}">Raise Fund</a></li>
                        <li class="{{ frontendActiveButton('campaignList') }}">
                            <a href="{{ route('campaignList') }}">Donate</a>
                        </li>
                        <li><a href="#">Learn More</a>
                            <ul class="dropdown">
                                <li class="{{ frontendActiveButton('postList') }}"><a
                                        href="{{ route('postList') }}">Blogs</a>
                                </li>
                                <li class="{{ frontendActiveButton('frontendPage') }}"><a
                                        href="{{ route('frontendPage', 'how-it-works') }}">How it works?</a>
                                </li>
                                <li class="{{ frontendActiveButton('frontendPage') }}"><a
                                        href="{{ route('frontendPage', 'faq') }}">FAQ</a>
                                </li>
                            </ul>
                        </li>
                        @if (Auth::user())
                            <li><a href="#">My Account (Hi,
                                    {{ explode(' ', Auth::user()->full_name)[0] ?? '-' }})</a>
                                <ul class="dropdown">
                                    <li class="{{ frontendActiveButton('dashboard') }}"><a
                                            href="{{ route('dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="{{ frontendActiveButton('logout') }}"><a
                                            href="{{ route('logout') }}">Logout</a>
                                    </li>

                                </ul>
                            </li>
                        @endif

                        @if (!Auth::user())
                            <li class="{{ frontendActiveButton('login') }}"><a
                                    href="{{ route('login') }}">Login/Create Account</a>
                            </li>
                        @endif

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
