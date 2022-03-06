<?php

namespace Tciles\YamlDiffExtrator;

use SplFileInfo;

interface ExtratorInterface
{
    /**
     * @param SplFileInfo[] $files
     * @return array
     */
    public function extract(iterable $files = []): array;
}
