<?php

namespace Tciles\YamlDiffExtrator;

use SplFileInfo;
use Symfony\Component\Yaml\Yaml;

class YamlDiffExtractor implements ExtratorInterface
{
    /**
     * @inheritDoc
     */
    public function extract(iterable $files = []): array
    {
        try {
            $result = array_map(static function (SplFileInfo $splFileInfo) {
                return Yaml::parseFile($splFileInfo->getPathname());
            }, $files);
        } catch (\Throwable $e) {
            $result = [];
        }

        return $result;
    }
}