<?php

namespace App\Mapper\Project;

use App\Dto\Project\ProjectDto;
use App\Entity\User\Project;

class ProjectMapper
{
    public static function mapToDto(Project $projectEntity): ProjectDto
    {
        return (new ProjectDto)
            ->setName($projectEntity->getName())
        ;
    }

    public static function mapToEntity(ProjectDto $projectDto): Project
    {
        return (new Project)
            ->setName($projectDto->getName())
        ;
    }

    public static function mapToExistDto(Project $projectEntity, ProjectDto $projectDto): ProjectDto
    {
        $projectDto
            ->setName($projectEntity->getName())
        ;

        return $projectDto;
    }

    public static function mapToExistEntity(ProjectDto $projectDto, Project $projectEntity): Project
    {
        $projectEntity
            ->setName($projectDto->getName())
        ;

        return $projectEntity;
    }
}
