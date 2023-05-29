<?php

namespace Embryo\Vcard\Elements;

use App\vCard;

interface ElementsInterface
{
    public function getFieldName(): string;
    public function managesLine(string $line): bool;
    /** @var vCard $vcard */
    public function saveLine($vcard, string $line): void;
}
