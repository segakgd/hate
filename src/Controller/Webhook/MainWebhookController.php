<?php

namespace App\Controller\Webhook;

use App\Repository\ChatEventRepository;
use App\Service\Webhook\ActionDecodeHandler;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MainWebhookController extends AbstractController
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly ChatEventRepository $chatEventRepository,
        private readonly ActionDecodeHandler $actionDecodeHandler,
    ) {
    }

    /**
     * @throws Exception
     */
    #[Route('/webhook/{type}/{id}/', name: 'app_webhook', methods: ['POST'])]
    public function addWebhookAction(Request $request, string $type, int $id): JsonResponse
    {
//        todo обрабатывать заранее через слушатели (тогда когда будет userWebhookRepository):
//        $this->userWebhookRepository->findBy(
//            [
//                'id' => $id,
//                'type' => $type
//            ]
//        );

        // step -> chatSession


        // -------------- decode ----------------
        $webhookData = $this->serializer->decode($request->getContent(), 'json');
        $actionDecoded = $this->actionDecodeHandler->findAndDecodeActionByTypeWebhook($type, $webhookData);
        // -------------- decode ----------------


        // this block check exist action(event)\step
        if (!$actionDecoded){
            return new JsonResponse('Action data not found', 400);
        }

        // todo add check in step db
        // this block check exist action(event)\step


        $this->chatEventRepository->createAction($actionDecoded);

        return new JsonResponse();
    }
}
