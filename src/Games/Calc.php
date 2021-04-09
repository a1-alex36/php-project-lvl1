<?php

namespace Brain\Calc\Games\Calc;

use function Brain\Games\Engine\goGame;

function Run()
{
    define("NUM_QUESTIONS", 3);
    define("RULE", 'What is the result of the expression?');

    $conf = ["calc" => ["Question" => __NAMESPACE__ . '\QuestionCalc',
                        "checkAnswer" => __NAMESPACE__ . '\validate',
                        "rightAnswer" => __NAMESPACE__ . '\evalExpression',
                        "num_questions" => NUM_QUESTIONS,
                        "rule" => RULE]];
    return goGame($conf["calc"]);
    /*
    $res = QuestionCalc();
    echo $res . PHP_EOL;
    $result = '';
    eval('$result = ' . $res . ';');
    var_dump($result);
    */
}

//операции: +, - и *.
// числа случайно
//$Questions["even"]
function QuestionCalc(): string
{
    $operations = [" + "," - "," * "];
    rand(1, 100);
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
