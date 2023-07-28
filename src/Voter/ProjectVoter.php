<?php

namespace App\Voter;

use App\Entity\ProjectEntity;
use App\Entity\User\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ProjectVoter extends Voter
{
    const EXIST_USER_PERMISSION = 'existUser';

    protected function supports(string $attribute, mixed $subject): bool
    {
        if ($attribute != self::EXIST_USER_PERMISSION) {
            return false;
        }

        if (!$subject instanceof ProjectEntity) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        /** @var ProjectEntity $project */
        $project = $subject;

        return match($attribute) {
            self::EXIST_USER_PERMISSION => $this->isUserExistInProject($project, $user),
            default => throw new \LogicException('Access error')
        };
    }

    /**
     * У пользователя есть права к проекту
     */
    private function isUserExistInProject(ProjectEntity $project, User $user): bool
    {
        return $project->getUsers()->exists(
            function ($key, $projectUser) use ($user) {
                return $projectUser->getId() === $user->getId();
            }
        );
    }
}