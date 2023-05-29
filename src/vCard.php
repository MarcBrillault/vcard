<?php

namespace Embryo\Vcard;

use DateTimeImmutable;
use Embryo\Vcard\Fields\Name;

class vCard
{
    /** @var float $version */
    public $version;

    /** @var Name */
    public $name;

    /** @var string $address */
    public $address; // TODO change to object

    /** @var string $agent */
    public $agent; // TODO change to object

    /** @var DateTimeImmutable $anniversary */
    public  $anniversary;

    /** @var DateTimeImmutable $birthday */
    public $birthday;
}
