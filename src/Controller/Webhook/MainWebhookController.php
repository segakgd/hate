<?php

namespace App\Controller\Webhook;

use App\Dto\TelegramWebhookDto;
use App\Entity\ChatEvent;
use App\Entity\ChatSession;
use App\Repository\ChatEventRepository;
use App\Repository\ChatSessionRepository;
use App\Service\Scenario\BehaviorScenarioService;
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
        private readonly ChatSessionRepository $chatSessionRepository,
        private readonly BehaviorScenarioService $behaviorScenarioService,
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

        // -------------- decode telegram message ----------------
        $webhookData = $this->serializer->deserialize(
            $request->getContent(),
            TelegramWebhookDto::class,
            'json'
        );
        // от dto я хочу получить:
        // быстрый доступ к пониманию типа.
        // быстрый доступ к контенту.

        dd(
            $webhookData,
            $webhookData->getWebhookType(),
            $webhookData->getWebhookContent(),
        );

//        dd($webhookData->getMessage()->getChat());
        $chatSession = $this->chatSessionRepository->getSessionByChatMessage(
            $webhookData->getMessage()->getChat()['id'], // todo
            'telegram'
        );

        if (!$chatSession){
            $chatSession = (new ChatSession())
                ->setChatId($webhookData->getMessage()->getChat()['id'])
                ->setChannel('telegram')
            ;

            $this->chatSessionRepository->save($chatSession);
        }

        if ($webhookData->getMessage()->isCommand()){
            $type = 'command';
        } elseif ($webhookData->getMessage()->isMessage()){
            $type = 'message';
        } else {
            throw new Exception('Хз что пришло...');
        }

        $chatEventId = $chatSession->getChatEvent();

        if (!$chatEventId){
            $scenario = $this->behaviorScenarioService->getScenarioByNameAndType($type, $webhookData->getWebhookContent());

            $chatEvent = (new ChatEvent())
                ->setType($type)
                ->setBehaviorScenario($scenario->getId())
            ;

            $this->chatEventRepository->saveAndFlush($chatEvent);

            $this->chatSessionRepository->save($chatSession->setChatEvent(
                $chatEvent->getId()
            ));
        } else {
            $chatEvent = $this->chatEventRepository->find($chatEventId);

            if ($this->isMandatoryEvent()){
                throw new Exception('Хз что пришло...');
            }
        }

        return new JsonResponse();
    }

    public function isMandatoryEvent(): bool
    {
        // todo игнорировать команды

        return false;
    }
}
