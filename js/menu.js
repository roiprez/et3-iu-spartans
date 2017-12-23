/*
Este fichero se encarga de controlar el menú lateral de la aplicación
23/11/2017
*/

//La función muestra el submenu del menu clicado
function dropdownMenu(submenu) {
    //Dropdowns almacena todos los submenús
    let dropdowns = document.getElementsByClassName("dropdown-content"); 
    //recorre todos los submenús para cerrarlos si están abiertos (previene que si se clica inmediatamente en otro botón se abra más de un submenú al mismo tiempo)
    let i;
    for (i = 0; i < dropdowns.length; i++) {
        //Recoge submenú que corresponde al ciclo del bucle
        let openDropdown = dropdowns[i];
        //Si están visibles y son distintos del submenú que queremos abrir los oculta 
        if (openDropdown.classList.contains('show') && openDropdown != document.getElementById(submenu)) {
            openDropdown.classList.remove('show');
          }
      }
    //Abre el submenú que hemos seleccionado
    document.getElementById(submenu).classList.toggle("show");
}

//Cierra el submenú si se clica fuera de él
window.onclick = function(event) {
    //Si se clica fuera del área de los botones
    if (!event.target.matches('.dropbtn')) {
        let dropdowns = document.getElementsByClassName("dropdown-content");
        //recorre todos los submenús para cerrarlos si están abiertos y se clica fuera del área de los botones
        let i;
        for (i = 0; i < dropdowns.length; i++) {
            //Recoge submenú que corresponde al ciclo del bucle
            let openDropdown = dropdowns[i];
            //Si están visibles los oculta 
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}