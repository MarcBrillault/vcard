<?php

use Embryo\Vcard\Elements\Name;
use Embryo\Vcard\Fields\Name as FieldsName;
use Embryo\Vcard\vCard;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    /** @var Name */
    private $name;

    /** @var vCard */
    private $vCard;

    public function setUp(): void
    {
        $this->name = new Name();
        $this->vCard = new vCard();
    }

    public function testItLoadsANameWithJustAFirstName(): void
    {
        $this->name->saveLine($this->vCard, 'N;Newton;;;;');

        $this->assertEquals('Newton', $this->vCard->name->getFamilyName());
    }

    public function testItLoadsANameWithMoreCompleteInformation(): void
    {
        $this->name->saveLine($this->vCard, 'N;Newton;Isaac;;Sir;Jr,FRS');
        $expectedName = new FieldsName('Newton', ['Isaac'], [], ['Sir'], ['Jr', 'FRS']);

        $this->assertEquals($expectedName, $this->vCard->name);
    }
}
