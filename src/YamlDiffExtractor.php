<?php

namespace Tciles\YamlDiffExtractor;

use Symfony\Component\Yaml\Yaml;

class YamlDiffExtractor implements FileExtractorInterface
{
    public const DEFAULT_INLINE_FROM = 16;

    /**
     * @inheritDoc
     */
    public static function extractFiles(
        string $source,
        string $extra,
        string $destination = 'output.yaml'
    ): array {
        $sourceValues = Yaml::parseFile($source);
        $extraValues = Yaml::parseFile($extra);

        $diff = [];
        self::compareArrayValues($sourceValues, $extraValues, $diff);
        self::compareArrayValues($extraValues, $sourceValues, $diff);

        unset($sourceValues, $extraValues);

        $result = Yaml::dump($diff, self::DEFAULT_INLINE_FROM);
        file_put_contents($destination, $result);

        unset($result);

        return $diff;
    }

    /**
     * @param array $arrayOne
     * @param array $arrayTwo
     * @param array $diff
     */
    private static function compareArrayValues(array $arrayOne, array $arrayTwo, array &$diff = [])
    {
        foreach ($arrayOne as $key => $val) {
            if (!isset($arrayTwo[$key])) {
                $diff[$key] = $val;
                continue;
            }

            if (is_array($val) && (json_encode($val) !== json_encode($arrayTwo[$key]))) {
                if (!isset($diff[$key])) {
                    $diff[$key] = [];
                }

                self::compareArrayValues($val, $arrayTwo[$key], $diff[$key]);
                continue;
            }

            if ($val !== $arrayTwo[$key]) {
                $diff[$key] = $val;
            }
        }
    }
}