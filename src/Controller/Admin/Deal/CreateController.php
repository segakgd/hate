<?php

namespace App\Controller\Admin\Deal;

use App\Dto\Ecommerce\DealDto;
use App\Entity\User\Project;
use App\Service\Ecommerce\Deal\DealServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateController extends AbstractController
{
    public function __construct(
        private DealServiceInterface $dealService,
        private ValidatorInterface $validator,
        private SerializerInterface $serializer
    ) {
    }

    #[Route('/api/admin/project/{project}/deal/', name: 'admin_deal_create', methods: ['POST'])]
//    #[IsGranted('existUser', 'project')]
    public function execute(Request $request, Project $project): JsonResponse
    {
        $content = $request->getContent();
        $dealDto = $this->serializer->deserialize($content, DealDto::class, 'json');

        $errors = $this->validator->validate($dealDto);

        if (count($errors) > 0) {
            return $this->json(['message' => $errors->get(0)->getMessage()], Response::HTTP_BAD_REQUEST);
        }

//        dd($dealDto);

        $dealEntity = $this->dealService->add($dealDto, $project->getId());

        return new JsonResponse(
            $this->serializer->normalize(
                $dealEntity,
                null,
                ['groups' => 'administrator']
            )
        );
    }
}
