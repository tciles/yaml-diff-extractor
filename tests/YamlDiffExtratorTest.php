<?php

namespace Tciles\Tests\YamlDiffExtrator;

use PHPUnit\Framework\TestCase;
use Tciles\YamlDiffExtrator\YamlDiffExtractor;

/**
 * @group main
 */
class YamlDiffExtratorTest extends TestCase
{
    /**
     * Test extractFiles.
     */
    public function testExtractFiles(): void
    {
        $diff = YamlDiffExtractor::extractFiles(
            __DIR__ . '/examples/one.yaml',
            __DIR__ . '/examples/two.yaml',
            __DIR__ . '/diff.yaml'
        );

        $this->assertNotEmpty($diff);
        $this->assertArrayHasKey('message', $diff);
    }
}