var products=[];
products[0] = { id : "q1", name: "Fan", description : "Generic fan", price : "5.00" };
products[1] = { id : "q2", name: "Paper", description : "Generic paper", price : "3.50" };
products[2] = { id : "q3", name: "Soap", description : "Generic soap", price : "2.00" };
products[3] = { id : "q4", name: "Loaf", description : "Luncheon Loaf", price : "3.00" };


function updateCartTotalQ()
{
	var qTot = 0;
	var q;
	for(var i=1; i<=4; i++)
	{
		q=parseInt(localStorage.getItem("q" + i));
		if(isNaN(q)){ q=0; }
		qTot += q;
	}
	if(qTot==0)
	{
		document.getElementById("divCartSummary").innerHTML = "Your shopping cart is now <strong>empty</strong>!";	
	}
	else if(qTot==1)
	{
		document.getElementById("divCartSummary").innerHTML = "Your shopping cart currently contains <strong>1 item!</strong>";
	}
	else
	{
		document.getElementById("divCartSummary").innerHTML = "Your cart currently contains <br><strong>" + qTot + " items!</strong>";
	}
}

function add2Cart(product)
{	
	var quantity = parseInt(document.getElementById(product).value);
	if(isNaN(quantity)) { quantity = 1};
	if(isNaN(parseInt(localStorage.getItem(product))))
	{
		localStorage.setItem(product, quantity);
	}
	else
	{
		localStorage.setItem(product, parseInt(quantity) + parseInt(localStorage.getItem(product)));	
	}
	updateCartTotalQ();
}

function clearCart()
{
	localStorage.setItem('q1', '0');	
	localStorage.setItem('q2', '0');	
	localStorage.setItem('q3', '0');	
	localStorage.setItem('q4', '0');	
	updateCartTotalQ();
}

function showCart()
{
	var cartIsEmpty = true;
	var grandTotal=0;
	for(var i=0; i<products.length; i++)  // produce a table row for each item in the cart currently
	{
		var quantity = parseInt(localStorage.getItem(products[i].id));
		if(!isNaN(quantity) && quantity>0)
		{
			if(cartIsEmpty) 
			{
				document.write('<tr><th class="numericCol">Quantity</th><th>Description</th><th class="numericCol">Price</th><th class="numericCol">Product Total</th></tr>');
			}
			document.write('<tr><td class="numericCol">' + quantity + '</td><td>' + products[i].description + '</td><td class="numericCol">$' + products[i].price + '</td><td class="numericCol">$' + (quantity*products[i].price).toFixed(2) + '</td></tr>');
			grandTotal += (quantity*products[i].price);
			cartIsEmpty = false;
		}
		
	}
	if(cartIsEmpty)
	{
		document.write('<tr><td><strong>Your shopping cart is currently empty!<br><br>' +
		'We recommend you go straight to our <a href="shop.html">shopping page</a> to fill it up now!</td></tr>');
	}
	else
	{
        
        var subTotal=grandTotal;
        var tax=grandTotal*0.085;
        grandTotal+=tax;
		document.write('<tr><td style="text-align:right" colspan="3" >Subtotal: </td><td style="text-align:right">$' + subTotal.toFixed(2) + '</td></tr><tr><td style="text-align:right" colspan="3" >Tax: </td><td style="text-align:right">$' + tax.toFixed(2) + '</td></tr><tr><td style="text-align:right" colspan="3" ><strong>Grand total:</strong></td><td style="text-align:right"><strong>$' + grandTotal.toFixed(2) + '</strong></td></tr>');	
	}
}
