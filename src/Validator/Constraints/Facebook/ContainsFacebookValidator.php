<?php

namespace Potogan\TestBundle\Validator\Constraints\Facebook;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use GuzzleHttp\Client;

class ContainsFacebookValidator extends ConstraintValidator
{
    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function validate($value, Constraint $constraint)
    {
        if ($value === null) {
            return ;
        }

        if (substr($value, 0 , 24) !== "https://www.facebook.com") {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
            return;
        }

        $res = $this->client->request('GET', $value, ['exceptions' => false]);
        $header = $res->getStatusCode();

        if ($header !== 200) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}
