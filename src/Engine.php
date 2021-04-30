<?php

namespace Brain\Games\Engine;

use function cli\err;
use function cli\line;
use function cli\prompt;

//getRound  ruleGame checkAnswer  -countRounds
function playGame($config)
{
    showWelcome();
    $userName = getUserName();
    showRules($config["ruleGame"]);

    for ($countRightRounds = 0; $countRightRounds < $config["countRounds"]; $countRightRounds++) {
        [$Question, $rightAnswer] = $config["getRound"]();
        $userAnswer = showQuestion($Question);

        if (!checkAnswer($userAnswer, $config["checkAnswer"])) {
            err('Error answer format!');
            exit;
        }
        if (!checkResult($userAnswer, $rightAnswer)) {
            showResult($userAnswer, $userName, $rightAnswer, 'WrongAnswer');
            exit;
        }
        showResult($userAnswer, $userName, $rightAnswer, 'RightAnswer');
        if ($countRightRounds === $config["countRounds"]) {
            showResult($userAnswer, $userName, $rightAnswer, 'EndGame');
        }
    }
}

function showWelcome()
{
    line('Welcome to the Brain Games!');
}

function getUserName(): string
{
    $userName = prompt('May I have your name?');
    line('Hello, %s', $userName);
    return $userName;
}

function showRules($rule)
{
    line($rule);
}

function showResult($userAnswer, $userName, $correctAnswer, $ResultType = null)
{
    switch ($ResultType) {
        case "WrongAnswer":
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $userAnswer, $correctAnswer);
            line("Let's try again, %s!", $userName);
            break;
        case "RightAnswer":
            line("Correct!");
            break;
        case "EndGame":
            line("Congratulations, %s", $userName);
            break;
        default:
            //исключеие с выбросом значения ResultType
            break;
    }
}

function checkAnswer($userAnswer, $checkFunc): bool
{
    return $checkFunc($userAnswer);
}

//не юзается. общая. правила вычисления надо передавать
function getRightAnswer($Questions, $rightEvalFunc): string
{
    return $rightEvalFunc($Questions);
}

function showQuestion($textQuestion): string
{
    line("Question: %s", $textQuestion);
    return prompt('Your answer');
}

function checkResult($userAnswer, $correctAnswer): bool
{
    return $userAnswer === (string)$correctAnswer;
}
