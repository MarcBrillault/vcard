<?php

use Embryo\Vcard\VCFManager;
use PHPUnit\Framework\TestCase;

final class VCFManagerTest extends TestCase
{
    public function testItLoadsAVCFFile(): void
    {
        $file = __DIR__ . '/vcf_files/2.1.vcf';
        $manager = new VCFManager($file);
        $vCards = $manager->export();
        $this->assertIsArray($vCards);
        $this->assertCount(1, $vCards);
        $this->assertEquals(2.1, $vCards[0]->version);
    }

    public function testItLoadsAString(): void
    {
        $file = __DIR__ . '/vcf_files/2.1.vcf';
        $contents = file_get_contents($file);
        $manager = new VCFManager($contents);
        $vCards = $manager->export();
        $this->assertIsArray($vCards);
        $this->assertCount(1, $vCards);
        $this->assertEquals(2.1, $vCards[0]->version);
    }

    public function testItFailsWhenFilepathIsIncorrect(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Cannot load file unknown.vcf");

        $file = 'unknown.vcf';
        new VCFManager($file);
    }
}
