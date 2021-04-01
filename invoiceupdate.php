<?php 
	
	require 'db_connect.php';

	$today = date("Y-m-d");
	$month = date('M');
	$day = date('d');
	$year = date('Y');

	$invoicedate = $today;

	$product = $_POST['product'];
	/*var_dump($product);
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
	$invoicesql = "INSERT INTO invoices (invoicename, total, tax, invoicedate) VALUES(:invoicename, :total_amount, :tax, :invoicedate)";

    $invoice_stmt= $pdo->prepare($invoicesql);
	$invoice_stmt->bindParam(':invoicename',$invoicename);
	$invoice_stmt->bindParam(':total_amount',$total_amount);
	$invoice_stmt->bindParam(':tax',$tax);
	$invoice_stmt->bindParam(':invoicedate',$invoicedate);
	$invoice_stmt->execute();
	$invoiceid = $pdo->lastInsertId();

	for ($i=0; $i < count($product); $i++) { 
		$productname = $product[$i];
		$pricename = $price[$i];
		$qtyname = $qty[$i];
		
		$invoiceitemsql= "INSERT INTO invoice_items (item_name, item_qty, item_price,invoice_id) VALUES (:productname, :qtyname, :pricename,:invoiceid)";

		$invoiceitem_stmt= $pdo->prepare($invoiceitemsql);
		$invoiceitem_stmt->bindParam(':productname',$productname);
		$invoiceitem_stmt->bindParam(':qtyname',$qtyname);
		$invoiceitem_stmt->bindParam(':pricename',$pricename);
		$invoiceitem_stmt->bindParam(':invoiceid',$invoiceid);
		$invoiceitem_stmt->execute();
	}

	if($invoiceitem_stmt->rowCount()){
			header("Location:tableadd.html");
		}
		else{
			echo " Error !";
		}

?>

<?php  
	require 'db_connect.php';

	$id=$_POST['id'];
	$name=$_POST['name'];
	$category=$_POST['category'];


	$sql="UPDATE subcategories SET name=:name, category_id=:category  WHERE id=:id ";
	
	$stmt=$pdo->prepare($sql);
	$stmt->bindParam(':id',$id);
	$stmt->bindParam(':name',$name);
	$stmt->bindParam(':category',$category);

	$stmt->execute();

	if($stmt->rowCount())
	{
		header("location:subcategory_list");
	}
	else
	{
		echo "Error!";
	}
 ?>