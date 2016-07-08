<?php

namespace Potogan\TestBundle\Validator\Constraints\Twitter;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsTwitterValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
      if ($value == NULL){}
      else if (substr($value, 0 , 1) != "@")
        {
          $this->context->buildViolation($constraint->message)
              ->setParameter('%string%', $value)
              ->addViolation();
        }
    }
}
