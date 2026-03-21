<footer class="border-t border-stone-200 dark:border-gray-800 bg-white dark:bg-gray-900">
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-xs text-stone-400 dark:text-gray-500">
            {{ theme('footer_text', setting('site_name', __('translation.app_name')) . ' — ' . theme('tagline', 'Built with Nioteq CMS')) }}
        </p>
    </div>
</footer>
