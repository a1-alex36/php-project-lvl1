<?php

namespace Brain\Gcd\Games\Gcd;

use function Brain\Games\Engine\playGame;

function Run()
{
    define("COUNT_ROUNDS", 3);
    define("RULE_GAME", 'Find the greatest common divisor of given numbers.');

    // разделить на подмассив конфига и подмассив методов. так легко добавлять и не надо править вызов
    $conf = ["gcd" =>
                ["checkAnswer" => __NAMESPACE__ . '\validate',
                "countRounds" => COUNT_ROUNDS,
                "ruleGame" => RULE_GAME,
                "getRound" => __NAMESPACE__ . '\getRound']];
    return playGame($conf["gcd"]);
}

function getRound(): array
{
    $question = QuestionGcd();
    //$rightAnswer = evalExpression($question);
    //return [$question, $rightAnswer];
    return [$question, evalExpression($question)];
}

function QuestionGcd(): string
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
