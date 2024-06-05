<?php
session_start();
include_once("header.php"); 

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: LoanInformationMagalonaAdriel.php");
    exit();
}

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
            margin: 1;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 99%;
            margin-bottom: 3vh; 
            margin-left: .5vh;
        }
        td {
            padding: 5px;
            vertical-align: top;
            text-indent: 20px;
        }
        th {
            text-align: left; 
        }
        label {
            display: block;
            margin: 5px 0;
        }
        input[type="radio"],
        input[type="checkbox"] {
            margin-right: 10px;
        }
        .buttonContainer {
            display: flex;
        justify-content: center; 
        align-items: center;
        margin-top: 20px;
        }
        button {
            margin: 0 10px; 
            justify-content: center;
            align-items: center;
            display: flex; 
        }
    </style>
</head>
<body>
<h2>LOAN AMOUNT</h2>
    <form action="LoanInformationMagalonaAdriel.php" method="post">
    <table border="1">
        <tr>
            <th>Select Loan Amount:</th>
        </tr>
        <tr>
            <td>
                <label><input type="radio" name="loan_amount" value="5000">Php 5,000.00</label>
                <label><input type="radio" name="loan_amount" value="10000">Php 10,000.00</label>
                <label><input type="radio" name="loan_amount" value="15000">Php 15,000.00</label>
                <label><input type="radio" name="loan_amount" value="20000">Php 20,000.00</label>
                <label><input type="radio" name="loan_amount" value="25000">Php 25,000.00</label>
            </td>
        </tr>
        <tr>
            <th>Terms of Payment:</th>
        </tr>
        <tr>
            <td>
                <label>
                    <input type="radio" name="payment_terms" value="6">6 mos.
                    <input type="radio" name="payment_terms" value="12">12 mos.
                    <input type="radio" name="payment_terms" value="24">24 mos.
                </label>
            </td>
        </tr>
        <tr>
            <th>Cooperative Officer:</th>
        </tr>
        <tr>
            <td>
                <label><input type="checkbox" name="cooperative_officer" value="yes">Yes</label>
            </td>
        </tr>
    </table>

    <!-- Buttons moved outside the table -->
    <div class="buttonContainer">
            <button type="submit" name="confirm_loan">Confirm Loan</button>
            <button type="reset" name="clear_all">Clear All</button>
    </div>
    </form>
</body>
</html>
