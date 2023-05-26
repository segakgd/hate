<?php

namespace App\Controller;

use App\Dto\Message\MessageDto;
use App\Dto\Webhook\WebhookDto;
use App\Form\Type\Message\SendTestMessageType;
use App\Form\Type\Webhook\AddWebhookType;
use App\Service\TelegramService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainBoardController extends AbstractController
{
    private const TOKEN_BOT = '5109953245:AAE7TIhplLRxJdGmM27YSeSIdJdOh4ZXVVY';

    public function __construct(
        private readonly TelegramService $telegramService,
    ){
    }

    #[Route('/', name: 'app_main_board')]
    public function index(Request $request): Response
    {
        $formSendTestMessage = $this->createForm(SendTestMessageType::class);
        $formSendTestMessage->handleRequest($request);

        $formAddWebhook = $this->createForm(AddWebhookType::class);
        $formAddWebhook->handleRequest($request);

        if ($formSendTestMessage->isSubmitted() && $formSendTestMessage->isValid()) {
            $data = $formSendTestMessage->getData();

            $messageDto = (new MessageDto())
                ->setChatId($data['chatId'])
                ->setText($data['message'])
            ;

            $this->telegramService->sendMessage($messageDto, self::TOKEN_BOT);

            return $this->redirectToRoute('app_main_board');
        }

        if ($formAddWebhook->isSubmitted() && $formAddWebhook->isValid()) {
            $data = $formAddWebhook->getData();

            $webhookDto = (new WebhookDto())
                ->setUrl($data['webhookUri'])
            ;

            $this->telegramService->setWebhook($webhookDto, self::TOKEN_BOT);

            return $this->redirectToRoute('app_main_board');
        }

        return $this->render('main_board/index.html.twig', [
            'formSendTestMessage' => $formSendTestMessage,
            'formAddWebhook' => $formAddWebhook,
        ]);
    }
}
