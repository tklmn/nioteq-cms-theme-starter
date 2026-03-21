<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ \App\Helpers\ThemeHelper::getTheme() === 'dark' ? ' dark' : '' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title . ' - ' . setting('site_name', __('translation.app_name')) : setting('site_name', __('translation.app_name')) }}</title>

        <link rel="icon" type="image/svg+xml" href="{{ asset(setting('favicon', 'images/favicon.svg')) }}">

        @isset($meta)
            {{ $meta }}
        @endisset

        <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
        @vite(['resources/scss/frontend/app.scss', 'resources/js/frontend/app.js'])

        <style>
            .starter-accent { color: {{ theme('accent_color', '#d97706') }}; }
            .starter-accent-bg { background-color: {{ theme('accent_color', '#d97706') }}; }
            .starter-accent-border { border-color: {{ theme('accent_color', '#d97706') }}; }
            .starter-nav a.active { border-bottom: 2px solid {{ theme('accent_color', '#d97706') }}; }
        </style>
        @if(theme_custom_css())
            <style id="theme-custom-css">{!! theme_custom_css() !!}</style>
        @endif
    </head>
    <body class="font-sans antialiased dark:text-gray-100">
        <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:z-50 focus:p-4 focus:bg-white focus:text-amber-600">
            {{ __('Skip to main content') }}
        </a>
        <div class="min-h-screen bg-stone-50 dark:bg-gray-950">
            @include('theme::layouts.navigation')

            @isset($header)
                @if(theme('show_page_title', true))
                <header class="border-b border-stone-200 dark:border-gray-800">
                    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                        {{ $header }}
                    </div>
                </header>
                @endif
            @endisset

            @isset($headerImage)
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <img src="{{ asset($headerImage) }}" alt="" class="w-full h-56 object-cover rounded-lg">
                </div>
            @endisset

            <main id="main-content" class="min-h-[75vh]">
                <div class="{{ ((string)($template ?? 'container')) === 'full_width' ? '' : 'max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8' }}">
                    {{ $slot }}
                </div>
            </main>

            @include('theme::layouts.footer')
        </div>
        @include('frontend.partials.search-overlay')
    </body>
</html>
