<?php

declare(strict_types=1);

namespace Tciles\YamlDiffExtractor;

use Symfony\Component\Yaml\Yaml;

class YamlDiffExtractor implements FileExtractorInterface
{
    public const DEFAULT_INLINE_FROM = 16;
    public const DEFAULT_INDENT = 4;

    /**
     * @inheritDoc
     */
    public static function extractFiles(
        string $source,
        string $extra,
        ?string $destination = null
    ): array {
        $sourceValues = Yaml::parseFile($source);
        $extraValues = Yaml::parseFile($extra);

        $diff = [];
        self::compareArrayValues($sourceValues, $extraValues, $diff);
        self::compareArrayValues($extraValues, $sourceValues, $diff);

        unset($sourceValues, $extraValues);

        if (!empty($destination)) {
            $result = Yaml::dump($diff, self::DEFAULT_INLINE_FROM, self::DEFAULT_INDENT);
            file_put_contents($destination, $result);
            unset($result);
        }

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

            if (is_array($val) &&
                self::getHash($val) !== self::getHash($arrayTwo[$key])
            ) {
                if (!isset($diff[$key])) {
                    $diff[$key] = [];
                }

                self::compareArrayValues($val, $arrayTwo[$key], $diff[$key]);
                continue;
            }

            if ($val === $arrayTwo[$key]) {
                continue;
            }

            $diff[$key] = $val;
        }
    }

    /**
     * @param array $values
     * @return string
     */
    private static function getHash(array $values): string
    {
        return md5(serialize($values));
    }
}