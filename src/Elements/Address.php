<?php

namespace Embryo\Vcard\Elements;

use Embryo\Vcard\Elements\Element;

class Address extends Element
{
    /** @var string */
    const FIELD_NAME = 'ADR';

    public function getFieldName(): string
    {
        return self::FIELD_NAME;
    }

    public function saveLine($vcard, string $line): void
    {
    }
}
