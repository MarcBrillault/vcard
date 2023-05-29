<?php

namespace Embryo\Vcard\Elements;

use Embryo\Vcard\Fields\Name as FieldsName;
use Embryo\Vcard\ValidationException;
use Embryo\Vcard\vCard;

class Name extends Element
{
    public function getFieldName(): string
    {
        return 'N';
    }

    /**
     * @var vCard $vCard
     */
    public function saveLine($vCard, string $line): void
    {
        list(, $familyName, $firstNames, $otherNames, $titles, $suffixes) = explode(';', $line);
        $vCard->name = new FieldsName(
            $familyName,
            array_filter(explode(',', $firstNames)),
            array_filter(explode(',', $otherNames)),
            array_filter(explode(',', $titles)),
            array_filter(explode(',', $suffixes))
        );
    }

    /**
     * @var vCard $vCard
     * @throws ValidationException
     */
    public function validate($vCard): void
    {
    }
}
