<?php

use Embryo\Vcard\Elements\Version;
use Embryo\Vcard\ValidationException;
use Embryo\Vcard\vCard;
use PHPUnit\Framework\TestCase;

final class VersionTest extends TestCase
{
    /** @var Version */
    private  $version;

    /** @var vCard */
    private  $vCard;

    public function setUp()
    {
        $this->version = new Version();
        $this->vCard = new vCard();
    }

    public function testALineIsManagedWhenBeginningByVersion(): void
    {
        $result = $this->version->managesLine('VERSION:whatever');
        $this->assertTrue($result);
    }

    public function testALineIsNotManagedWhenItDoesNotBeginWithVersion(): void
    {
        $result = $this->version->managesLine('NOTAVERSION:whatever');
        $this->assertFalse($result);
    }

    /** @dataProvider sourceProvider */
    public function testVersionIsSetOrNotDependingOnTheSource(string $version, bool $shouldSucceed): void
    {
        $line = sprintf('VERSION:%s', $version);
        $this->version->saveLine($this->vCard, $line);

        if ($shouldSucceed) {
            $this->assertEquals((float)$version, $this->vCard->version);
        } else {
            $this->assertNull($this->vCard->version);
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

    public function testItValidatesWithAManagedVersion(): void
    {
        $this->version->saveLine($this->vCard, 'VERSION:2.1');
        $this->version->validate($this->vCard);

        $this->assertEquals(2.1, $this->vCard->version);
    }

    public function testItDoesNotValidateWithAnUnmanagedVersion(): void
    {
        $this->expectException(ValidationException::class);

        $this->version->saveLine($this->vCard, 'version:0.0');
        $this->version->validate($this->vCard);
    }
}
