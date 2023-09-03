<?php

namespace App\Mapper\Project;

use App\Dto\Project\ProjectDto;
use App\Entity\User\Project;

class ProjectMapper
{
    public static function mapToDto(Project $projectEntity): ProjectDto
    {
        return self::mapToExistDto($projectEntity, (new ProjectDto));
    }

    public static function mapToEntity(ProjectDto $projectDto): Project
    {
        return self::mapToExistEntity($projectDto, (new Project));
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
