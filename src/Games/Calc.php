<?php

namespace Brain\Calc\Games\Calc;

use function Brain\Games\Engine\playGame;

function Run()
{
    define("COUNT_ROUNDS", 3);
    define("RULE_GAME", 'What is the result of the expression?');

    $conf = ["calc" => ["checkAnswer" => __NAMESPACE__ . '\validate',
                        "countRounds" => COUNT_ROUNDS,
                        "ruleGame" => RULE_GAME,
                        "getRound" => __NAMESPACE__ . '\getRound']];
    return playGame($conf["calc"]);
    /*
    $res = QuestionCalc();
    echo $res . PHP_EOL;
    $result = '';
    eval('$result = ' . $res . ';');
    var_dump($result);
    */
}

function getRound(): array
{
    $question = QuestionCalc();
    //$rightAnswer = evalExpression($question);
    //return [$question, $rightAnswer];
    return [$question, evalExpression($question)];
}


//generateExpression
//операции: +, - и *.
// числа случайно
//$Questions["even"]
function QuestionCalc(): string
{
    $operations = [" + "," - "," * "];
    return rand(1, 100) . array_rand(array_flip($operations), 1) . rand(1, 100);
}

function evalExpression($expression)
{
    $result = null;
    eval('$result = ' . $expression . ';');
    return $result;
}

//свою валидацию придумать
function validate(): bool
{
    return true;
}
