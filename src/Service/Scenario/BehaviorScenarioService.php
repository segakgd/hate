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
}