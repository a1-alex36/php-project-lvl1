<?php

namespace Brain\Even\Games\Even;

use function Brain\Games\Engine\playGame;

function Run()
{
    define("COUNT_ROUNDS", 4);
    define("RULE_GAME", "Answer 'yes' if the number is even, otherwise answer 'no'. Max " . COUNT_ROUNDS . " rounds");

    //$conf = ["even" => ["Question" => "\Brain\Even\Games\Even\getNum",
    // можно добавить для всех __NAMESPACE__ пройдясь мапом по значениям
    $conf = ["even" => ["checkAnswer" => __NAMESPACE__ . '\validate',
                        "countRounds" => COUNT_ROUNDS,
                        "ruleGame" => RULE_GAME,
                        "getRound" => __NAMESPACE__ . '\getRound']];
    return playGame($conf["even"]);
}

function getRound(): array
{
    $question = getNum();
    $rightAnswer = isEven($question) ? "yes" : "no";
    return [$question, $rightAnswer];
}

function getNum(): int
{
    return rand(1, 100);
}

function isEven(int $num): bool
{
    return ($num % 2) === 0;
}

function validate(string $Answer): bool
{
    return $Answer == "no" || $Answer == "yes";
}
