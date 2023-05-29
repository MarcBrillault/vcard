<?php

namespace Embryo\Vcard\Validator;

use Embryo\Vcard\vCard;

class Validator
{
    /** @var vCard $vcard */
    private $vCard;

    const ALLOWED_VERSIONS = [1.2, 3.0, 4.0];

    public function __construct(vCard $vCard)
    {
        $this->vCard = $vCard;
    }

    public function validate(): void
    {
        $this->validateVersion();
    }

    private function validateVersion(): void
    {
        if (!in_array($this->vCard, self::ALLOWED_VERSIONS)) {
            throw new ValidatorError(sprintf(
                'Version %f is not allowed. Allowed versions are: %s',
                $this->vCard->version,
                implode(', ', self::ALLOWED_VERSIONS)
            ));
        }
    }
}
