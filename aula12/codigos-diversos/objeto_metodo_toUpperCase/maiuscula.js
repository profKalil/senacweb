function maiuscula(){
  var letra = document.getElementById("texto").value;
  letra = letra.toUpperCase();
  document.getElementById("texto").value = letra;
}