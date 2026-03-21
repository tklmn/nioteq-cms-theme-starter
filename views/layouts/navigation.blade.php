@php
    $menuPages = \App\Models\Page::whereNull('parent_id')
        ->where('is_active', true)
        ->where('hide_in_menu', false)
        ->orderBy('order')
        ->with(['children' => function($q) {
            $q->where('is_active', true)->where('hide_in_menu', false)->orderBy('order');
        }])
        ->get();
@endphp
<nav class="bg-white dark:bg-gray-900 border-b border-stone-200 dark:border-gray-800 sticky top-0 z-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14">
            {{-- Logo --}}
            <div class="shrink-0 flex items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    @if(theme('logo_url'))
                        <img src="{{ asset(theme('logo_url')) }}" alt="{{ __('translation.app_name') }}" class="h-7">
                    @else
                        <span class="text-lg font-bold text-stone-900 dark:text-white">{{ setting('site_name', __('translation.app_name')) }}</span>
                    @endif
                    @if(theme('tagline'))
                        <span class="hidden sm:inline text-xs text-stone-400 dark:text-gray-500 border-l border-stone-200 dark:border-gray-700 pl-2 ml-1">{{ theme('tagline') }}</span>
                    @endif
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <div class="hidden md:flex md:items-center md:space-x-1 starter-nav">
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
                       class="px-3 py-2 text-sm font-medium transition-colors {{ $isActive ? 'active text-stone-900 dark:text-white' : 'text-stone-500 dark:text-gray-400 hover:text-stone-900 dark:hover:text-white' }}"
                       @if($isExternal && $page->external_url_new_window) target="_blank" rel="noopener noreferrer" @endif>
                        {{ $page->nav_title ?: $page->title }}
                    </a>
                @endforeach
            </div>

            {{-- Right side --}}
            <div class="flex items-center gap-1">
                @if(theme('show_search', true))
                <button type="button" onclick="toggleSearchOverlay()" class="w-8 h-8 inline-flex items-center justify-center rounded text-stone-400 hover:text-stone-700 dark:hover:text-white transition-colors" title="{{ __('translation.search') }}">
                    <i class="bi bi-search"></i>
                </button>
                @endif
                @auth
                    @if(theme('show_profile', true))
                    <a href="{{ route('profile.edit') }}" class="w-8 h-8 inline-flex items-center justify-center rounded text-stone-400 hover:text-stone-700 dark:hover:text-white transition-colors" title="{{ __('translation.profile') }}">
                        <i class="bi bi-person"></i>
                    </a>
                    @endif
                    @if(auth()->user()->hasPermission('access-dashboard'))
                    <a href="{{ route('dashboard') }}" class="w-8 h-8 inline-flex items-center justify-center rounded text-stone-400 hover:text-stone-700 dark:hover:text-white transition-colors" title="{{ __('translation.navigation.dashboard') }}">
                        <i class="bi bi-speedometer2"></i>
                    </a>
                    @endif
                    @if(theme('show_logout', true))
                    <form method="POST" action="{{ route('logout') }}" class="inline-flex">
                        @csrf
                        <button type="submit" class="w-8 h-8 inline-flex items-center justify-center rounded text-stone-400 hover:text-stone-700 dark:hover:text-white transition-colors" title="{{ __('translation.logout') }}">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                    @endif
                @endauth

                {{-- Mobile toggle --}}
                <button id="starter-nav-toggle" onclick="starterNavToggle()" class="md:hidden nav-hamburger p-2 rounded text-stone-500 hover:bg-stone-100 dark:hover:bg-gray-800" aria-expanded="false" aria-controls="starter-mobile-menu" aria-label="Toggle navigation">
                    <span class="nav-hamburger-line"></span>
                    <span class="nav-hamburger-line"></span>
                    <span class="nav-hamburger-line"></span>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div id="starter-mobile-menu" class="nav-mobile-panel md:hidden border-t border-stone-200 dark:border-gray-800" aria-hidden="true">
        <div class="nav-mobile-panel-inner">
            <div class="px-4 py-3 space-y-1">
                @foreach($menuPages as $page)
                    @php
                        $mIsExternal = !empty($page->external_url);
                        $mLinkUrl = $mIsExternal
                            ? $page->external_url
                            : ($page->is_root ? route('home') : route('page.show', $page->slug));
                    @endphp
                    <a href="{{ $mLinkUrl }}" class="block px-3 py-2 rounded text-sm text-stone-700 dark:text-gray-300 hover:bg-stone-100 dark:hover:bg-gray-800"
                       @if($mIsExternal && $page->external_url_new_window) target="_blank" rel="noopener noreferrer" @endif>
                        {{ $page->nav_title ?: $page->title }}
                    </a>
                @endforeach
            </div>
            <div class="px-4 py-3 border-t border-stone-200 dark:border-gray-800">
                @auth
                    @if(theme('show_profile', true))
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded text-sm text-stone-700 dark:text-gray-300 hover:bg-stone-100 dark:hover:bg-gray-800">
                        <i class="bi bi-person mr-2"></i>{{ __('translation.profile') }}
                    </a>
                    @endif
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded text-sm text-stone-700 dark:text-gray-300 hover:bg-stone-100 dark:hover:bg-gray-800">
                        <i class="bi bi-speedometer2 mr-2"></i>{{ __('translation.navigation.dashboard') }}
                    </a>
                    @if(theme('show_logout', true))
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 rounded text-sm text-stone-700 dark:text-gray-300 hover:bg-stone-100 dark:hover:bg-gray-800">
                            <i class="bi bi-box-arrow-right mr-2"></i>{{ __('translation.logout') }}
                        </button>
                    </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded text-sm text-stone-700 dark:text-gray-300 hover:bg-stone-100 dark:hover:bg-gray-800">
                        {{ __('translation.login') }}
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
function starterNavToggle() {
    var menu = document.getElementById('starter-mobile-menu');
    var btn = document.getElementById('starter-nav-toggle');
    var isOpen = menu.classList.contains('is-open');
    menu.classList.toggle('is-open', !isOpen);
    menu.setAttribute('aria-hidden', isOpen ? 'true' : 'false');
    btn.classList.toggle('is-active', !isOpen);
    btn.setAttribute('aria-expanded', !isOpen ? 'true' : 'false');
}
</script>
