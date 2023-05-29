<?php

namespace Embryo\Vcard\Elements;

use App\vCard;
use Embryo\Vcard\ValidationException;
use Embryo\Vcard\vCard as VcardVCard;

interface ElementsInterface
{
    public function getFieldName(): string;
    public function managesLine(string $line): bool;
    /**
     * @var vCard $vCard
     * */
    public function saveLine($vCard, string $line): void;

    /**
     * @var VcardVCard $vCard
     * @throws ValidationException
     */
    public function validate($vCard): void;
}
