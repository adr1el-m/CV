<?php 
session_start();
include_once("header.php"); 

$conn = mysqli_connect("localhost", "root", "", "Loan");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$currentDateTime = date("F d, Y");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $loan_amount = $_POST['loan_amount'];
    $payment_terms = $_POST['payment_terms'];
}

$interest_rate = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cooperative_officer']) && $_POST['cooperative_officer'] === 'yes') {
        $interest_rate = 5; 
    } else {
        $interest_rate = 10; 
    }
}

if(isset($_POST['payment_terms'])) {
    $payment_terms_value = $_POST['payment_terms'];


    switch($payment_terms_value) {
        case '6':
            $payment_terms = '6 Months';
            break;
        case '12':
            $payment_terms = '12 Months';
            break;
        case '24':
            $payment_terms = '24 Months';
            break;
        default:
            $payment_terms = 'Not Selected';
    }
}

$interest_amount = ($loan_amount * $interest_rate) / 100;
$total_amount = $loan_amount + $interest_amount;

$officerArray = [
    5000 => ['6 Months' => 875.00, '12 Months' => 437.50, '24 Months' => 218.75],
    10000 => ['6 Months' => 1750.00, '12 Months' => 875.00, '24 Months' => 437.50],
    15000 => ['6 Months' => 2625.00, '12 Months' => 1312.50, '24 Months' => 656.25],
    20000 => ['6 Months' => 3500.00, '12 Months' => 1750.00, '24 Months' => 875.00],
    25000 => ['6 Months' => 4375.00, '12 Months' => 2187.50, '24 Months' => 1093.75]
];

if ($interest_rate == 5 && isset($officerArray[$loan_amount][$payment_terms])) {
    $monthly_dues = $officerArray[$loan_amount][$payment_terms];
}

$memberArray = [
    5000 => ['6 Months' => 916.67, '12 Months' => 458.33, '24 Months' => 229.17],
    10000 => ['6 Months' => 1833.33, '12 Months' => 916.67, '24 Months' => 458.33],
    15000 => ['6 Months' => 2750.00, '12 Months' => 1375.00, '24 Months' => 687.50],
    20000 => ['6 Months' => 3666.67, '12 Months' => 1833.33, '24 Months' => 916.67],
    25000 => ['6 Months' => 4583.33, '12 Months' => 2291.67, '24 Months' => 1145.83]
];

if ($interest_rate == 10 && isset($memberArray[$loan_amount][$payment_terms])) {
    $monthly_dues = $memberArray[$loan_amount][$payment_terms];
}

$username = isset($_SESSION['username']) && !empty($_SESSION['username']) ? $_SESSION['username'] : 'Not set';

$name_parts = explode(' ', trim($username)); 
$fname = '';
$mname = '';
$lname = '';

if (count($name_parts) > 0) {
    $fname = $name_parts[0]; 
    array_shift($name_parts); 
}

if (count($name_parts) > 1) {
    $lname = array_pop($name_parts); 
    $mname = implode(' ', $name_parts); 
} else {
    $lname = $name_parts ? $name_parts[0] : ''; 
}


$stmt = $conn->prepare("INSERT INTO tblcustomer (fname, mname, lname, loan_amount, loan_term, total_loan, monthly_due) VALUES (?, ?, ?, ?, ?, ?, ?)");


$stmt->bind_param("sssdidd", $fname, $mname, $lname, $loan_amount, $payment_terms, $total_amount, $monthly_dues);

$stmt->execute();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Application Form</title>
    <style>
            body {
            font-family: "Times New Roman", Times, serif;
            display: flex;
            flex-direction: column; 
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        table {
            width: 150%;
            margin-bottom: 3vh;
            margin-left: -8vh;
        }

        h2 {
            text-align: center;
        }

        .submitButton {
            justify-content: center;
            display: flex;
            margin-bottom: 3vh;

        }

        .backButton {
            justify-content: center;
            display: flex;
            margin-bottom: -20vh;
        }
    </style>
    </head>

<body>
<h2>LOAN INFORMATION</h2>
    <form action="LoanConfirmationMagalonaAdriel.php" method="post">
    <table border="1">
    <tr>
            <td>Date:</td>
            <td><?php echo $currentDateTime?></td>
        </tr>
        <tr>
            <td>Name:</td>
            <td><?php echo $username; ?></td>
        </tr>
        <tr>
            <td>Amount:</td>
            <td><?php echo number_format($loan_amount, 2); ?></td>
        </tr>
        <tr>
            <td>Terms of Payment:</td>
            <td><?php echo $payment_terms; ?></td>
        </tr>
        <tr>
            <td><?php echo "Interest: (".$interest_rate."%)" ?></td>
            <td><?php echo number_format($interest_amount, 2); ?></td>
        </tr>
        <tr>
            <td>Total Amount:</td>
            <td><?php echo number_format($total_amount, 2); ?></td>
        </tr>
        <tr>
            <td>Mothly Dues:</td>
            <td><?php echo number_format($monthly_dues, 2); ?></td>
        </tr>
    </table>

    <div class="submitButton">
            <button type="submit" name="submit">Submit</button>
    </div>

    <div class="backButton">
    <button type="button" name="back" onclick="GoBack()">Back</button>
    <script>
    function GoBack() {
        window.location.href = 'LoanAmountMagalonaAdriel.php';
    }
</script>
    </div>
    </form>
</body>
</html>