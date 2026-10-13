<?php

declare(strict_types=1);

namespace Survos\PwaExtraBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PwaExtraController extends AbstractController
{
    public function __construct(
        private array $config = [])
    {
    }

    #[Route('/icon/{size}', name: 'command_list')]
    public function icon($size = 512): Response
    {
        return $this->redirectToRoute('app_homepage');
    }
}
