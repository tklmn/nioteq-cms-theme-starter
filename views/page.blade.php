<x-frontend-app-layout>
    <x-slot name="title">{{ $page->meta_title ?? $page->title }}</x-slot>
    <x-slot name="template">{{ $page->template ?? 'container' }}</x-slot>
    <x-slot name="meta">
        @if ($page->meta_description)<meta name="description" content="{{ $page->meta_description }}">@endif
        @if ($page->meta_robots)<meta name="robots" content="{{ $page->meta_robots }}">@endif
        @if ($page->canonical_url)<link rel="canonical" href="{{ $page->canonical_url }}">@endif
        @if ($page->og_title)<meta property="og:title" content="{{ $page->og_title }}">@endif
        @if ($page->og_description)<meta property="og:description" content="{{ $page->og_description }}">@endif
        @if ($page->og_image)<meta property="og:image" content="{{ $page->og_image }}">@endif
        @if ($page->extra_css)<style>{!! \App\Helpers\HtmlHelper::cleanCss($page->extra_css) !!}</style>@endif
    </x-slot>

    <x-slot name="header">
        <h1 class="text-xl font-semibold text-stone-800 dark:text-gray-200"
            @if($page->aria_label) aria-label="{{ $page->aria_label }}" @endif>
            {{ $page->title }}
        </h1>
        @if($page->subtitle)
            <p class="text-sm text-stone-500 dark:text-gray-400">{{ $page->subtitle }}</p>
        @endif
    </x-slot>

    @if($page->header_image)
        <x-slot name="headerImage">{{ $page->header_image }}</x-slot>
    @endif

    @php
        $isFullWidth = ($page->template ?? 'container') === 'full_width';
        $isBlocks = ($page->content_type ?? 'html') === 'blocks' && !empty($page->blocks);
        $isHome = $page->is_root ?? false;
        $showBreadcrumbs = theme('show_breadcrumbs', true) && !$isHome;

        $ancestors = collect([]);
        if ($showBreadcrumbs) {
            $parent = $page->parent;
            $root = \App\Models\Page::where('is_root', true)->first();
            $rootId = $root ? $root->id : null;
            while ($parent) {
                if ($rootId && $parent->id == $rootId) { $parent = $parent->parent; continue; }
                $ancestors->prepend($parent);
                $parent = $parent->parent;
            }
        }
    @endphp

    @if($showBreadcrumbs)
        <nav aria-label="Breadcrumb" class="mb-6">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="{{ route('home') }}" class="text-stone-400 hover:text-stone-700 dark:hover:text-white transition-colors"><i class="bi bi-house"></i></a></li>
                @foreach($ancestors as $ancestor)
                    <li class="flex items-center space-x-2">
                        <i class="bi bi-chevron-right text-stone-300 dark:text-gray-600 text-xs"></i>
                        <a href="{{ $ancestor->is_root ? route('home') : route('page.show', $ancestor->slug) }}" class="text-stone-400 hover:text-stone-700 dark:hover:text-white transition-colors">{{ $ancestor->nav_title ?? $ancestor->title }}</a>
                    </li>
                @endforeach
                <li class="flex items-center space-x-2">
                    <i class="bi bi-chevron-right text-stone-300 dark:text-gray-600 text-xs"></i>
                    <span class="text-stone-600 dark:text-gray-300 font-medium">{{ $page->nav_title ?? $page->title }}</span>
                </li>
            </ol>
        </nav>
    @endif

    @if($isBlocks)
        <div class="page-blocks">
            {!! app(\App\Services\BlockRenderer::class)->render($page->blocks) !!}
        </div>
    @else
        <div class="prose prose-stone dark:prose-invert max-w-none">
            {!! \App\Helpers\HtmlHelper::clean($page->content) !!}
        </div>
    @endif

    @if(count($page->children->where('is_active', true)->where('hide_in_menu', false)) > 0)
        <div class="mt-12">
            <h2 class="text-xl font-bold text-stone-900 dark:text-white mb-4">{{ __('translation.pages.subpages') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($page->children->where('is_active', true)->where('hide_in_menu', false) as $childPage)
                    <a href="{{ $childPage->is_root ? route('home') : route('page.show', $childPage->slug) }}" class="block p-4 rounded-lg border border-stone-200 dark:border-gray-800 hover:border-stone-300 dark:hover:border-gray-700 transition-colors">
                        <h3 class="font-semibold text-stone-900 dark:text-white">{{ $childPage->nav_title ?? $childPage->title }}</h3>
                        @if($childPage->meta_description)
                            <p class="text-sm text-stone-500 dark:text-gray-400 mt-1 line-clamp-2">{{ $childPage->meta_description }}</p>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</x-frontend-app-layout>
