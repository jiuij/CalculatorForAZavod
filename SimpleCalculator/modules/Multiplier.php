<?php

/**
 * Created by PhpStorm.
 * User: UserBoot
 * Date: 16.02.2017
 * Time: 17:26
 * @author Yury Markov
 * @version 1.0
 *
 * Обработчик умножение.
 * Перемножает между собой входящие значения.
 * @return float
 */
class Multiplier implements IOperator
{
    function run($operands)
    {
        return (float)$operands[0] * $operands[1];
    }
}

?>