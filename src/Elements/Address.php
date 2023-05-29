<?php

namespace Embryo\Vcard\Elements;

use Embryo\Vcard\Elements\Element;
use Embryo\Vcard\ValidationException;
use Embryo\Vcard\vCard;

class Address extends Element
{
    public function getFieldName(): string
    {
        return 'ADR';
    }

    /**
     * @var vCard $vcard
     */
    public function saveLine($vcard, string $line): void
    {
    }

    /**
     * @var vCard $vCard
     * @throws ValidationException
     */
    public function validate($vCard): void
    {
    }
}
