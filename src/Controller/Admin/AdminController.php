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
    public function admin(): JsonResponse
    {
        return new JsonResponse(
            ['isAdmin' => $this->getUser() ?? '']
        );
    }

    /**
     * @throws Exception
     */
    #[Route('/api/hi/', name: 'api_hi', methods: ['GET'])]
    public function apiHi(): JsonResponse
    {
        return new JsonResponse(
            ['isAdmin' => $this->getUser() ?? '']
        );
    }
}
