<?php

namespace App\Controller\Admin\ProductCategory;

use App\Dto\Ecommerce\ProductCategoryDto;
use App\Entity\ProjectEntity;
use App\Service\Ecommerce\ProductCategoryServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateController extends AbstractController
{
    public function __construct(
        private readonly ProductCategoryServiceInterface $productCategoryService,
        private readonly ValidatorInterface $validator,
        private readonly SerializerInterface $serializer
    ) {
    }

    #[Route('/api/admin/project/{project}/productCategory/{productCategoryId}/', name: 'product_category_update', methods: ['PUT'])]
    #[IsGranted('existUser', 'project')]
    public function execute(Request $request, ProjectEntity $project, int $productCategoryId): JsonResponse
    {
        $content = $request->getContent();
        $productCategoryDto = $this->serializer->deserialize($content, ProductCategoryDto::class, 'json');

        $errors = $this->validator->validate($productCategoryDto);

        if (count($errors) > 0) {
            return $this->json(['message' => $errors->get(0)->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        $productCategoryEntity = $this->productCategoryService->update($productCategoryDto, $project->getId(), $productCategoryId);

        return new JsonResponse(
            $this->serializer->normalize(
                $productCategoryEntity,
                null,
                ['groups' => 'administrator']
            )
        );
    }
}
