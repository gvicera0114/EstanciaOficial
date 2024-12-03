function validacionc(){
    if(document.frm1.nombre.value.length==0){
        document.getElementById("nombre").focus();
        return false;
    }
    if(document.frm1.apellido.value.length==0){
        document.getElementById("apellido").focus();
        return false;
    }
    if(document.frm1.telefono.value.length==0){
        document.getElementById("telefono").focus();
        return false;
    }
    if(document.frm1.email.value.length==0){
        document.getElementById("email").focus();
        return false;
    }
    frm1.submit();
}
