<?php

namespace App\Controller\Admin\Product;

use App\Entity\Ecommerce\ProductCategoryEntity;
use App\Entity\Ecommerce\ProductEntity;
use App\Service\Ecommerce\ProductServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

class AddController extends AbstractController
{
    public function __construct(
        private readonly ProductServiceInterface $productService,
        private readonly SerializerInterface $serializer
    ) {
    }

    #[Route(
        '/api/admin/project/{project}/product/{product}/category/{productCategory}/',
        name: 'admin_product_add_in_category',
        methods: ['POST'])
    ]
    #[IsGranted('existUser', 'project')]
    public function execute(
        ProductEntity $product,
        ProductCategoryEntity $productCategory
    ): JsonResponse {
        $productEntity = $this->productService->addInCategory($product, $productCategory);

        return new JsonResponse(
            $this->serializer->normalize(
                $productEntity,
                null,
                ['groups' => 'administrator']
            )
        );
    }
}
