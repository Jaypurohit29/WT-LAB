<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #FFDFDE;
            padding: 20px;
            box-shadow: 0px 0px 10px gray;
            border-radius: 8px;
        }
        .form-box {
            border: 2px solid #ccc;
            padding: 15px;
            border-radius: 8px;
            background-color: #FFDFDE;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        td, th {
            padding: 10px;
            border: 1px solid #ccc;
        }
        input[type="text"], input[type="number"], input[type="date"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"], button {
            background-color: #6A7BA2;
            color: white;
            border: none;
            padding: 10px 15px;
            margin: 10px 5px;
            cursor: pointer;
            border-radius: 4px;
        }
        input[type="submit"]:hover, button:hover {
            background-color: #FFDFDE;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Inventory Management System</h1>
        <div class="form-box">
            <form method="post">
                <table>
                    <tr><td>Customer Name: <input type="text" name="customer_name" required></td></tr>
                    <tr><td>Date: <input type="date" name="date" required></td></tr>
                    <tr><td>Product Name: <input type="text" name="product_name" required></td></tr>
                    <tr><td>Quantity: <input type="number" name="quantity" id="quantity" required></td></tr>
                    <tr><td>Price: <input type="number" name="price" id="price" step="0.01" required></td></tr>
                    <tr><td>Total Price: <input type="text" id="total_price" name="total_price" readonly></td></tr>
                </table>
                <input type="submit" name="add" value="Add">
                <button onclick="window.location.href='display.php';" type="button">Display</button>
            </form>
        </div>
        
        <?php
        $conn = new mysqli("localhost", "root", "", "wt");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['add'])) {
                $customer_name = htmlspecialchars($_POST['customer_name']);
                $product_name = htmlspecialchars($_POST['product_name']);
                $quantity = htmlspecialchars($_POST['quantity']);
                $price = htmlspecialchars($_POST['price']);
                $date = htmlspecialchars($_POST['date']);
                $total_price = $quantity * $price;
                
                $stmt = $conn->prepare("INSERT INTO student (customerName, productName, quantity, price, TotalPrice, date) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssidds", $customer_name, $product_name, $quantity, $price, $total_price, $date);
                
                if ($stmt->execute()) {
                    echo "<p>Record added successfully!</p>";
                } else {
                    echo "<p>Error: " . $stmt->error . "</p>";
                }
                $stmt->close();
            }
        }
        
        $conn->close();
        ?>
    </div>
    
    <script>
        document.getElementById("quantity").addEventListener("input", calculateTotal);
        document.getElementById("price").addEventListener("input", calculateTotal);
        
        function calculateTotal() {
            let quantity = document.getElementById("quantity").value;
            let price = document.getElementById("price").value;
            let total = quantity * price;
            document.getElementById("total_price").value = total ? total.toFixed(2) : "";
        }
    </script>
</body>
</html>