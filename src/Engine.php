<?php

namespace Brain\Games\Engine;

use function cli\err;
use function cli\line;
use function cli\prompt;

function goGame($config)
{
    $userName = showWelcome();
    showRules($config["rule"]);

    //var_dump($config);

    $countRightAnswer = 0;

    while ($countRightAnswer < $config["num_questions"]) {
        $Question = $config["Question"]();
        $userAnswer = showQuestion($Question);
        if (!checkAnswer($userAnswer, $config["checkAnswer"])) {
            err('Error answer format!');
            exit;
        }
        $rightAnswer = rightAnswer($Question, $config["rightAnswer"]);
        if (!checkResult($userAnswer, $rightAnswer)) {
            showResult($userAnswer, $userName, $rightAnswer, 'wrong');
            exit;
        } else {
            showResult($userAnswer, $userName, $rightAnswer, 'right');
            $countRightAnswer++;
            if ($countRightAnswer === $config["num_questions"]) {
                showResult($userAnswer, $userName, $rightAnswer, 'end');
            }
        }
    }

    //$config["Question"]();
    //  такая штука для того чтобы вызвать ф-цию из другого неймспейса
    // их много и они динамечески передаются. все подключить вроде не красиво
    //$name = '\\Brain\\Even\\Games\\Even\\' . $config["Question"];

    //$name = $config["Question"];
    //echo $name();
    //exit;
}

//общая в энджайн
function showWelcome(): string
{
    line('Welcome to the Brain Games!');
    $userName = prompt('May I have your name?');
    line('Hello, %s', $userName);
    return $userName;
}

//общая
function showRules($rule)
{
    line($rule);
}

//общая. что выводим надо передавать
function showResult($userAnswer, $userName, $correctAnswer, $status = null)
{
    switch ($status) {
        case "wrong":
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $userAnswer, $correctAnswer);
            line("Let's try again, %s!", $userName);
            break;
        case "right":
            line("Correct!");
            break;
        case "end":
            line("Congratulations, %s", $userName);
            break;
        default:
            break;
    }
}

//общая. правила валидации надо передавать
//ответ юзера, правильный ответ,
function checkAnswer($userAnswer, $checkFunc): bool
{
    return $checkFunc($userAnswer);
}

//общая. правила вычисления надо передавать
function rightAnswer($Questions, $rightEvalFunc): string
{
    return $rightEvalFunc($Questions);
}

//общая. правила вычисления надо передавать
function showQuestion($textQuestion): string
{
    line("Question: %s", $textQuestion);
    return prompt('Your answer');
}

//общая. правила вычисления надо передавать
function checkResult($userAnswer, $correctAnswer): bool
{
    return $userAnswer === $correctAnswer;
}
