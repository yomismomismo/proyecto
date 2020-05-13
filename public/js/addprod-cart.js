
    function removeItemDrop()
    {
        // var productRow = $(removeButton).parent().parent().parent();
        // productRow.slideUp(fadeTime, function() {
        //   productRow.remove();
        //   recalculateCart();
        console.log("hola");
          
    // })}
    }
let addprod = document.getElementById("addcart")

document.addEventListener('DOMContentLoaded', () => {
  window.setTimeout(() => {
addprod.addEventListener("click", function () {
    let lista= document.getElementById("cd-cart-items")
    let productocard = document.createElement("li")
    lista.appendChild(productocard)
    let classproducto = document.createElement("div")
    classproducto.className="producto"
    productocard.appendChild(classproducto)
    let canti = document.getElementById("cantidad")
    let name = document.getElementById("nameprod")
    let cantidad = document.createElement("span")
    let precio = document.getElementById("product-price-detalle")
    let precio1= precio.textContent.split("€")
    
    cantidad.className="cd-qty"
    cantidad.textContent="X" + canti.value
    classproducto.appendChild(cantidad)
    let nombre = document.createElement("span")
    nombre.className="cd-name"
    nombre.textContent=" "+name.textContent
    classproducto.appendChild(nombre)
    let preci = document.createElement("span")
    preci.textContent="P.V.P: "+precio.textContent
    classproducto.appendChild(preci)
    let subprecio = document.createElement("span")
    subprecio.className="product-price"
    let salto = document.createElement("br")
    nombre.appendChild(salto)
    let ressubprecio= canti.value * parseInt(precio1[0])
    subprecio.textContent=" Total: "+ ressubprecio + "€"
    classproducto.appendChild(subprecio)
    let eliminar = document.createElement("div")
    eliminar.className="product-removal-drop"
    classproducto.appendChild(eliminar)
    let enlaceborrar = document.createElement("a")
    enlaceborrar.href="javascript:;"
    enlaceborrar.setAttribute('onclick',"removeItemDrop()")
    enlaceborrar.setAttribute('role',"button")
    eliminar.appendChild(enlaceborrar)
    let botoneliminar = document.createElement("button")
    botoneliminar.id="button-cart-drop"
    botoneliminar.className="cd-item-remove cd-img-replace"
    botoneliminar.href="javascript:;"
    botoneliminar.onclick="removeItemDrop()"
    enlaceborrar.appendChild(botoneliminar)
  })

}, 500)
})
