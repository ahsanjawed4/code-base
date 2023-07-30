var total_rows = document.getElementsByClassName("tr");
let addRow = () => {
  html = `<tr class="tr">
      <td onclick="addRow()">+</td>
      <td onclick="removeRow(this,${total_rows.length})">-</td>
      <td><input type="number" name="quantity_${total_rows.length}" id="quantity_${total_rows.length}" min="1" placeholder="Add Quantity" onchange="check(this,${total_rows.length})" onkeyup="check(this,${total_rows.length})" required/></td>
      <td><input type="text" name="price_${total_rows.length}" id="price_${total_rows.length}" min="1" placeholder="Add Price" onchange="check(this,${total_rows.length})" onkeyup="check(this,${total_rows.length})" required/></td>
      <td><input type="text" name="tax_${total_rows.length}" id="tax_${total_rows.length}" min="1" placeholder="10%" onchange="check(this,${total_rows.length})" onkeyup="check(this,${total_rows.length})" required/></td>
      <td><input type="text" name="extended_price_${total_rows.length}" id="extended_price_${total_rows.length}" placeholder="$1,000.00" readonly/></td>
    </tr>`;
  var tbody = document.getElementById("tbody");
  tbody.insertAdjacentHTML("beforeend", html);
};
// remove Row
function removeRow(obj, num) {
  if (total_rows.length > 2) {
    let extend_price = document.querySelector(`#extended_price_${num}`)?.value;
    let sub_total = document.querySelector("#total").innerHTML;
    let filter_extended_price = "";
    for (var f = 0; extend_price[f]; f++) {
      if (extend_price[f] == "$" || extend_price[f] == ",") {
        continue;
      }
      filter_extended_price = filter_extended_price + extend_price[f];
    }
    filter_extended_price = Number(filter_extended_price);
    let filter_sub_total = "";
    for (var s = 0; sub_total[s]; s++) {
      if (sub_total[s] == "$" || sub_total[s] == ",") {
        continue;
      }
      filter_sub_total += sub_total[s];
    }
    filter_sub_total = Number(filter_sub_total);
    let output = filter_sub_total - filter_extended_price;
    let us_CCCC = String(output).includes(".");
    document.getElementById("total").innerHTML = `$${output.toLocaleString()}${
      us_CCCC ? "" : ".00"
    }`;
    discountPercent();
    obj.parentNode.remove();
  }
}
// check process
function check(obj, num) {
  const filtering = obj.value.replace(/[^\d]/g, "");
  const numberValue = Number(filtering);
  if (!isNaN(numberValue)) {
    if (obj.name.includes("price_")) {
      obj.value = "$" + numberValue.toLocaleString();
    } else if (obj.name.includes("tax_")) {
      obj.value = numberValue.toLocaleString() + "%";
    } else if (obj.name.includes("quantity_")) {
      obj.value = obj.value;
    }
  } else {
    obj.value = "";
  }
  let qty = document.querySelector(`#quantity_${num}`).value;
  let price = document.querySelector(`#price_${num}`).value;
  let tax = document.querySelector(`#tax_${num}`).value;
  let filtering_price_i = "";
  for (var p = 0; price[p]; p++) {
    if (price[p] == "$" || price[p] == ",") {
      continue;
    }
    filtering_price_i = filtering_price_i + price[p];
  }
  filtering_price_i = Number(filtering_price_i);
  let quantity_price = qty * filtering_price_i;
  let filtering_tax_i = "";
  for (var t = 0; tax[t]; t++) {
    if (tax[t] == "%" || tax[t] == ",") {
      continue;
    }
    filtering_tax_i += tax[t];
  }
  filtering_tax_i = Number(filtering_tax_i);
  let extended_price;
  if (filtering_tax_i > 0) {
    extended_price = (quantity_price * filtering_tax_i) / 100;
    extended_price = quantity_price + extended_price;
  } else {
    extended_price = quantity_price;
  }
  let us_C = String(extended_price).includes(".");
  document.querySelector(
    `#extended_price_${num}`
  ).value = `$${extended_price.toLocaleString()}${us_C ? "" : ".00"}`;
  var total_extended_price = 0;
  for (var init = 1; init <= total_rows.length - 1; init++) {
    let filter_price = document.querySelector(`#extended_price_${init}`)?.value;
    filter_price = filter_price?.substr(1, filter_price.length - 1);
    var filtering_comma = "";
    for (var f = 0; filter_price[f]; f++) {
      if (filter_price[f] == ",") {
        continue;
      }
      filtering_comma = filtering_comma + filter_price[f];
    }
    total_extended_price += Number(filtering_comma);
  }
  let us_CC = String(total_extended_price).includes(".");
  document.getElementById(
    "total"
  ).innerHTML = `$${total_extended_price.toLocaleString()}${
    us_CC ? "" : ".00"
  }`;
  discountPercent();
}
// discount function
function discountPercent() {
  let discount = document.getElementById("discount").value;
  let sub_total = document.getElementById("total").innerHTML;
  sub_total = sub_total.substring(1, sub_total.length);
  let filter_sub_total = "";
  for (s = 0; sub_total[s]; s++) {
    if (sub_total[s] == ",") {
      continue;
    }
    filter_sub_total += sub_total[s];
  }
  filter_sub_total = Number(filter_sub_total);
  let grand_total;
  if (discount) {
    discount = (filter_sub_total * discount) / 100;
    grand_total = filter_sub_total - discount;
  } else {
    grand_total = filter_sub_total;
  }
  let color = "black";
  if (grand_total < 0) {
    color = "red";
  }
  document.getElementById("grand_total").style.color = color;
  let us_CCC = String(grand_total).includes(".");
  document.getElementById(
    "grand_total"
  ).value = `$${grand_total.toLocaleString()}${us_CCC ? "" : ".00"}`;
}
