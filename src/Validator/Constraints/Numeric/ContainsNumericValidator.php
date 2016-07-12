<?php

namespace Potogan\TestBundle\Validator\Constraints\Numeric;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsNumericValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value !== null && !preg_match('/^\d{10}$/', $value, $matches))
        {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}
