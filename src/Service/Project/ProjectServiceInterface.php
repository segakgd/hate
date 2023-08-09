<?php

namespace App\Service\Project;

use App\Dto\Project\ProjectDto;
use App\Entity\ProjectEntity;
use App\Entity\User\User;

interface ProjectServiceInterface
{
    public function getAll(User $user): array;

    public function getOne(int $projectId): ?ProjectEntity;

    public function add(ProjectDto $projectDto, User $user): ProjectEntity;

    public function update(ProjectDto $projectDto, int $projectId): ProjectEntity;

    public function remove(int $projectId): bool;

    public function isExist(int $id): bool;
}
