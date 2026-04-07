<nav class="s-nav">
    <div class="max-w-6xl mx-auto px-6 sm:px-8">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <a href="{{ url('/') }}" class="s-no flex items-center gap-3 shrink-0" style="text-decoration:none;">
                @if(theme('logo_url'))
                    <img src="{{ asset(theme('logo_url')) }}" alt="{{ __('translation.app_name') }}" class="h-7">
                @else
                    <span style="font-size:1.125rem;font-weight:700;color:var(--text-primary);letter-spacing:-0.02em;">{{ setting('site_name', __('translation.app_name')) }}</span>
                @endif
                @if(theme('tagline'))
                    <span class="hidden sm:block" style="font-size:0.75rem;color:var(--text-muted);border-left:1px solid var(--border);padding-left:0.75rem;">{{ theme('tagline') }}</span>
                @endif
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden md:flex items-center gap-1">
                @foreach($menuPages as $page)
                    @php
                        $isExternal = !empty($page->external_url);
                        $linkUrl = $isExternal
                            ? $page->external_url
                            : ($page->is_root ? route('home') : route('page.show', $page->slug));
                        $isActive = !$isExternal && (
                            ($page->is_root && request()->is('/')) ||
                            request()->is($page->slug) || request()->is($page->slug . '/*')
                        );
                    @endphp
                    <a href="{{ $linkUrl }}"
                       class="s-nav-link s-no {{ $isActive ? 'active' : '' }}"
                       @if($isExternal && $page->external_url_new_window) target="_blank" rel="noopener noreferrer" @endif>
                        {{ $page->nav_title ?: $page->title }}
                    </a>
                @endforeach

                <div style="width:1px;height:1.25rem;background:var(--border);margin:0 0.5rem;"></div>

                @if(theme('show_search', true))
                    <button type="button" onclick="toggleSearchOverlay()" class="s-icon-btn" title="{{ __('translation.search') }}"><i class="bi bi-search" style="font-size:0.875rem;"></i></button>
                @endif
                @auth
                    @if(theme('show_profile', true))
                        <a href="{{ route('profile.edit') }}" class="s-icon-btn s-no" title="{{ __('translation.profile') }}"><i class="bi bi-person" style="font-size:1rem;"></i></a>
                    @endif
                    @if(auth()->user()->hasPermission('access-dashboard'))
                        <a href="{{ route('dashboard') }}" class="s-icon-btn s-no" title="{{ __('translation.navigation.dashboard') }}"><i class="bi bi-speedometer2" style="font-size:0.875rem;"></i></a>
                    @endif
                    @if(theme('show_logout', true))
                        <form method="POST" action="{{ route('logout') }}" class="inline-flex"><@csrf><button type="submit" class="s-icon-btn" title="{{ __('translation.logout') }}"><i class="bi bi-box-arrow-right" style="font-size:0.875rem;"></i></button></form>
                    @endif
                @endauth
            </div>

            {{-- Mobile toggle --}}
            <button id="starter-nav-toggle" onclick="starterNavToggle()" class="md:hidden nav-hamburger s-icon-btn" aria-expanded="false" aria-controls="starter-mobile-menu" aria-label="Toggle navigation">
                <span class="nav-hamburger-line"></span>
                <span class="nav-hamburger-line"></span>
                <span class="nav-hamburger-line"></span>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div id="starter-mobile-menu" class="nav-mobile-panel md:hidden" aria-hidden="true">
        <div class="nav-mobile-panel-inner">
            <div class="px-6 py-4 space-y-1">
                @foreach($menuPages as $page)
                    @php
                        $mIsExternal = !empty($page->external_url);
                        $mLinkUrl = $mIsExternal ? $page->external_url : ($page->is_root ? route('home') : route('page.show', $page->slug));
                    @endphp
                    <a href="{{ $mLinkUrl }}" class="s-no block px-3 py-2.5 rounded-lg text-sm" style="color:var(--text-secondary);transition:background 0.15s;"
                       onmouseover="this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.background='transparent'"
                       @if($mIsExternal && $page->external_url_new_window) target="_blank" @endif>
                        {{ $page->nav_title ?: $page->title }}
                    </a>
                @endforeach
            </div>
            <div class="px-6 py-4" style="border-top:1px solid var(--border);">
                @auth
                    @if(theme('show_profile', true))
                        <a href="{{ route('profile.edit') }}" class="s-no block px-3 py-2.5 rounded-lg text-sm" style="color:var(--text-secondary);">
                            <i class="bi bi-person mr-2"></i>{{ __('translation.profile') }}
                        </a>
                    @endif
                    <a href="{{ route('dashboard') }}" class="s-no block px-3 py-2.5 rounded-lg text-sm" style="color:var(--text-secondary);">
                        <i class="bi bi-speedometer2 mr-2"></i>{{ __('translation.navigation.dashboard') }}
                    </a>
                    @if(theme('show_logout', true))
                        <form method="POST" action="{{ route('logout') }}">@csrf
                            <button type="submit" class="w-full text-left px-3 py-2.5 rounded-lg text-sm" style="color:var(--text-secondary);">
                                <i class="bi bi-box-arrow-right mr-2"></i>{{ __('translation.logout') }}
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="s-no block px-3 py-2.5 rounded-lg text-sm" style="color:var(--text-secondary);">
                        <i class="bi bi-box-arrow-in-right mr-2"></i>{{ __('translation.login') }}
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
function starterNavToggle(){var m=document.getElementById('starter-mobile-menu'),b=document.getElementById('starter-nav-toggle'),o=m.classList.contains('is-open');m.classList.toggle('is-open',!o);m.setAttribute('aria-hidden',o?'true':'false');b.classList.toggle('is-active',!o);b.setAttribute('aria-expanded',!o?'true':'false');}
</script>
