<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Utilisateur;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserSetter implements ProcessorInterface
{
    public function __construct(private readonly ProcessorInterface $processor,
                                private readonly TokenStorageInterface $storage)
    {
    }

    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $data->setUtilisateur($this->storage->getToken()->getUser());
        $this->processor->process($data, $operation, $uriVariables, $context);
    }

}