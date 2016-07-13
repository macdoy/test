<?php

namespace Potogan\TestBundle\FileUploader;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Acl\Exception\Exception;

class FileUploader
{
    public function upload($dir, $allowed, $user)
    {
        if (!is_dir(__DIR__.$dir)) {
            throw new Exception(__DIR__.$dir."Not found");
        }

        if (null === $user->getFile()) {
            return;
        }

        if (!in_array($user->getExtension(), $allowed)) {
            throw new Exception("Forbiden extension");
        }

        $user->getFile()->move(__DIR__.$dir, $user->getId().'.'.$user->getExtension());
        $info = getimagesize(__DIR__.$dir.'/'.$user->getId().'.'.$user->getExtension());

        if ($info[0] > 420 || $info[1] > 420) {
            unlink(__DIR__.$dir.'/'.$user->getId().'.'.$user->getExtension());
        }
    }
}
