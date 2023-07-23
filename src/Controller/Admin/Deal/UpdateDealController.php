<?php

namespace App\Controller\Admin\Deal;

use App\Dto\Ecommerce\DealDto;
use App\Service\Ecommerce\DealServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateDealController extends AbstractController
{
    public function __construct(
        private readonly DealServiceInterface $dealService,
        private readonly ValidatorInterface $validator,
        private readonly SerializerInterface $serializer
    ) {
    }

    #[Route('/api/admin/project/{project}/deal/{dealId}/', name: 'deal_update', methods: ['PUT'])]
    public function execute(Request $request, int $project, int $dealId): JsonResponse
    {
        // todo нужно искать project
        $content = $request->getContent();
        $dealDto = $this->serializer->deserialize($content, DealDto::class, 'json');

        $errors = $this->validator->validate($dealDto);

        if (count($errors) > 0) {
            return $this->json(['message' => $errors->get(0)->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        $dealEntity = $this->dealService->updateDeal($dealDto, $dealId);

        return new JsonResponse(
            $this->serializer->normalize(
                $dealEntity,
                null,
                ['groups' => 'administrator']
            )
        );
    }
}
