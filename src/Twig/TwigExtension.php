<?php

namespace Survos\PwaExtraBundle\Twig;

use Survos\PwaExtraBundle\Service\PwaService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    public function __construct(private PwaService $pwaService)
    {
    }

    public function getFunctions(): array
    {
        return [
            // route => #[PwaExtra(cacheStrategy: ...)] mapping, for the "Survos" tab
            // grafted onto spomky-labs/pwa-bundle's own profiler panel (see
            // templates/bundles/SpomkyLabsPwaBundle/Collector/template.html.twig
            // in the consuming app).
            new TwigFunction('survos_pwa_route_cache', [$this->pwaService, 'getRouteCache']),
        ];
    }
}
