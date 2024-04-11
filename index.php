<head>
    <title>My Finances</title>
    <style>
        body {
            background-color: silver;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <h1>My Finances</h1>
    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <p>Income/Expense<br>
            <select name="incexp" size="1" id="">
                <option value="-">-</option>
                <option value="Income">Income</option>
                <option value="Expense">Expense</option>
            </select>
        </p>

        <p>Item<br>
            <input type="text" name="item" size="20">
        </p>

        <p>Category<br>
            <select name="category" size="1">
                <option value="-">-</option>
                <option value="Food">Food</option>
                <option value="Gas">Gas</option>
                <option value="Paycheck">Paycheck</option>
                <option value="Rent">Rent</option>
                <option value="Stock">Stock</option>

            </select>
        </p>
        <p>Amount <br>
            <input type="text" name="amount" size="20">
        </p>
        <p><input type="submit" name="submitme" value="Add Transacion"></p>
    </form>

    <hr>
    <table>

        <tr>
            <th>Inc/Exp</th>
            <th>Item</th>
            <th>Category</th>
            <th>Amuount</th>
        </tr>
    </table>
</body>

<?php
//------------------------------ Interfaces ----------------------------------------

// Interfaces contains constant with delimited string and an abstract function
interface IncomeCategories
{
    const INCOMECATS = "Stock*Paycheck";

    public function checkIncomeCategory($category);
}

interface ExpenseCategories
{
    const EXPENSECATS = "Rent*Food*Gas";
    public function checkExpenseCategory($category);
}

//------------------------------ "Grand daddy class" (abstract) ----------------------------------------

abstract class Transaction
{
    protected $item;
    protected $category;
    protected $amount;

    public function __construct($cItem, $cCategory, $cAmount)
    {
        $this->item = $cItem;
        $this->category = $cCategory;
        $this->amount = $cAmount;
    }
    public static function displayTrans()
    {
        $filename = "transfile.txt";
        if (file_exists($filename)) {
            $fp = fopen($filename, "r");
            while (true) {
                $line = fgets($fp);
                if (feof($fp)) {
                    print "<br><b>Program Ended Normally</b>";
                    return; //exit the function
                }
                list($aIncExp, $aItem, $aCategory, $aAmount) = explode('*', $line);

                print "<tr>";
                print "<td>$aIncExp</td>";
                print "<td>$aItem</td>";
                print "<td>$aCategory</td>";
                print "<td>$aAmount</td>";
                print "</tr>";
                fclose($fp);
            }
        }
    }
    public function addTrans($aIncExp)
    {
        $tran = $aIncExp . "*" . $this->item . "*";
        $tran .= $this->category . "*" . $this->amount . "*\n";

        $filename = "transfile.txt";
        $fpw = fopen($filename, "a");
        fwrite($fpw, $tran);
        fclose($fpw);
    }
}

//----------------Classes that inherits Transaction----------------------
class IncomeTran extends Transaction implements IncomeCategories
{
    private $tranType = "Income";
    //from abstract function in interface, REQUIRED to define function here below:
    public function checkIncomeCategory($category)
    {
        $validCategories = explode('*', self::INCOMECATS);
        $isValid = false;

        foreach ($validCategories as $element) {
            if ($element == $category) {
                $isValid = true;
            }
        }
        return $isValid;

    }
}
?>