<?php

namespace Brain\Progression\Games\Progression;

use function Brain\Games\Engine\playGame;

function Run()
{
    define("COUNT_ROUNDS", 3);
    define("RULE_GAME", 'What is the result of the expression?');

    $conf = ["progression" =>
                ["checkAnswer" => __NAMESPACE__ . '\validate',
                "countRounds" => COUNT_ROUNDS,
                "ruleGame" => RULE_GAME,
                "getRound" => __NAMESPACE__ . '\getQuestionProgression']];
    return playGame($conf["progression"]);
}

function generateProgression(): array
{
    $minLength = 5;
    $maxLength = 15;
    $length = rand($minLength, $maxLength);

    $minStart = 2;
    $maxStart = 10;
    $start = rand($minStart, $maxStart);

    $minStep = 2;
    $maxStep = 5;
    $step = rand($minStep, $maxStep);

    $row = [];
    for ($i = 0; count($row) < $length; $i++) {
        $row[] = $start + $step * $i;
    }
    /*print_r($length); echo '\n';
    print_r($start); echo '\n';
    print_r($step); echo '\n';
    print_r($row); die;*/
    return $row;
}

function getQuestionProgression(): array
{
    $progression = generateProgression();
    $positionHide = rand(0, count($progression));
    $hideNumber = $progression[$positionHide];
    $progression[$positionHide] = "..";
    return [implode(" ", $progression), $hideNumber];
}

function validate()
{
    return true;
}
