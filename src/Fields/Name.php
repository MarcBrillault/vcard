<?php

namespace Embryo\Vcard\Fields;

class Name
{
    /** @var string */
    private $familyName;

    /** @var []string */
    private $firstNames;

    /** @var []string */
    private $otherNames;

    /** @var []string */
    private $titles;

    /** @var []string */
    private $suffixes;

    public function __construct(
        string $familyName,
        array $firstNames,
        array $otherNames,
        array $titles,
        array $suffixes
    ) {
        $this->familyName = $familyName;
        $this->firstNames = $firstNames;
        $this->otherNames = $otherNames;
        $this->titles = $titles;
        $this->suffixes = $suffixes;
    }

    public function getFamilyName(): string
    {
        return $this->familyName;
    }

    public function getFirstNames(): array
    {
        return $this->firstNames;
    }

    public function getFirstName(): ?string
    {
        if (count($this->firstNames) > 0) {
            return $this->firstNames[0];
        }

        return null;
    }

    public function getOtherNames(): array
    {
        return $this->otherNames;
    }

    public function getOtherName(): ?string
    {
        if (count($this->otherNames) > 0) {
            return $this->otherNames[0];
        }

        return null;
    }

    public function getTitles(): array
    {
        return $this->titles;
    }

    public function getTitle(): ?string
    {
        if (count($this->titles) > 0) {
            return $this->titles[0];
        }

        return null;
    }

    public function getSuffixes(): array
    {
        return $this->suffixes;
    }

    public function getSuffix(): ?string
    {
        if (count($this->suffixes) > 0) {
            return $this->suffixes[0];
        }

        return null;
    }
}
