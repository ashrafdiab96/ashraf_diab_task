<?php
/**
 * NAME: ASHRAF DIAB
 * PHONE: 01020869595
 * EMAIL: ashraf.diab22.ad@gmail.com
*/

/***************************************************/

/**
 * Calculations class
 * This class takes two numbers and return thier summation, multiplicaition, subtraction and division
*/
class Calculations
{
    protected $num1; // First number
    protected $num2; // Second number

    /**
     * __construct function
     * constructor which receive two numbers
     * @param float $numberOne
     * @param float $numberTwo
    */
    public function __construct($numberOne, $numberTwo)
    {
        $this->num1 = $numberOne;
        $this->num2 = $numberTwo;
    }

    /**
     * numbersSummation function
     * calculate summation
     * @return float
    */
    public function numbersSummation()
    {
        return $this->num1 + $this->num2;
    }

    /**
     * numbersMultiplication function
     * calculate multiplication
     * @return float
    */
    public function numbersMultiplication()
    {
        return $this->num1 * $this->num2;
    }

    /**
     * numbersSubtraction function
     * calculate the subtraction
     * @return float
    */
    public function numbersSubtraction()
    {
        return $this->num1 - $this->num2;
    }

    /**
     * numbersDivision function
     * calculate the division
     * @return float
    */
    public function numbersDivision()
    {
        return $this->num1 / $this->num2;
    }

}

header('Content-Type: application/json');

/**
 * receiveVariables function
 * function to check if the two numbers are exist receive them
 * pass the two numbers to implementCalculations function
 * @return void
 */
function receiveVariables()
{
    if (!isset($_GET['num1']) || !isset($_GET['num2']))
    {
        echo json_encode('You must enter the two numbers');
        return 0;
    }
    $firstNumber = $_GET['num1'];
    $secondtNumber = $_GET['num2'];
    validation($firstNumber, $secondtNumber);
}

/**
 * validation function
 * validate the two numbers
 * check if the two numbers are exist
 * cehck if thee second numer is zero (to avoid the division by zero)
 * check if the two numbers are between 1000 000 000 & -1000 000 000
 * @param float $num1
 * @param float $num2
 * @return void
*/
function validation($num1, $num2)
{
    $checkNumberOne = !isset($num1) || $num1 == null || $num1 == '';
    $checkNumberTwo = !isset($num2) || $num2 == null || $num2 == '';
    $checkNumbers = $checkNumberOne || $checkNumberTwo;
    $errorMessage = json_encode('You must enter the two numbers');
    if($checkNumbers)
    {
        http_response_code(400);
        echo $errorMessage;
        return 0;
    }
    $checkZero = $num2 == 0;
    $divisionByZero = json_encode('You try to divide by zero');
    if($checkZero)
    {
        http_response_code(400);
        echo $divisionByZero;
        return 0;
    }
    $max = 1000000000;
    $min = -1000000000;
    $chekNumberOneRange = (($num1 > $min) && ($num1 < $max));
    $chekNumberTwoRange = (($num2 > $min) && ($num2 < $max));
    $checkRange = json_encode('The entered numbers must be between '. $min . ' and ' . $max);
    if(!$chekNumberOneRange || !$chekNumberTwoRange)
    {
        http_response_code(400);
        echo $checkRange;
        return 0;
    }
    $result = implementCalculations($num1, $num2);
    echo json_encode($result, JSON_FORCE_OBJECT);
}

/**
 * implementCalculations function
 * function to create new object from calculations class
 * @param float $num1
 * @param float $num2
 * @return array
 */
function implementCalculations($num1, $num2)
{
    $newObject = new Calculations($num1, $num2);
    $summation = $newObject->numbersSummation();
    $multplication = $newObject->numbersMultiplication();
    $subtraction = $newObject->numbersSubtraction();
    $division = $newObject->numbersDivision();
    $result = [
        'sum' => $summation,
        'mult' => $multplication,
        'sub' => $subtraction,
        'div' => $division
    ];
    return $result;
}
receiveVariables();

?>