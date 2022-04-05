function soloLetras(e){
    var teclado = (document.all)?e.keyCode:e.which;
    if(teclado == 8)return true;

    var patron = /^[a-zA-ZÀ-ÿ\s]{1,40}$/;

    var prueba = String.fromCharCode(teclado);
    return patron.test(prueba);
}
