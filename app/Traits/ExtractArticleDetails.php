<?php

namespace App\Traits;

trait ExtractArticleDetails
{
    public function getTitle(string $title): ?string
    {
        if (preg_match('/<h1[^>]*>(.*?)<\/h1>/is', $title, $matches)) {
            return trim(strip_tags($matches[1]));
        }

        return null;
    }

    public function getDescription(string $description): ?string
    {
        if (preg_match('/<h2>(.*?)<\/h2>/is', $description, $matches)) {
            return trim(strip_tags($matches[1]));
        }

        return null;
    }
}
