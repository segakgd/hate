<?php

namespace App\Service\Scenario;

use App\Entity\BehaviorScenario;
use App\Repository\BehaviorScenarioRepository;

class BehaviorScenarioService
{
    public function __construct(
        private readonly BehaviorScenarioRepository $behaviorScenarioRepository,
    ) {
    }

    public function getScenarioByNameAndType(string $type, string $name): ?BehaviorScenario
    {
        return $this->behaviorScenarioRepository->findOneBy(
            [
                'type' => $type,
                'name' => $name,
            ]
        );
    }

    public function getScenarioByOwnerId(int $ownerBehaviorScenarioId): ?BehaviorScenario
    {
        return $this->behaviorScenarioRepository->findOneBy(
            [
                'ownerStepId' => $ownerBehaviorScenarioId,
            ]
        );
    }

    public function generateDefaultScenario(): BehaviorScenario
    {
        $behaviorScenario = (new BehaviorScenario)
            ->setName('default')
            ->setType('message')
            ->setContent(
                [
                    'message' => 'Не понимаю что вы хотите, выберите одну из доступных комманд',
                ]
            )
        ;

        $this->behaviorScenarioRepository->save($behaviorScenario);

        return $behaviorScenario;
    }
}
