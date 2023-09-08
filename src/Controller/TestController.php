<?php

namespace App\Controller;

use App\Entity\User\Project;
use App\Entity\User\User;
use App\Service\Mapper\Main\MainMapperServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    public function __construct(
        private MainMapperServiceInterface $mainMapperService
    ) {
    }

    #[Route('/test/', name: 'test', methods: ['GET'])]
    public function execute(): JsonResponse
    {
        $user = (new User())
            ->setEmail('mail')
            ->setPassword('pass')
        ;

        $project = (new Project())
            ->setName('name project')
            ->addUser($user)
        ;

        $this->mainMapperService->mapToDto($project);

        return new JsonResponse();
    }
}