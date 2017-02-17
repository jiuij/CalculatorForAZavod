<?php
/**
 *  Created by PhpStorm.
 * User: UserBoot
 * Date: 16.02.2017
 * Time: 17:26
 * @author Yury Markov
 * @version 1.0
 *
 * Контроллер калькулятора.
 * Выводит результат на экран.
 */
function autoloding($class)
{
    include '../modules/' . $class . '.php';
}

spl_autoload_register('autoloding');

$c = new Calculator();

$data = $_GET;

if (isset($data['firstOperand']) && isset($data['secondOperand'])) {
    $operands = array($data['firstOperand'], $data['secondOperand']);
    $c->setOperands($operands);
}

if (isset($data['operator'])) {

    switch ($data['operator']) {

        case 'adder':   // сложение
            $c->setOperator(new Adder());
            break;

        case 'subtractor':   // вычитание
            $c->setOperator(new Subtraction());
            break;

        case 'multiplier':   // умножение
            $c->setOperator(new Multiplier());
            break;

        case 'divider':   // деление
            $c->setOperator(new Divider());
            break;
    }
}

$c->calculate();
echo $c->getResult();

?>