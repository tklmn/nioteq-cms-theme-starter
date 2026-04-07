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

    @php
        $isFullWidth = ($page->template ?? 'container') === 'full_width';
        $isBlocks = ($page->content_type ?? 'html') === 'blocks' && !empty($page->blocks);
        $isHome = $page->is_root ?? false;
        $showBreadcrumbs = theme('show_breadcrumbs', true) && !$isHome;
        $showTitle = theme('show_page_title', true);

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

    <x-slot name="header">
        @if($showBreadcrumbs)
            <div class="s-breadcrumb">
                <a href="{{ route('home') }}" class="s-no"><i class="bi bi-house-door"></i></a>
                @foreach($ancestors as $ancestor)
                    <span class="sep">/</span>
                    <a href="{{ $ancestor->is_root ? route('home') : route('page.show', $ancestor->slug) }}" class="s-no">{{ $ancestor->nav_title ?? $ancestor->title }}</a>
                @endforeach
                <span class="sep">/</span>
                <span class="current">{{ $page->nav_title ?? $page->title }}</span>
            </div>
        @endif
        <h1 style="font-size:1.5rem;font-weight:700;color:var(--text-primary);letter-spacing:-0.02em;"
            @if($page->aria_label) aria-label="{{ $page->aria_label }}" @endif>
            {{ $page->title }}
        </h1>
        @if($page->subtitle)
            <p style="color:var(--text-muted);margin-top:0.375rem;">{{ $page->subtitle }}</p>
        @endif
    </x-slot>

    @if($page->header_image)
        <x-slot name="headerImage">{{ $page->header_image }}</x-slot>
    @endif

    @if($isBlocks)
        <div class="page-blocks">
            {!! app(\App\Services\BlockRenderer::class)->render($page->blocks) !!}
        </div>
    @else
        <div class="prose max-w-none">
            {!! \App\Helpers\HtmlHelper::clean($page->content) !!}
        </div>
    @endif

</x-frontend-app-layout>
