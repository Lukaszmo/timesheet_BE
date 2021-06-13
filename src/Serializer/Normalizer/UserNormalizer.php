<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use App\Repository\RolesRepository;

class UserNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer, RolesRepository $roleRep)
    {
        $this->normalizer = $normalizer;
        $this->roleRep = $roleRep;
    }

    public function normalize($object, $format = null, array $context = array()): array
    {
        
        $data = $this->normalizer->normalize($object, $format, $context);
            
        // Here: add, edit, or delete some data
        $roles = $object->getRoles();
        $data['userRoles'] = [];
        
        foreach ($roles as $value) {
            $role = $this->roleRep->findOneBy(array('code' => $value));
            
            $arr = [];
            $arr['role'] = $value;
            $arr['roleId'] = $role->getId();
            
            array_push($data['userRoles'], $arr);
        }
        
        return $data;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof \App\Entity\User;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
