<?php

namespace Brain\Gcd\Games\Gcd;

use function Brain\Games\Engine\goGame;

function Run()
{
    define("NUM_QUESTIONS", 3);
    define("RULE", 'Find the greatest common divisor of given numbers.');

    $conf = ["gcd" => ["Question" => __NAMESPACE__ . '\QuestionGcd',
        "checkAnswer" => __NAMESPACE__ . '\validate',
        "rightAnswer" => __NAMESPACE__ . '\evalExpression',
        "num_questions" => NUM_QUESTIONS,
        "rule" => RULE]];
    return goGame($conf["gcd"]);
}
function QuestionGcd()
{
    return rand(1, 100) . " " . rand(1, 100);
}

function validate()
{
    return true;
}

function evalExpression($expression)
{
    $pair = explode(" ", $expression);
    return gmp_gcd($pair[0], $pair[1]);
}
/*
 * установка ext-gmp
 * добавить в композер json. секция require - "ext-gmp": "*"
 * сделать композер инсталл, композер вилидейт.
 * в php.ini нужной версии пыха раскоментить. extension=gmp, сохранить файл
 * сделать композер инсталл
 * ошибка в композере что нет в сситеме gmp расширения
 * ставим в ситему sudo apt-get install php7.4-gmp
 * * сделать композер инсталл, композер вилидейт.
 * */
