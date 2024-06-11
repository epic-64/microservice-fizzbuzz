<?php

set_error_handler(function ($severity, $message, $file, $line) {
    throw new ErrorException($message, $severity, $severity, $file, $line);
});

function branch(callable $comparison, callable $onTrue, callable $onFalse): mixed
{
    return $comparison() ? $onTrue() : $onFalse();
}

function get_calculation_result(string $expression): int
{
    return file_get_contents("https://api.mathjs.org/v4/?expr=$expression");
}

function is_fizz (int $number): bool
{
    try {
        return get_calculation_result("$number%3") === 0;
    } catch (Throwable $exception) {
        return $number % 3 === 0;
    }
}

function is_buzz (int $number): bool {
    try {
        return get_calculation_result("$number%5") === 0;
    } catch (Throwable $exception) {
        return $number % 5 === 0;
    }
}

function fizz_buzz_value(int $number): string
{
    return branch(
        comparison: fn() => is_fizz($number) && is_buzz($number),
        onTrue:     fn() => 'FizzBuzz',
        onFalse:    fn() => branch(
            comparison: fn() => is_fizz($number),
            onTrue:     fn() => 'Fizz',
            onFalse:    fn() => branch(
                comparison: fn() => is_buzz($number),
                onTrue:     fn() => 'Buzz',
                onFalse:    fn() => "$number"
            )
        )
    );
};

function format_line(string $line): string
{
    return "$line\n";
}

function fizz_buzz_range(int $from, int $to): void
{
    echo format_line(fizz_buzz_value($from));

    if ($from < $to) {
        fizz_buzz_range($from + 1, $to);
    }
}

fizz_buzz_range(1, 30);