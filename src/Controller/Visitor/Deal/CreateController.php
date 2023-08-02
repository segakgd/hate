<?php

namespace App\Controller\Visitor\Deal;

use App\Dto\Ecommerce\DealDto;
use App\Dto\Ecommerce\PromotionDto;
use App\Entity\ProjectEntity;
use App\Service\Ecommerce\DealServiceInterface;
use App\Service\Ecommerce\PromotionServiceInterface;
use App\Service\Project\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateController extends AbstractController
{
    public function __construct(
        private readonly ValidatorInterface $validator,
        private readonly SerializerInterface $serializer,
        private readonly DealServiceInterface $dealService,
    ) {
    }

    #[Route('/visitor/project/{project}/deal/', name: 'visitor_deal_create', methods: ['POST'])]
    public function execute(Request $request, ProjectEntity $project): JsonResponse
    {
        $content = $request->getContent();
        $dealDto = $this->serializer->deserialize($content, DealDto::class, 'json');

        $errors = $this->validator->validate($dealDto);

        if (count($errors) > 0) {
            return $this->json(['message' => $errors->get(0)->getMessage()], Response::HTTP_BAD_REQUEST);
        }

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
