<?php

namespace App\Controller\Webhook;

use App\Entity\Action;
use App\Repository\ActionRepository;
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
        private readonly ActionRepository $actionRepository,
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

        $webhookData = $this->serializer->decode($request->getContent(), 'json');

        $actionDecoded = $this->actionDecodeHandler->findAndDecodeActionByTypeWebhook($type, $webhookData);

        if (!$actionDecoded){
            return new JsonResponse('Action data not found', 400);
        }

        $action = (new Action())
            ->setType($actionDecoded['type'])
            ->setChatId($actionDecoded['chatId'])
            ->setContent($actionDecoded['content'])
        ;

        $this->actionRepository->saveAndFlush($action);

        return new JsonResponse();
    }
}
