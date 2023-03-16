<?php

namespace Main;

use ArrayObject;

class Department
{
    private string $name;
    private array $workers;
    public function __construct($name, $list)
    {
        $this->name=$name;
        $this->workers=new ArrayObject($list);
    }
    public function getName()
    {
        return $this->name;
    }

    public function getWorkers()
    {
        return $this->workers;
    }
    public function getSum()
    {
        $sum = 0;
        foreach ($this->workers as $worker)
        {
            $sum = $sum + $worker->getSalary();
        }

        return $sum;
    }

}
