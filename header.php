<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #ffffff;
            margin: 0;
            padding: 20px;
            color: #e6e6e6;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background: #1e1e1e;
            padding: 25px;
            border-radius: 10px;
        }

        .header {
            background: #F50;
            padding: 15px;
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            box-sizing: border-box;
        }

        button {
            background: #A00;
            color: white;
            border: none;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .success { color: green; }
        .error { color: red; }

        .navigation {
            margin-bottom: 20px;
        }

        .navigation a {
            margin-right: 15px;
            color: #A00;
            text-decoration: none;
            font-weight: bold;
        }

        .navigation a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <div class = "header">
        <h1>Campus Canteen</h1>
        <p>Student Ordering and Discount System</p>
    </div>
    <hr>
    <nav class="navigation">
        <a href="index.php">Order</a>
        <a href="stock.php">Stock Monitoring</a>
    </nav>
