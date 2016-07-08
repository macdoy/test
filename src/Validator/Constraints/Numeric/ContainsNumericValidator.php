<?php

namespace Potogan\TestBundle\Validator\Constraints\Numeric;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsNumericValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
      if ($value == NULL){}
      else if (!preg_match('/^[0-9]+$/', $value, $matches) || strlen($value) != 10)
        {
          $this->context->buildViolation($constraint->message)
              ->setParameter('%string%', $value)
              ->addViolation();
        }
    }
}
