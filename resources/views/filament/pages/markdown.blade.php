<x-filament-panels::page>
    @vite('resources/css/markdown.css')
    <div class="markdown-content">
        {!! $this->getMarkdownContent() !!}
    </div>
</x-filament-panels::page>
