
        document.addEventListener('DOMContentLoaded', () => {
     window.setTimeout(() => {

/* Set rates + misc */
var taxRate = 0.21;
var fadeTime = 300;
let test = "";

$(document).ready(function() {
   test = $('#test').data("isTest");
});


/* Assign actions */
$('.product-quantity input').change( function() {
  updateQuantity(this);
});

$('.product-removal button').click( function() {
  removeItem(this);
});


/* Recalculate cart */
function recalculateCart()
{
  var subtotal = 0;
  
  /* Sum up row totals */
  $('.product').each(function () {
    subtotal += parseFloat($(this).children('.product-line-price').text());
  });
  
  /* Calculate totals */
  var tax = subtotal * taxRate;
  var shipping = 7;
  var totalNoShipping = 0;
  var totalNoShipping =  totalNoShipping + subtotal;
  var total = 0;
  var subNoIva = subtotal - tax;
  console.log(total + " fuera")
  
  if ( totalNoShipping >= 30 ) {
    shipping = 0;
    total = totalNoShipping;
  }
  else{
    total = total + subtotal + shipping;
  }

  
  /* Update totals display */
  $('.totals-value').fadeOut(fadeTime, function() {
    $('#cart-subtotal').html(subNoIva.toFixed(2));
    $('#cart-tax').html(tax.toFixed(2));
    $('#cart-shipping').html(shipping.toFixed(2));
    $('#cart-total').html(total.toFixed(2));
    if(total == 0){
      $('.checkout').fadeOut(fadeTime);
    }else{
      $('.checkout').fadeIn(fadeTime);
    }
    $('.totals-value').fadeIn(fadeTime);
  });
}


/* Update quantity */
function updateQuantity(quantityInput)
{




  /* Calculate line price */
  var productRow = $(quantityInput).parent().parent();


  var price = productRow.children('.product-price').text();

  var quantity = $(quantityInput).val();
  var linePrice = price * quantity;
  
  /* Update line price display and recalc cart totals */
  productRow.children('.product-line-price').each(function () {
    $(this).fadeOut(fadeTime, function() {
      $(this).text(linePrice.toFixed(2));
      recalculateCart();
      $(this).fadeIn(fadeTime);
    });
  });
  
  var delayInMilliseconds = 2000;
  
for (let i = 0; i < test.length; i++) {
  $('#cambio' + test[i]).change( function() {
    setTimeout(function() {
      document.getElementById("changeCantidad" + test[i]).submit();
    }, delayInMilliseconds);
  });
  
}}

/* Remove item from cart */
function removeItem(removeButton)
{
  /* Remove row from DOM and recalc cart total */
  var productRow = $(removeButton).parent().parent();
  productRow.slideUp(fadeTime, function() {
    productRow.remove();
    recalculateCart();
  });
}

 }, 800)
})
