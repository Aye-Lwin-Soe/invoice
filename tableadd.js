$(document).ready(function(){
    var i=1;
    $("#add_row").click(function(){b=i-1;
      	$('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
      	$('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      	i++; 
  	});
    $("#delete_row").click(function(){
    	if(i>1){
		$("#addr"+(i-1)).html('');
		i--;
		}
		calc();
	});
    var j = $('.updatedata').data('id');
	$("#update_row").click(function(){
		
		b=j-1;
      	$('#updateaddr'+j).html($('#updateaddr'+b).html()).find('td:first-child').html(j+1);
      	$('#updatetab_logic').append('<tr id="updateaddr'+(j+1)+'"></tr>');
      	j++; 
  	});
    $("#updatedelete_row").click(function(){
    	if(j>1){
		$("#updateaddr"+(j-1)).html('');
		j--;
		}
		calcupdate();
	});
	
	$('#tab_logic tbody').on('keyup change',function(){
		calc();
	});

	$('#updatetab_logic tbody').on('keyup change',function(){
		calcupdate();
	});

	$('#tax').on('keyup change',function(){
		calc_total();
	});



	$('#updatetax').on('keyup change',function(){
		updatecalc_total();
	});
	

});

function calc()
{
	$('#tab_logic tbody tr').each(function(i, element) {
		var html = $(this).html();
		if(html!='')
		{
			var qty = $(this).find('.qty').val();
			var price = $(this).find('.price').val();
			$(this).find('.total').val(qty*price);
			
			calc_total();
		}
    });
}

function calcupdate()
{
	$('#updatetab_logic tbody tr').each(function(i, element) {
		var html = $(this).html();
		if(html!='')
		{
			var qty = $(this).find('.qty').val();
			var price = $(this).find('.price').val();
			$(this).find('.updatetotal').val(qty*price);
			
			updatecalc_total();
		}
    });
}

function calc_total()
{
	total=0;
	$('.total').each(function() {
        total += parseInt($(this).val());
    });
	$('#sub_total').val(total.toFixed(2));
	tax_sum=total/100*$('#tax').val();
	$('#tax_amount').val(tax_sum.toFixed(2));
	$('#total_amount').val((tax_sum+total).toFixed(2));
}

function updatecalc_total()
{
	total=0;
	$('.updatetotal').each(function() {
        total += parseInt($(this).val());
    });
	$('#sub_total').val(total.toFixed(2));
	tax_sum=total/100*$('#updatetax').val();
	$('#tax_amount').val(tax_sum.toFixed(2));
	$('#total_amount').val((tax_sum+total).toFixed(2));
}