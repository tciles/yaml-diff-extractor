<?php

namespace Tciles\YamlDiffExtrator;

interface ExtratorInterface
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
