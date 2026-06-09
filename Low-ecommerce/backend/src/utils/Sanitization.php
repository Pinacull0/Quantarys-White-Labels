<?php

declare(strict_types=1);

namespace LowEcommerce\Utils;

final class Sanitization
{
    /**
     * @param mixed $value
     * @return mixed
     */
    public static function sanitizeValue(mixed $value): mixed
    {
        if (is_string($value)) {
            return self::sanitizeString($value);
        }

        if (is_array($value)) {
            return array_map(
                static fn (mixed $item): mixed => self::sanitizeValue($item),
                $value
            );
        }

        return $value;
    }

    public static function sanitizeString(string $value): string
    {
        $withoutTags = strip_tags($value);
        $withoutControlChars = preg_replace('/[\x00-\x1F\x7F]/u', '', $withoutTags) ?? '';
        $withoutExtraSpaces = preg_replace('/\s+/u', ' ', $withoutControlChars) ?? '';

        return trim($withoutExtraSpaces);
    }

    /**
     * @param mixed $payload
     * @return array<string, mixed>
     */
    public static function sanitizeCreateProductPayload(mixed $payload): array
    {
        $sanitizedPayload = self::sanitizeValue($payload);

        if (!is_array($sanitizedPayload)) {
            return [];
        }

        return $sanitizedPayload;
    }
}
