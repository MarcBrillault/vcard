<?php

namespace Embryo\Vcard;

use Embryo\Vcard\Elements\Address;
use Embryo\Vcard\Elements\ElementsInterface;
use Embryo\Vcard\Elements\Version;
use InvalidArgumentException;

class VCFManager
{
    /** @var string */
    private $vcf;

    /** @var ElementsInterface[] */
    private $elements = [];

    public function __construct(string $data)
    {
        if (substr($data, -4) === '.vcf') {
            if (!file_exists($data)) {
                throw new InvalidArgumentException(sprintf('Cannot load file %s', $data));
            }
            $this->vcf = file_get_contents($data);
        } else {
            // $data is not a path to a .vcf file, we assume it's the file contents
            $this->vcf = $data;
        }

        $this->manageElements();
    }

    private function manageElements(): void
    {
        $this->elements = [
            Version::class
        ];
    }


    // /** @return []vCard */
    public function export(): array
    {
        $vCards = [];
        $vCardsData = $this->splitVcards();
        foreach ($vCardsData as $vCardData) {
            $vCard = new vCard();
            $lines = explode(PHP_EOL, $vCardData);
            foreach ($lines as $line) {
                foreach ($this->elements as $element) {
                    /** @var ElementsInterface $elementClass */
                    $elementClass = new $element;
                    if ($elementClass->managesLine($line)) {
                        $elementClass->saveLine($vCard, $line);
                    }
                }
            }

            $vCards[] = $vCard;
        }

        return $vCards;
    }

    /** @return []string */
    private function splitVcards(): array
    {
        $vCards = explode('BEGIN:VCARD', $this->vcf);
        return array_filter($vCards);
    }
}
