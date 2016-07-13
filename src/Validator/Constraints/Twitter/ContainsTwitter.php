<?php

namespace Potogan\TestBundle\Validator\Constraints\Twitter;

use Symfony\Component\Validator\Constraint;

/**
* @Annotation
*/
class ContainsTwitter extends Constraint
{
    public $message = '%string% is not a valid Twitter.';
}
