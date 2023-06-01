<?php

namespace App\Controller\Webhook;

use App\Entity\Action;
use App\Repository\ActionRepository;
use App\Service\ActionVoter;
use App\UserSetting;
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
        private readonly ActionVoter $actionVoter,
    ) {
    }

    /**
     * @throws Exception
     */
    #[Route('/webhook/', name: 'app_webhook', methods: ['POST'])]
    public function addWebhookAction(Request $request): JsonResponse
    {
        $arrayWebhookData = $this->serializer->decode($request->getContent(), 'json');

        $webhookType = $this->actionVoter->getType($arrayWebhookData);

        $action = (new Action())
            ->setType($webhookType['type'])
            ->setChatId($webhookType['chatId'])
            ->setContent($webhookType['content'])
        ;

        $this->actionRepository->saveAndFlush($action);

        return new JsonResponse();
    }
}
