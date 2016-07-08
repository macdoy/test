<?php

namespace Potogan\TestBundle\Validator\Constraints\Numeric;

use Symfony\Component\Validator\Constraint;

/**
* @Annotation
*/
class ContainsNumeric extends Constraint
{
  public $message = 'The string %string% is not a valide mobile.';
}
