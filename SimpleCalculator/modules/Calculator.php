<?php

/**
 * Created by PhpStorm.
 * User: UserBoot
 * Date: 16.02.2017
 * Time: 17:26
 * @author Yury Markov
 * @version 1.0
 *
 * Обрабатывает процесс калькуляции.
 */
class Calculator
{
    private $operands;

    private $operator;

    private $result;

    function setOperator(IOperator $operator)
    {
        $this->operator = $operator;
    }

    function setOperands($operands)
    {
        $this->operands = $operands;
    }

    function getResult()
    {
        return $this->result;
    }

    function calculate()
    {
        $this->result = $this->operator->run($this->operands);
    }

}

?>