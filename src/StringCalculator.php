<?php
namespace PhpKatas;

/**
 * @author: Jose Manuel Orts
 * @date: 09/09/2018
 *
 * About the Kata:
 *
 * String Calculator Kata by Roy Osherove.
 *
 * Create a simple String calculator with a method int Add(string numbers). The method can take 0, 1 or 2 numbers,
 * and will return their sum (for an empty string, it will return 0). For example "" or "1" or "1,2".
 * Start with the simplest test case of an empty string and move to 1 and two numbers.
 * Remember to solve things as simply as possible so that you force yourself to write tests you did not think about.
 * Remember to refactor after each passing test.
 * Allow the Add method to handle an unknown amount of numbers.
 * Allow the Add method to handle new lines between numbers (instead of commas).
 * The following input is ok: "1\n2,3" (will equal 6)
 * The following input is NOT ok: "1,\n" (not need to prove it - just clarifying)
 * Support different delimiters. To change a delimiter, the beginning of the string will contain a separate line
 * that looks like this: [delimiter]\n[numbers...], for example ;\n1;2 should return three where the default
 * delimiter is ; .
 * The first line is optional. All existing scenarios should still be supported.
 * Calling Add with a negative number will throw an exception "negatives not allowed"
 * and the negative that was passed.
 * If there are multiple negatives, show all of them in the exception message
 */
class StringCalculator
{
    const SEMICOLON_DELIMITER = ';';
    const NEW_LINE_DELIMITER = "\n";
    const SUPPORTED_DELIMITERS = [',', '+', ':', self::SEMICOLON_DELIMITER];


    /**
     * @throws \Exception
    */
    public function add(string $numbers): int
    {
        $sum = 0;
        if ($numbers === '') {
            return $sum;
        }
        $this->checkNegativeNumbers($numbers);

        $delimiter = $this->getDelimiter($numbers);
        if (preg_match("/[0-9]+\s*{$delimiter}\s*\\n/", $numbers) === 1) {
            return $sum;
        }

        return array_sum(
            explode(
                $delimiter,
                str_replace(self::NEW_LINE_DELIMITER, $delimiter, $numbers)
            )
        );
    }

    /**
     * @throws \Exception
     */
    protected function checkNegativeNumbers(string $numbers): void
    {
        if (preg_match_all('/(-[0-9]+)/', $numbers, $matches)) {
            $negativeOnes = implode(', ', $matches[0]);
            throw new \Exception("Negatives not allowed: {$negativeOnes}");
        }
    }

    protected function getDelimiter(string $numbers): string
    {
        $changeDelimiterPattern = '/^[' . implode('|', self::SUPPORTED_DELIMITERS) . ']+\\n[0-9]+/';
        if (preg_match($changeDelimiterPattern, $numbers) === 1) {
            return substr($numbers, 0, 1);
        }

        return self::SEMICOLON_DELIMITER;
    }
}
