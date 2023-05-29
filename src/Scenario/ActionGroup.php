<?php

namespace App\Scenario;

class ActionGroup
{
    private string $clusterId;

    private string $name;

    /**  @var Action[] */
    private array $actions;

    public function getClusterId(): string
    {
        return $this->clusterId;
    }

    public function setClusterId(string $clusterId): self
    {
        $this->clusterId = $clusterId;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param Action[] $actions
     */
    public function setActions(array $actions): self
    {
        $this->actions = $actions;

        return $this;
    }

    public function addActions(Action $action): self
    {
        $this->actions[] = $action;

        return $this;
    }

    /**
     * @return array<Action>
     */
    public function getActions(): array
    {
        return $this->actions;
    }
}
