<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/syle.css">
  <title>Html Css & Js</title>
</head>
<body>
  <section>
  <form method="POST" action="action.php" id="form">
    <table id="table">
      <thead>
        <tr class="tr">
          <th colspan="2">Action</th>
          <th>Quantity</th>
          <th>Price $</th>
          <th>Tax %</th>
          <th>Extended Price</th>
        </tr>
      </thead>
      <tbody id="tbody">
        <tr class="tr">
          <td onclick="addRow()">+</td>
          <td onclick="removeRow(this,1)">-</td>
          <td><input type="number" name="quantity_1" id="quantity_1" min="1" placeholder="Add Quantity" onchange="check(this,1)" onkeyup="check(this,1)" required/></td>
          <td><input type="text" name="price_1" id="price_1" min="1" placeholder="Add Price" onchange="check(this,1)" onkeyup="check(this,1)" required/></td>
          <td><input type="text" name="tax_1" id="tax_1" min="1" placeholder="10%" onchange="check(this,1)" onkeyup="check(this,1)" required/></td>
          <td><input type="text" name="extended_price_1" id="extended_price_1" placeholder="$1,000.00" readonly/></td>
        </tr>
      </tbody>
      <tr>
          <td colspan="4"></td>
          <td class="total" style="text-align: right;">Sub Total $.</td>
          <td id="total" style="font-size:20px">$0.00</td>
      </tr>
      <tr>
          <td colspan="4" ></td>
          <td class="discount" style="text-align: right;">Discount %.</td>
          <td>
            <input type="number" name="discount" id="discount" min="1" placeholder="10%" style="background-color: #EDEDED;" onkeyup="discountPercent()" onchange="discountPercent()"/>
          </td>
      </tr>
      <tr>
          <td colspan="4"></td>
          <td class="grand_total" style="text-align: right;">Grand Total $.</td>
          <td>
           <input type="text" name="grand_total" id="grand_total" value="$0.00" readonly style="font-weight: bold;"/>
          </td>
      </tr>
      </form>
    </table>
    <div style="display: flex; justify-content: center;">
    <input type="submit" name="addData" value="Add Data"/>
    </div>
  </section>
  <!-- script file -->
  <script src="./assets/js/script.js"></script>
</body>
</html>