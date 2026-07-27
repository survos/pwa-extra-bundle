<?php

namespace Survos\PwaExtraBundle\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(name: 'ConnectionDetector', template:'@SurvosPwaExtra/components/ConnectionDetector.html.twig')]
final class ConnectionDetector
{
    public function __construct(
        public string $stimulusController='@survos/pwa-extra/detector')
    {

    }

    #[PreMount()]
    public function mount(): never
    {
        throw new \LogicException('The <twig:ConnectionDetector> component has been removed. Use the @spomky-labs/pwa-bundle/connection-status Stimulus controller instead.');
    }

}
