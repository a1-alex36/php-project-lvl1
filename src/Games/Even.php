<?php

namespace Brain\Even\Games\Even;

use function Brain\Games\Engine\goGame;

//необщая
// как сделать общей. - тут оставить запонение своими параметрами
// в конце вызвать РАН из Енджайна с передачей этих вах параметров.
/* какой метод формирует задачу, вычисляет правильный ответ,
валижация ввода, проверяет правильность ответа, выводит ответ
*/

function Run()
{
    define("NUM_QUESTIONS", 4);
    define("RULE", 'Answer "yes" if the number is even, otherwise answer "no".');

    //$conf = ["even" => ["Question" => "\Brain\Even\Games\Even\getNum",
    // можно добавить для всех __NAMESPACE__ пройдясь мапом по значениям
    $conf = ["even" => ["Question" => __NAMESPACE__ . '\getNum',
                        "checkAnswer" => __NAMESPACE__ . '\validate',
                        "rightAnswer" => __NAMESPACE__ . '\isEven',
                        "num_questions" => NUM_QUESTIONS,
                        "rule" => RULE]];
    return goGame($conf["even"]);
}

//не общая. в евен
function getNum(): int
{
    return rand(1, 100);
}

//не общая. в евен
function isEven(int $num): string
{
    /*if ($num % 2 > 0) {
        return false;
    }
    return true;*/
    return ($num % 2) > 0 ? "no" : "yes";
}

//общая. правила валидации надо передавать
function validate(string $Answer): bool
{
    return $Answer == "no" || $Answer == "yes";
}
