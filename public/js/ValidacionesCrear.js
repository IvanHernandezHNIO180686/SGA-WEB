let expreNomyApe = /^[a-zA-ZÀ-ÿ\s]{1,40}$/;

function ValidarNuevaAuditoria() {
    var fecha = new Date(document.FnuevaAuditoria.FechaAuditoria.value);
    var fechaActual = new Date();


    if (document.FnuevaAuditoria.SiglasAuditoria.value.length == 0) {
        document.getElementById("SiglasAuditoria").focus();
        SiglasAud1.style.display = "none";
        SiglasAud2.style.display = "";
        return false;
    }
    if ((document.FnuevaAuditoria.SiglasAuditoria.value.trim().length > 5)) {
        document.getElementById("SiglasAuditoria").focus();
        SiglasAud1.style.display = "";
        SiglasAud2.style.display = "none";
        return false;
    }
    SiglasAud1.style.display = "none";
    SiglasAud2.style.display = "none";

    if ((document.FnuevaAuditoria.Organismo.value==0)) {
        document.getElementById("Organismo").focus();
        Organizacion.style.display = "";
        return false;
    }
    Organizacion.style.display = "none";

    if ((document.FnuevaAuditoria.FechaAuditoria.value == false)) {
        document.getElementById("FechaAuditoria").focus();
        fechaAud1.style.display = "";
        fechaAud2.style.display = "none";
        return false;
    }

    if (fecha < fechaActual) {
        document.getElementById("FechaAuditoria").focus();
        fechaAud1.style.display = "none";
        fechaAud2.style.display = "";
        return false;
    }
    fechaAud1.style.display = "none";
    fechaAud2.style.display = "none";

    if (document.FnuevaAuditoria.Tipo_Auditoria_id.value == 0) {
        document.getElementById("Tipo_Auditoria_id").focus();
        tipoAud.style.display = "";
        return false;
    }
    tipoAud.style.display = "none";

    FnuevaAuditoria.submit();
}

function ValidarNuevoComite() {
    if (document.FnuevoComite.SiglasComite.value.length == 0) {
        document.getElementById("SiglasComite").focus();
        SiglasCom1.style.display = "";
        SiglasCom2.style.display = "none";
        return false;
    }
    if (document.FnuevoComite.SiglasComite.value.trim().length > 5) {
        document.getElementById("SiglasComite").focus();
        SiglasCom1.style.display = "none";
        SiglasCom2.style.display = "";
        return false;
    }
    SiglasCom1.style.display = "none";
    SiglasCom2.style.display = "none";

    if (document.FnuevoComite.NombreComite.value.length == 0) {
        document.getElementById("NombreComite").focus();
        NombreCom1.style.display = "";
        NombreCom2.style.display = "none";
        return false;
    }
    if (document.FnuevoComite.NombreComite.value.trim().length < 5) {
        document.getElementById("NombreComite").focus();
        NombreCom1.style.display = "none";
        NombreCom2.style.display = "";
        return false;
    }
    NombreCom1.style.display = "none";
    NombreCom2.style.display = "none";

    if (document.FnuevoComite.idAuditoria.value == 0) {
        document.getElementById("idAuditoria").focus();
        idAud.style.display = "";
        return false;
    }
    idAud.style.display = "none";

    FnuevoComite.submit();
}

function ValidarNuevoUsuario() {

    //Validacion al campo del Nombre del Usuario
    if (document.FnuevoUsuario.Nombres.value.length == 0) {
        document.getElementById("Nombres").focus();
        NombresUser1.style.display = "";
        NombresUser2.style.display = "none";
        return false;
    }
    if (!expreNomyApe.test(document.FnuevoUsuario.Nombres.value)) {
        document.getElementById("Nombres").focus();
        NombresUser1.style.display = "none";
        NombresUser2.style.display = "";
        return false;
    }
    NombresUser1.style.display = "none";
    NombresUser2.style.display = "none";

    //Validacion al campo del Apellido Paterno del Usuario
    if (document.FnuevoUsuario.ApellidoPaterno.value.length == 0) {
        document.getElementById("ApellidoPaterno").focus();
        ApellidoP1.style.display = "";
        ApellidoP2.style.display = "none";
        return false;
    }
    if (!expreNomyApe.test(document.FnuevoUsuario.ApellidoPaterno.value)) {
        document.getElementById("ApellidoPaterno").focus();
        ApellidoP1.style.display = "none";
        ApellidoP2.style.display = "";
        return false;
    }
    ApellidoP1.style.display = "none";
    ApellidoP2.style.display = "none";


    //Validacion al campo del Puesto del Usuario
    if (document.FnuevoUsuario.Puesto.value.length == 0) {
        document.getElementById("Puesto").focus();
        PuestoUser.style.display = "";
        return false;
    }
    PuestoUser.style.display = "none";

    if (document.FnuevoUsuario.email.value.length == 0) {
        document.getElementById("email").focus();
        Correo.style.display = "";
        return false;
    }
    Correo.style.display = "none";

    if (document.FnuevoUsuario.password.value.length == 0) {
        document.getElementById("password").focus();
        Contra1.style.display = "";
        Contra2.style.display = "none";
        return false;
    }
    if (document.FnuevoUsuario.password.value.trim().length < 8) {
        document.getElementById("password").focus();
        Contra1.style.display = "none";
        Contra2.style.display = "";
        return false;
    }
    Contra1.style.display = "none";
    Contra2.style.display = "none";

   FnuevoUsuario.submit();
}

function ValidarNuevaReunion() {
    //Variables para poder comparar la fecha de la reunion
    var fecha = new Date(document.FnuevaReunion.FechaReunion.value);
    var fechaActual = new Date();

    //Validacion al campo Nombre de la Reunion
    if (document.FnuevaReunion.NombreReunion.value.length == 0) {
        document.getElementById("NombreReunion").focus();
        NombreJunta1.style.display = "";
        NombreJunta2.style.display = "none";
        return false;
    }
    if (!expreNomyApe.test(document.FnuevaReunion.NombreReunion.value)) {
        document.getElementById("NombreReunion").focus();
        NombreJunta1.style.display = "none";
        NombreJunta2.style.display = "";
        return false;
    }
    NombreJunta1.style.display = "none";
    NombreJunta2.style.display = "none";

    //Validacion al campo Auditoria de la Reunion
    if (document.FnuevaReunion.idAuditoria.value == 0) {
        document.getElementById("idAuditoria").focus();
        IDauditoria.style.display = "";
        return false;
    }
    IDauditoria.style.display = "none";

    //Validacion al campo fecha de la Reunion
    if ((document.FnuevaReunion.FechaReunion.value == false)) {
        document.getElementById("FechaReunion").focus();
        DiaReunion1.style.display = "";
        DiaReunion2.style.display = "none";
        return false;
    }
    if (fecha < fechaActual) {
        document.getElementById("FechaReunion").focus();
        DiaReunion1.style.display = "none";
        DiaReunion2.style.display = "";
        return false;
    }
    DiaReunion1.style.display = "none";
    DiaReunion2.style.display = "none";

    //Validacion al campo Tipo de Sesion de la Reunion
    if ((document.FnuevaReunion.TipoSesion.value == 0)) {
        document.getElementById("TipoSesion").focus();
        Sesion.style.display = "";
        return false;
    }
    Sesion.style.display = "none";

    FnuevaReunion.submit();
}

function ValidarNuevoAcuerdo() {
    //Variables para poder comparar la fecha de la reunion
    var fecha = new Date(document.FnuevoAcuerdo.FechaCumplimiento.value);
    var fechaActual = new Date();

    if ((document.FnuevoAcuerdo.idReunion.value == 0)) {
        document.getElementById("idReunion").focus();
        IDreunion.style.display = "";
        return false;
    }
    IDreunion.style.display = "none";

    if ((document.FnuevoAcuerdo.Responsable.value == 0)) {
        document.getElementById("Responsable").focus();
        Representante.style.display = "";
        return false;
    }
    Representante.style.display = "none";

    //Validacion al campo fechaCumplimiento del Acuerdo
    if ((document.FnuevoAcuerdo.FechaCumplimiento.value == false)) {
        document.getElementById("FechaCumplimiento").focus();
        DiaCumplimiento1.style.display = "";
        DiaCumplimiento2.style.display = "none";
        return false;
    }
    if (fecha < fechaActual) {
        document.getElementById("FechaCumplimiento").focus();
        DiaCumplimiento1.style.display = "none";
        DiaCumplimiento2.style.display = "";
        return false;
    }
    DiaCumplimiento1.style.display = "none";
    DiaCumplimiento2.style.display = "none";

    FnuevoAcuerdo.submit();
}


function ValidarNuevoAcuerdoReunion() {
    //Variables para poder comparar la fecha de la reunion
    var fecha = new Date(document.FnuevoAcuerdo.FechaCumplimiento.value);
    var fechaActual = new Date();


    if ((document.FnuevoAcuerdo.Responsable.value == 0)) {
        document.getElementById("Responsable").focus();
        Representante.style.display = "";
        return false;
    }
    Representante.style.display = "none";

    //Validacion al campo fechaCumplimiento del Acuerdo
    if ((document.FnuevoAcuerdo.FechaCumplimiento.value == false)) {
        document.getElementById("FechaCumplimiento").focus();
        DiaCumplimiento1.style.display = "";
        DiaCumplimiento2.style.display = "none";
        return false;
    }
    if (fecha < fechaActual) {
        document.getElementById("FechaCumplimiento").focus();
        DiaCumplimiento1.style.display = "none";
        DiaCumplimiento2.style.display = "";
        return false;
    }
    DiaCumplimiento1.style.display = "none";
    DiaCumplimiento2.style.display = "none";

    FnuevoAcuerdo.submit();
}
