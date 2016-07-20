<?php

namespace Potogan\TestBundle\Validator\Constraints\Twitter;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use GuzzleHttp\Client;

class ContainsTwitterValidator extends ConstraintValidator
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

        if (substr($value, 0 , 1) !== "@") {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
            return;
        }

        $res = $this->client->request('GET', 'https://twitter.com/'.substr($value, 1), ['exceptions' => false]);
        $header = $res->getStatusCode();

        if ($header !== 200) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}
