<?php 
	
	require 'db_connect.php';

	$today = date("Y-m-d");
	$month = date('M');
	$day = date('d');
	$year = date('Y');
$invoiceitemsql= "SELECT * from invoice_items   WHERE invoice_id=1";var_dump($invoiceitemsql);die();
	$invoicedate = $today;

	$product = $_POST['product'];
	/*var_dump($product[0]);
	die();*/
	$qty = $_POST['qty'];
	$price = $_POST['price'];
	
	$invoicename = $_POST['invoiceno'];
	$total_amount = $_POST['total_amount'];
	$tax1 = $_POST['tax'];

	if($tax1 == ''){
		$tax = 0;
	}else{
		$tax = $tax1;
	}
	$invoicesql = "UPDATE invoices SET invoicename=:invoicename, total=:total_amount, tax=:tax, invoicedate=:invoicedate WHERE id=:id";
	$id = 1;
    $invoice_stmt= $pdo->prepare($invoicesql);
    $invoice_stmt->bindParam(':id',$id);
	$invoice_stmt->bindParam(':invoicename',$invoicename);
	$invoice_stmt->bindParam(':total_amount',$total_amount);
	$invoice_stmt->bindParam(':tax',$tax);
	$invoice_stmt->bindParam(':invoicedate',$invoicedate);
	$invoice_stmt->execute();
	$invoiceid = 1;

	for ($i=0; $i < count($product); $i++) { 
		$productname = $product[$i];
		$pricename = $price[$i];
		$qtyname = $qty[$i];
		
		$invoiceitemsql= "UPDATE invoice_items SET item_name=:productname, item_qty=:qtyname, item_price=:pricename WHERE invoice_id=:id";
		$invoiceitem_stmt= $pdo->prepare($invoiceitemsql);
		$invoiceitem_stmt->bindParam(':id',$id);
		$invoiceitem_stmt->bindParam(':productname',$productname);
		$invoiceitem_stmt->bindParam(':qtyname',$qtyname);
		$invoiceitem_stmt->bindParam(':pricename',$pricename);
		//$invoiceitem_stmt->bindParam(':invoiceid',$invoiceid);
		$invoiceitem_stmt->execute();

	}

	if($invoiceitem_stmt->rowCount()){
			header("Location:tableadd.php");
		}
		else{
			echo " Error !";
		}

?>
