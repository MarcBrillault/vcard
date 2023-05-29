<?php

use Embryo\Vcard\Elements\Version;
use Embryo\Vcard\vCard;
use PHPUnit\Framework\TestCase;

final class VersionTest extends TestCase
{
    public function testALineIsManagedWhenBeginningByVersion(): void
    {
        $element = new Version();
        $result = $element->managesLine('VERSION:whatever');
        $this->assertTrue($result);
    }

    public function testALineIsNotManagedWhenItDoesNotBeginWithVersion(): void
    {
        $element = new Version();
        $result = $element->managesLine('NOTAVERSION:whatever');
        $this->assertFalse($result);
    }

    /** @dataProvider sourceProvider */
    public function testVersionIsSetOrNotDependingOnTheSource(string $version, bool $shouldSucceed): void
    {
        $element = new Version();
        $vCard = new vCard();

        $line = sprintf('VERSION:%s', $version);
        $element->saveLine($vCard, $line);

        if ($shouldSucceed) {
            $this->assertEquals((float)$version, $vCard->version);
        } else {
            $this->assertNull($vCard->version);
        }
    }

    public function sourceProvider(): Generator
    {
        yield 'A float with one digit before and after the point should succeed' => ['3.2', true];
        yield 'A float with two digits before the point should fail' => ['30.2', false];
        yield 'A float with two digits after the points should fail' => ['3.14', false];
        yield 'An integer should fail' => ['3', false];
        yield 'A string should fail' => ['NaN', false];
    }
}
