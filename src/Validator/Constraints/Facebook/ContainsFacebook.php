<?php

namespace Potogan\TestBundle\Validator\Constraints\Facebook;

use Symfony\Component\Validator\Constraint;

/**
* @Annotation
*/
class ContainsFacebook extends Constraint
{
    public $message = '%string% is not a valid Facebook.';
}
