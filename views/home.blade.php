<x-frontend-app-layout>
    <x-slot name="template">{{ $page->template ?? 'container' }}</x-slot>

    <div class="py-8 text-center">
        <h1 class="text-3xl font-bold text-stone-900 dark:text-white mb-2">
            {{ setting('site_name', __('translation.app_name')) }}
        </h1>
        @if(theme('tagline'))
            <p class="text-stone-500 dark:text-gray-400 mb-8">{{ theme('tagline') }}</p>
        @endif

        <div class="flex justify-center gap-3 mb-12">
            @auth
                <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-5 py-2.5 rounded text-sm font-medium text-white starter-accent-bg hover:opacity-90 transition-opacity">
                    <i class="bi bi-speedometer2 mr-2"></i> Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center px-5 py-2.5 rounded text-sm font-medium text-white starter-accent-bg hover:opacity-90 transition-opacity">
                    <i class="bi bi-box-arrow-in-right mr-2"></i> {{ __('translation.auth.login') }}
                </a>
            @endauth
        </div>
    </div>

    @php
        $isBlocks = ($page->content_type ?? 'html') === 'blocks' && !empty($page->blocks);
    @endphp
    @if($isBlocks)
        <div class="page-blocks">
            {!! app(\App\Services\BlockRenderer::class)->render($page->blocks) !!}
        </div>
    @elseif($page->content)
        <div class="prose prose-stone dark:prose-invert max-w-none">
            {!! \App\Helpers\HtmlHelper::clean($page->content) !!}
        </div>
    @endif
</x-frontend-app-layout>
