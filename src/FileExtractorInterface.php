<?php

namespace Tciles\YamlDiffExtractor;

interface FileExtractorInterface
{
    /**
     * @param string $source
     * @param string $extra
     * @param string $destination
     *
     * @return array
     */
    public static function extractFiles(string $source, string $extra, string $destination = 'output.yaml'): array;
}
