<?php

namespace Brain\Even\Even;

use function cli\line;
use function cli\prompt;

function Run()
{
    echo "Run even";
    define("NUM_QUESTIONS", 3);
    define("RULE", 'Answer "yes" if the number is even, otherwise answer "no".');

    $countRightAnswer = 0;
    $Questions = [
       // "even" => getNum()
    ];

    $userName = showWelcome();
    showRules(RULE);
    while ($countRightAnswer < NUM_QUESTIONS) {
        $Questions["even"] = getNum();
        $userAnswer = showQuestion($Questions["even"]);
        if (!checkAnswer($userAnswer)) {
            line('Answer bad');
            exit;
        }
        $rightAnswer = rightAnswer($Questions["even"]);
        if (!checkResult($userAnswer, $rightAnswer)) {
            showResult($userAnswer, $userName, $rightAnswer, 'wrong');
            exit;
        } else {
            showResult($userAnswer, $userName, $rightAnswer, 'right');
            $countRightAnswer++;
            if ($countRightAnswer === NUM_QUESTIONS) {
                showResult($userAnswer, $userName, $rightAnswer, 'end');
            }
        }
    }
}

function showWelcome(): string
{
    line('Welcome to the Brain Games!');
    $userName = prompt('May I have your name?');
    line('Hello, %s', $userName);
    return $userName;
}

function showRules($rule)
{
    line($rule);
}

function getNum(): int
{
    return rand(1, 100);
}

function isEven(int $num): bool
{
    if ($num % 2 > 0) {
        return false;
    }
    return true;
}

//ответ юзера, правильный ответ,
function checkAnswer($userAnswer): bool
{
    return validate($userAnswer);
}


function validate(string $Answer): bool
{
    return $Answer == "no" || $Answer == "yes";
}

function rightAnswer($Questions): string
{
    return isEven($Questions) ? "yes" : "no";
}

function showQuestion($textQuestion): string
{
    return prompt('Question:', $textQuestion);
}

/*
function generateNum(): int
{
    return rand(1, 100);
}*/

function checkResult($userAnswer, $correctAnswer): bool
{
    return $userAnswer === $correctAnswer;
}

function showResult($userAnswer, $userName, $correctAnswer, $status = null)
{
    switch ($status) {
        case "wrong":
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $userAnswer, $correctAnswer);
            line("Let's try again, %s!", $userName);
            break;
        case "right":
            line("Your answer: '%s'", $userAnswer);
            line("Correct!");
            break;
        case "end":
            line("Congratulations, '%s'", $userName);
            break;
        default:
            break;
    }
}
