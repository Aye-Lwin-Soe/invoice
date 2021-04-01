<?php 
  
  require 'db_connect.php';
  
  // draw out the query from the db
  $sql="SELECT * from invoice_items";
  
  $stmt = $pdo->prepare($sql);
  
  $stmt->execute();

  $row = $stmt->fetchAll();
 
  ?>
<html>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="tableadd.js"></script>



<div class="container">

  <table  class="table table-bordered table-striped mt-5">
      <thead>
        <tr>
          <th>Item Name</th>
          <th>Item</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($row as $key => $value) {?>
          
        <tr>
          <td><?php echo $value['item_name'];?></td>
          <td><?php echo $value['item_qty'];?></td>
          <td><?php echo $value['item_price'];?></td>
        </tr>
      <?php } ?>
        <!-- <tr>
          <td>Orange</td>
          <td>5</td>
          <td>1000</td>
        </tr>
        <tr>
          <td>Stawberry</td>
          <td>5</td>
          <td>1000</td>
        </tr>
        <tr>
          <td>Grape</td>
          <td>5</td>
          <td>1000</td>
        </tr> -->

      </tbody>
    </table>
  
    <!-- //Add Invoice -->
    <h4 class="mb-4">New Invoice</h4>
    <form action="invoiceadd.php" method="POST">
      <div class="row mb-2">
        <div class="col-md-2">
          <p>Invoice Name</p>
        </div>
        <div class="col-md-3">
          <input type="text" name="invoiceno" class="form-control" id="invoiceno"> 
        </div>
        <div class="col-md-7">
        </div>
      </div>

      <div class="row clearfix">
        <div class="col-md-12">
          <table class="table table-bordered table-hover" id="tab_logic">
            <thead>
              <tr>
                <th class="text-center"> # </th>
                <th class="text-center"> Item Name </th>
                <th class="text-center"> 0 of Item </th>
                <th class="text-center"> Price </th>
                <th class="text-center"> Total </th>
              </tr>
            </thead>
            <tbody>
              <tr id='addr0'>
                <td>1</td>
                <td><input type="text" name='product[]'  placeholder='Enter Item Name' class="form-control product" id="product" /></td>
                <td><input type="number" name='qty[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0" /></td>
                <td><input type="number" name='price[]' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0"/></td>
                <td><input type="number" name='total[]' placeholder='0.00' class="form-control total" readonly/></td>
              </tr>
              <tr id='addr1'></tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-md-12">
          <a id="add_row" class="btn btn-outline-dark float-left">Add Row</a>
          <a id='delete_row' class="float-right btn btn-outline-info">Delete Row</a>
        </div>
      </div>
      <div class="row clearfix" style="margin-top:20px">
        <div class="float-left col-md-8">
        </div>
        <div class="float-right col-md-4">
          <table class="table table-bordered table-hover" id="tab_logic_total">
            <tbody>
              <tr>
                <th class="text-center">Sub Total</th>
                <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
              </tr>
              <tr>
                <th class="text-center">Tax</th>
                <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                    <input type="number" class="form-control" id="tax" placeholder="0" min="0" name="tax">
                    
                  </div></td>
              </tr>
              <tr>
                <th class="text-center">Tax Amount</th>
                <td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control" readonly/></td>
              </tr>
              <tr>
                <th class="text-center">Total</th>
                <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="row clearfix mb-3">
        <div class="col-md-12">
          <button type="submit" class="btn btn-outline-dark float-left">Create</button>
        </div>
      </div>
    </form>

</div>

