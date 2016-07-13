<?php

namespace Potogan\TestBundle\Validator\Constraints\Numeric;

use Symfony\Component\Validator\Constraint;

/**
* @Annotation
*/
class ContainsNumeric extends Constraint
{
    public $message = '%string% is not a valid mobile.';
}
