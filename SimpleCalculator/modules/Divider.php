<?php

/**
 * Created by PhpStorm.
 * User: UserBoot
 * Date: 16.02.2017
 * Time: 17:26
 * @author Yury Markov
 * @version 1.0
 *
 * Обработчик деления.
 * Делит входящие значения (первое на второе).
 * @return float
 */
class Divider implements IOperator
{
    function run($operands)
    {
        if ($operands[1] == 0) {
            return 'Ошибка!';
        } else {
            return (float)$operands[0] / $operands[1];
        }
    }
}

?>