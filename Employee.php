<?php

namespace Main;

use DateTime;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;

class Employee
{
    private int $id;
    private string $name;
    private int $salary;
    private $date;

    public function __construct(int $id,string $name,int $salary,$date)
    {
        $validator = Validation::createValidator();
        $today=new DateTime('today');
        $violations = $validator->validate($id, [new Regex(['pattern' => '/^[0-9]{4}/']), new NotBlank(),]);
        $violations->addAll($validator->validate($date, [ new Date(),new NotBlank(), ]));
        $violations->addAll($validator->validate(new DateTime($date), [new LessThan($today),]));
        $violations->addAll($validator->validate($salary, [new Type(['type' => 'integer']),new Positive(),new NotBlank(),]));
        $violations->addAll($validator->validate($name, [new Regex(['pattern' => '/^([А-ЯЁ][а-яё]{1,29})|([A-Z][a-z]{1,29})+$/u']),new NotBlank(),]));
        
        if (0 !== count($violations)) {
            echo '<p style="color:red">Creating user failed</p>';
            foreach ($violations as $violation) {
                echo $violation->getMessage().'<br>';
            }
        }
        else{
            $this->name = $name;
            $this->salary = $salary;
            $this->id = $id;
            $this->date = new DateTime($date);
            echo '<p style="color:purple">Creating user ' .$id. ' succeeded</p>';
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getExperience()
    {
        return date_diff(new DateTime(),$this->date)->y;
    }
}
