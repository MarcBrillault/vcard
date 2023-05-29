<?php

namespace Embryo\Vcard\Elements;

use Embryo\Vcard\vCard;

class Version extends Element
{
    /** @var string */
    const FIELD_NAME = 'VERSION';

    public function getFieldName(): string
    {
        return self::FIELD_NAME;
    }

    /** @var vCard $vcard */
    public function saveLine($vcard, string $line): void
    {
        preg_match('#^VERSION:([0-9]\.[0-9])$#', $line, $matches);
        if (isset($matches[1])) {
            $vcard->version = (float)$matches[1];
        }
    }
}
