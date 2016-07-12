<?php

namespace Potogan\TestBundle\Validator\Constraints\Facebook;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsFacebookValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $hostname=parse_url($value, PHP_URL_HOST);
        if (gethostbyname($hostname) !== $hostname)
        {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $value,
                CURLOPT_USERAGENT => "chrome",
                CURLOPT_HEADER => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_NOBODY => true));
            $header = explode("\n", curl_exec($curl));
            curl_close($curl);
        }
        if (strpos($header[0], '404') || $value !== null && substr($value, 0 , 24) !== "https://www.facebook.com")
        {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}
