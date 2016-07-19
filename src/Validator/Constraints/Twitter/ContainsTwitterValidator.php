<?php

namespace Potogan\TestBundle\Validator\Constraints\Twitter;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsTwitterValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value === null) {
            return ;
        }

        if (substr($value, 0 , 1) !== "@") {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
            return;
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://twitter.com/'.substr($value, 1),
            CURLOPT_USERAGENT => "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36",
            CURLOPT_HEADER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_NOBODY => true));
        $header = explode("\n", curl_exec($curl));
        curl_close($curl);

        if (!strpos($header[0], '200')) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}
