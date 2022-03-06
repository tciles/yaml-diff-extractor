<?php

declare(strict_types=1);

namespace Tciles\YamlDiffExtractor;

interface FileExtractorInterface
{
    /**
     * @param string $source            Path of the first file to compare.
     * @param string $extra             Path of the second file to compare.
     * @param string|null $destination  Path of the diff output file (null for no dump).
     *
     * @return array                    Array of differences.
     */
    public static function extractFiles(string $source, string $extra, ?string $destination = null): array;
}
