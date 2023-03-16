<?php

//Задание 1 - Настройка виртуального хоста, создание проекта, демонстрация работы валидатора

require 'vendor/autoload.php';

use Main\Employee;
use Main\Department;

echo "Hello from PHP\n";
$validator = Validation::createValidator();
$violations = $validator->validate('Bernhard', [
    new Length(['min' => 10]),
    new NotBlank(),
]);

if (0 !== count($violations)) {
    // there are errors, now you can show them
    foreach ($violations as $violation) {
        echo $violation->getMessage().'<br>';
    }
}

//Задание 2 ООП
echo "<h1>Task 1</h1>";
echo "<b>Create user with true parametrs</b><br>";
$user1 = new Employee(1239, 'Alex', 2000, '2023-03-12');
echo "<p>Work experience (full years)".$user1->getExperience()."</p>";
echo "<b>Creating a user with a date that has not yet come</b><br>";
$user2 = new Employee(1233, 'Alex', 2000, '2024-01-01');
echo "<b>Create user with false salary</b><br>";
$user3 = new Employee(1234, 'Alex', -200.0, '2023-03-12');
echo "<b>Create user with false id</b><br>";
$user4 = new Employee(457, 'Alex', 2000, '2023-03-12');
echo "<b>Create user with false name</b><br>";
$user5 = new Employee(1000, 'alex', 2000, '2023-03-12');
echo "<b>Create user with empty fields</b><br>";
$user6 = new Employee('', '', '', '');
echo "<h1>Task 2</h1>";
echo "<p>Create some users: </p>";
$worker1 = new Employee(1000, 'Alex', 11000, '2000-10-20');
$worker2 = new Employee(2000, 'Artem', 20000, '2005-08-25');
$worker3 = new Employee(3000, 'Dmitriy', 40000, '2002-04-10');
$worker4 = new Employee(4000, 'Stepan', 10000, '1999-11-20');
$worker5 = new Employee(5000, 'Kirill', 10000, '2003-04-06');
$dep1=new Department('Work1',array($worker1,$worker2,$worker3));
$dep2=new Department('Work2',array($worker4,$worker5));

$dep=array($dep1,$dep2,$dep3);
$dep_min=array();
$dep_max=array();
$min=$dep[0]->getSum();
$max=$min;

for ($i=0;$i<count($dep);$i++)
{
    $temp=$dep[$i]->getSum();
    if ($temp>$max)
    {
        $dep_max=array($dep[$i]);
        $max=$temp;
    }
    else if ($temp==$max)
    {
        array_push($dep_max,$dep[$i]);
    }
    if ($temp<$min)
    {
        $dep_min=array($dep[$i]);
        $min=$temp;
    }
    else if ($temp==$min)
    {
        array_push($dep_min,$dep[$i]);
    }
}

$temp_ar=array();
foreach ($dep_max as $dept)
    array_push($temp_ar,count($dept->getworkers()));
$max=max($temp_ar);

foreach ($dep_max as $dept)
{
    if (count($dept->getworkers())==$max)
        echo "<p>Department with max salary".$dept->getName()." with sum ".$dept->getSum()."</p>";
}
$temp_ar=array();
foreach ($dep_min as $dept)
    array_push($temp_ar,count($dept->getworkers()));
$max=max($temp_ar);

foreach ($dep_min as $dept)
    if (count($dept->getworkers())==$max)
         echo "<p>Department with min salary".$dept->getName()." with sum ".$dept->getSum()."</p>";
