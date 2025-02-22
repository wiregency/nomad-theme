<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @foreach ($navbar as $element)
                    @if (!$element->isDropdown())
                        <li class="nav-item">
                            <a class="nav-link @if ($element->isCurrent()) active @endif"
                                href="{{ $element->getLink() }}"
                                @if ($element->new_tab) target="_blank" rel="noopener noreferrer" @endif>
                                {{ $element->name }}
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle @if ($element->isCurrent()) active @endif"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $element->name }} <i class="bi bi-chevron-down ms-1"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($element->elements as $childElement)
                                    <li>
                                        <a class="dropdown-item @if ($childElement->isCurrent()) active @endif"
                                            href="{{ $childElement->getLink() }}"
                                            @if ($childElement->new_tab) target="_blank" rel="noopener noreferrer" @endif>
                                            {{ $childElement->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>

            <div class="ms-auto d-flex align-items-center">
                @auth
                    <div class="d-flex align-items-center">
                        <div class="dropdown">
                            <div class="d-flex align-items-center dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false" data-bs-auto-close="outside">
                                <img src="https://minotar.net/avatar/{{ Auth::user()->name }}" alt="Player Avatar"
                                    class="nav-avatar" width="32" height="32">
                                <span class="text-white ms-2 fw-bold">{{ Auth::user()->name }}</span>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        {{ trans('messages.nav.profile') }}
                                    </a>
                                </li>
                                @foreach (plugins()->getUserNavItems() ?? [] as $navId => $navItem)
                                    <li>
                                        <a class="dropdown-item" href="{{ route($navItem['route']) }}">
                                            {{ trans($navItem['name']) }}
                                        </a>
                                    </li>
                                @endforeach
                                @if (Auth::user()->hasAdminAccess())
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            {{ trans('messages.nav.admin') }}
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ trans('auth.logout') }}
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                        <div class="notification-bell ms-1">
                            @include('elements.notifications')
                        </div>
                    </div>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="btn auth-button me-2">{{ trans('auth.register') }}</a>
                        @endif
                        <a href="{{ route('login') }}" class="btn auth-button me-3">{{ trans('auth.login') }}</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
<section class="hero-section"
    style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7)), url('{{ setting('background') ? image_url(setting('background')) : '' }}'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="hero-content">
        <div class="container text-center">
            <img src="{{ site_logo() }}" alt="{{ site_name() }}" class="hero-logo">
        </div>
    </div>
    <div class="hero-curve"></div>
</section>
