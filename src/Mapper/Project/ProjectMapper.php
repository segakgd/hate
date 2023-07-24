<?php

namespace App\Mapper\Project;

use App\Dto\Project\ProjectDto;
use App\Entity\ProjectEntity;

class ProjectMapper
{
    public static function mapToDto(ProjectEntity $projectEntity): ProjectDto
    {
        return (new ProjectDto)
            ->setName($projectEntity->getName())
        ;
    }

    public static function mapToEntity(ProjectDto $projectDto): ProjectEntity
    {
        return (new ProjectEntity)
            ->setName($projectDto->getName())
        ;
    }

    public static function mapToExistDto(ProjectEntity $projectEntity, ProjectDto $projectDto): ProjectDto
    {
        $projectDto
            ->setName($projectEntity->getName())
        ;

        return $projectDto;
    }

    public static function mapToExistEntity(ProjectDto $projectDto, ProjectEntity $projectEntity): ProjectEntity
    {
        $projectEntity
            ->setName($projectDto->getName())
        ;

        return $projectEntity;
    }
}
