<?php

namespace App\Controller\Admin;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @throws Exception
     */
    #[Route('/admin/', name: 'admin', methods: ['GET'])]
    public function addWebhookAction(): JsonResponse
    {
        return new JsonResponse(
            ['isAdmin' => $this->getUser() ?? '']
        );
    }
}
