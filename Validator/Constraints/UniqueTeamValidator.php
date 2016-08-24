<?php 

namespace BabyFootBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

class UniqueTeamValidator extends ConstraintValidator
{
    private $em;
    public function __construct(EntityManager $em) 
    {
        $this->em = $em;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!preg_match('/^[a-zA-Z0-9]+$/', $value, $matches)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
        $teams = $this->em ->getRepository('BabyFootBundle:Team')
			   ->findAll();
//	die(var_dump($value));
//	die(var_dump($teams));
//	exit(var_dump($teams));       
//	$this->context->buildViolation($constraint->message)
//                      ->addViolation();
    }
}
