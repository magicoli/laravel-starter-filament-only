<?php

namespace App\Filament\Concerns;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\HtmlString;

trait RendersMarkdownFile
{
    /**
     * Parse the markdown file, extract a leading H1 as title, cache both.
     *
     * @return array{title: ?string, html: string}
     */
    protected function getMarkdownData(): array
    {
        $path = base_path(static::$markdownFile);

        if (!file_exists($path)) {
            return ["title" => null, "html" => ""];
        }

        $key = "markdown:" . static::$markdownFile . ":" . filemtime($path);

        return Cache::rememberForever($key, function () use ($path) {
            $raw = file_get_contents($path);
            $title = null;

            // Strip a leading H1 and use it as the page title.
            if (preg_match('/^#[ \t]+(.+)$/m', $raw, $matches)) {
                $title = trim($matches[1]);
                $raw = ltrim(preg_replace('/^#[ \t]+.+\R?/m', "", $raw, 1));
            }

            return [
                "title" => $title,
                "html" => (string) str($raw)->markdown()->sanitizeHtml(),
            ];
        });
    }

    public function getMarkdownContent(): HtmlString
    {
        return new HtmlString($this->getMarkdownData()["html"]);
    }

    public function getHeading(): string
    {
        return $this->getMarkdownData()["title"] ?? parent::getHeading();
    }
}
