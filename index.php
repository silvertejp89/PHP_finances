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

//------------------------------ "Grand daddy class" ----------------------------------------

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
}
?>