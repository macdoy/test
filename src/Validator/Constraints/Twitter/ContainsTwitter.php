<?php

namespace Potogan\TestBundle\Validator\Constraints\Twitter;

use Symfony\Component\Validator\Constraint;

/**
* @Annotation
*/
class ContainsTwitter extends Constraint
{
  public $message = 'The string %string% is not a valide Twitter.';
}
