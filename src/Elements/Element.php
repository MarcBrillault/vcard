<?php

namespace Embryo\Vcard\Elements;

abstract class Element implements ElementsInterface
{
    public function managesLine(string $line): bool
    {
        $data = explode(':', $line);
        return $data[0] === $this->getFieldName();
    }
}
