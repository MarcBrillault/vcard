<?php

namespace Embryo\Vcard\Elements;

use Embryo\Vcard\ValidationException;
use Embryo\Vcard\vCard;

class Version extends Element
{
    const MANAGED_VERSIONS = [2.1];

    public function getFieldName(): string
    {
        return 'VERSION';
    }

    /** @var vCard $vcard */
    public function saveLine($vcard, string $line): void
    {
        preg_match('#^VERSION:([0-9]\.[0-9])$#', $line, $matches);
        if (isset($matches[1])) {
            $vcard->version = (float)$matches[1];
        }
    }

    /**
     * @var VcardVCard $vCard
     * @throws ValidationException
     */
    public function validate($vCard): void
    {
        if (!in_array($vCard->version, self::MANAGED_VERSIONS)) {
            throw new ValidationException(sprintf(
                'Version %f is not managed. Allowed versions are: %s',
                $vCard->version,
                implode(', ', self::MANAGED_VERSIONS)
            ));
        }
    }
}
