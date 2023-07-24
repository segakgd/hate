<?php

namespace App\Service\Project;

use App\Dto\Project\ProjectDto;
use App\Entity\ProjectEntity;
use App\Entity\User\User;
use App\Mapper\Project\ProjectMapper;
use App\Repository\ProjectEntityRepository;
use Psr\Log\LoggerInterface;
use Throwable;

class ProjectService
{
    public function __construct(
        private readonly ProjectEntityRepository $projectEntityRepository,
        private readonly LoggerInterface $logger,
    ) {
    }

    public function getProjects(User $user): array
    {
        return $user->getProjects()->toArray(); // todo жёсткий костыль
    }

    public function getProject(int $projectId): ?ProjectEntity
    {
        return $this->projectEntityRepository->find($projectId);
    }

    public function addProject(ProjectDto $projectDto, User $user): ProjectEntity
    {
        $projectEntity = ProjectMapper::mapToEntity($projectDto);
        $projectEntity->addUser($user);

        $this->projectEntityRepository->saveAndFlush($projectEntity);

        return $projectEntity;
    }

    public function updateProject(ProjectDto $projectDto, int $projectId): ProjectEntity
    {
        $projectEntity = $this->getProject($projectId);
        $projectEntity = ProjectMapper::mapToExistEntity($projectDto, $projectEntity);

        $this->projectEntityRepository->saveAndFlush($projectEntity);

        return $projectEntity;
    }

    public function removeProject(int $projectId): bool
    {
        $project = $this->getProject($projectId);

        try {
            if ($project){
                $this->projectEntityRepository->removeAndFlush($project);
            }

        } catch (Throwable $exception){
            $this->logger->error($exception->getMessage());

            return false;
        }

        return true;
    }
}
