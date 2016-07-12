<?php

namespace Potogan\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    /**
    * @ORM\PostPersist()
    * @ORM\PostUpdate()
    */
    public function upload($user)
    {
        if (null === $user->file) {
            return;
        }
        $extensions = array('png', 'bmp', 'gif', 'jpg', 'jpeg');
        if(!in_array($user->extension, $extensions)) {
            return;
        }
        if (null !== $user->tempFilename) {
            $oldFile = __DIR__.'/../../web/upload/'.$user->id.'.'.$user->tempFilename;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }
        $user->file->move(__DIR__.'/../../web/upload', $user->id.'.'.$user->extension);
        $info = getimagesize(__DIR__.'/../../web/upload/'.$user->id.'.'.$user->extension);
        if ($info[0] > 420 || $info[1] > 420)
            unlink(__DIR__.'/../../web/upload/'.$user->id.'.'.$user->extension);
    }
}
