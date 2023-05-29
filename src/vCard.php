<?php

namespace Embryo\Vcard;

use DateTimeImmutable;

class vCard
{
    /** @var float $version */
    public $version;

    /** @var string $address */
    public $address; // TODO change to object

    /** @var string $agent */
    public $agent; // TODO change to object

    /** @var DateTimeImmutable $anniversary */
    public  $anniversary;

    /** @var DateTimeImmutable $birthday */
    public $birthday;
}
