
$(".login").on("submit", function (e) {

  var $this = $(this),
    $state = $this.find("button > .state");
  $this.addClass("loading");
  $state.html("Authenticating");
  setTimeout(function () {
    $this.addClass("ok");
    $state.html("Welcome back!");
    setTimeout(function () {
      $state.html("Log in");
      $this.removeClass("ok loading");

    }, 400000);
    document.getElementById("log").submit(); 
  }, 10000);
});

var elemento = document.getElementsByClassName("wrapper");
console.log(elemento);

function mostrar() {
  document.getElementsByClassName("wrapper")[0].style.visibility = "visible";
  document.getElementsByClassName("lg-shadow-layer")[0].style.visibility = "visible";
  document.getElementsByClassName("lg-shadow-layer")[0].style.zIndex = "2";
  document.getElementsByClassName("wrapper")[0].style.cursor = "pointer"; 

}

function oculto() {
  document.getElementsByClassName("wrapper")[0].style.visibility = "hidden";
  document.getElementsByClassName("lg-shadow-layer")[0].style.visibility = "hidden";
}

document.getElementsByClassName("wrapper")[0].addEventListener("click", function(){
    if (event.target.tagName === "ARTICLE") {
      document.getElementsByClassName("wrapper")[0].style.visibility = "hidden";
      document.getElementsByClassName("lg-shadow-layer")[0].style.visibility = "hidden";
    }



}); 