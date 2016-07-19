<?php

namespace Potogan\TestBundle\FileUploader;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Exception;

class FileUploader
{
    protected $dir;
    protected $allowed;

    public function __construct($dir, $allowed)
    {
        if (!is_dir($dir)) {
            throw new Exception($dir." Not found");
        }
        $this->dir = $dir;
        $this->allowed = $allowed;
    }

    public function getDir()
    {
      return $this->dir;
    }

    public function getAllowed()
    {
      return $this->allowed;
    }

    public function upload($dir, $allowed, $user)
    {
        if (null === $user->getFile()) {
            return;
        }

        $user->getFile()->move($dir, $user->getId().'.'.$user->getExtension());
        $info = getimagesize($dir.'/'.$user->getId().'.'.$user->getExtension());
    }
}
