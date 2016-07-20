<?php

namespace Potogan\TestBundle\Validator\Constraints\Facebook;

use Symfony\Component\Validator\Constraint;

/**
* @Annotation
*/
class ContainsFacebook extends Constraint
{
    public function validatedBy()
    {
        return 'facebook_validator';
    }

    public $message = '%string% is not a valid Facebook.';
}
