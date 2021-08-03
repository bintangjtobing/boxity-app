<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Report Sales Order</title>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="{{ $image }}">
      </div>
      <div id="company">
        <h2 class="name">{{ $companyName }}</h2>
        <div>{{ $companyAddress }}</div>
        <div>{{ $companyPhone }}</div>
        <div><a href=<?php echo "mailto:".$companyEmail ?>>{{ $companyEmail }}</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name">{{ $customerName }}</h2>
          <div class="address">{{ $customerAddress }}</div>
          <div class="email"><a href=<?php echo "mailto:".$customerEmail ?>>{{ $customerEmail }}</a></div>
        </div>
        <div id="invoice">
          <h1>{{ $soNumber }}</h1>
          <div class="date">Date of Invoice: {{ $orderDate }}</div>
          <!-- <div class="date">Due Date: 30/06/2014</div> -->
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">DESCRIPTION</th>
            <th class="unit">UNIT PRICE</th>
            <th class="qty">QUANTITY</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $i = 0; $total = 0;
            foreach ($items as $item) {
          ?>
          <tr>
            <td class="no">{{ $i }}</td>
            <td class="desc"><h3>{{ $item['name'] }}</h3>{{ $item['remark'] }}</td>
            <td class="unit">Rp. {{ $item['price'] }}</td>
            <td class="qty">{{ $item['qty'] }}</td>
            <td class="total">Rp. {{ $item['priceAmount'] }}</td>
          </tr>
          <?php 
              $total = +$item['priceAmount'];
              $i++;
            } 
          ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td>Rp. {{ $total }}</td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Thank you!</div>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">{{ $remark }}</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>

<style>
  @font-face {
  font-family: SourceSansPro;
  src: url(SourceSansPro-Regular.ttf);
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  position: relative;
  height: 21cm; 
  margin: 0 auto;
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
  font-family: SourceSansPro;
}

header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 1px solid #AAAAAA;
}

#logo {
  float: left;
  margin-top: 8px;
}

#logo img {
  height: 70px;
}

#company {
  width: 45%;
  float: right;
  text-align: right;
}


#details {
  margin-bottom: 50px;
}

#client {
  width: 40%;
  padding-left: 6px;
  border-left: 6px solid #0087C3;
  float: left;
}

#client .to {
  color: #777777;
}

#client .address {
  font-size: 11px;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}

#invoice {
  width: 100%;
  float: right;
  text-align: right;
}

#invoice h1 {
  color: #0087C3;
  font-size: 2.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table th,
table td {
  padding: 20px;
  background: #EEEEEE;
  text-align: center;
  border-bottom: 1px solid #FFFFFF;
}

table th {
  white-space: nowrap;        
  font-weight: normal;
}

table td {
  text-align: right;
}

table td h3{
  color: #57B223;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

table .no {
  color: #FFFFFF;
  font-size: 1.6em;
  background: #57B223;
}

table .desc {
  text-align: left;
}

table .unit {
  background: #DDDDDD;
}

table .qty {
}

table .total {
  background: #57B223;
  color: #FFFFFF;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}
/* 
table tbody tr:last-child td {
  border: none;
} */

table tfoot td {
  padding: 10px 20px;
  background: #FFFFFF;
  border-bottom: none;
  font-size: 1.2em;
  white-space: nowrap; 
  border-top: 1px solid #AAAAAA; 
}

table tfoot tr:first-child td {
  border-top: none; 
}

table tfoot tr:last-child td {
  color: #fff;
  font-size: 1.4em;
  border-top: 1px solid #fff; 
  background: #57B223;
}

table tfoot tr td:first-child {
  border: none;
}

#thanks{
  font-size: 2em;
  margin-bottom: 50px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;  
}

#notices .notice {
  font-size: 1.2em;
}

footer {
  color: #777777;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
}
</style>