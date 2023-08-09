<?php

namespace App\Service\Project;

use App\Dto\Project\ProjectDto;
use App\Entity\ProjectEntity;
use App\Entity\User\User;
use App\Mapper\Project\ProjectMapper;
use App\Repository\ProjectEntityRepository;
use Psr\Log\LoggerInterface;
use Throwable;

class ProjectService implements ProjectServiceInterface
{
    public function __construct(
        private readonly ProjectEntityRepository $projectEntityRepository,
        private readonly LoggerInterface $logger,
    ) {
    }

    public function getAll(User $user): array
    {
        return $user->getProjects()->toArray(); // todo жёсткий костыль
    }

    public function getOne(int $projectId): ?ProjectEntity
    {
        return $this->projectEntityRepository->find($projectId);
    }

    public function add(ProjectDto $projectDto, User $user): ProjectEntity
    {
        $projectEntity = ProjectMapper::mapToEntity($projectDto);
        $projectEntity->addUser($user);

        $this->projectEntityRepository->saveAndFlush($projectEntity);

        return $projectEntity;
    }

    public function update(ProjectDto $projectDto, int $projectId): ProjectEntity
    {
        $projectEntity = $this->getOne($projectId);
        $projectEntity = ProjectMapper::mapToExistEntity($projectDto, $projectEntity);

        $this->projectEntityRepository->saveAndFlush($projectEntity);

        return $projectEntity;
    }

    public function remove(int $projectId): bool
    {
        $project = $this->getOne($projectId);

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

    public function isExist(int $id): bool
    {
        return (bool) $this->projectEntityRepository->find($id);
    }
}
