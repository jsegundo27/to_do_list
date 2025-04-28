
<!DOCTYPE html>
<html lang="en">
<head>
<!--Este codigo esta modificado por jonatha-dev -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1241b5bdda.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    
<div class="container-loader">
    <div id="loader"  style="display:none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
    z-index: 9999;">
    <div class="loader"></div>
    </div>
</div>

<div class="main-tarea">
    <div class="section1">
            <div class="tarea-datos">
                    <div class="contenedor-img">
                    <img src="assets/img/user-admin.png" alt="">
                    </div>
                    <div class="contendor-info">
                        <h4>Nombre y Apellidos:</h4>
                        <p>Edwin Jonathan Segundo Chavez</p>
                        <h4>carrera:</h4>
                        <p>Ingnieria Sistemas</p>
                        <h4>correo:</h4>
                        <p>edwin@gmail.com</p>
                    </div>
            </div>
            <div class="tarea-formulario">
                <form  id="form-tarea">
                    <div class="forn-control">
                    
                        <input class="form-control" type="text"  placeholder="Ingrese la tarea" id="titulo" name="titulo">
                    </div>
                    <div class="forn-control">
                        <textarea class="form-control" type="text" id="descripcion" name="descripcion"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">Agregar Tarea</button>
                </form>
            </div>
    </div>

    <div class="section2">
        <div class="tareas-lista">
            <ul id="lista_tareas"></ul>
        </div>
    </div>

</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-warning"  >
        <h5 class="modal-title" id="exampleModalLabel">Editar Tarea</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-tarea-editar">
          <div class="form-group">
            <input type="hidden" id="id-tarea" name="id-tarea">
            <label for="recipient-name" class="col-form-label">Título:</label>
            <input type="text" class="form-control" id="titulo-edit" name="titulo-edit">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label" >Descripción:</label>
            <textarea class="form-control" id="descripcion-edit" name="descripcion-edit"></textarea>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" >Editar</button>
        </form>
      </div>
    </div>
  </div>
</div>





<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function(){
   
    function init(){
        listarTareas();
    }

    function eventClick() {
        $(document).on('click', '.btn-eliminar',eventEliminarTarea);
        $(document).on("click",".btn-editar",eventCargarTarea);
        $(document).on("click",".btn-estado",eventActualizarEstado);
        $("#form-tarea").submit(eventCrearTarea)
        $("#form-tarea-editar").submit(eventActualizarTarea);
    }

     function eventCargarTarea(e){
        const id = $(this).data("id");
        cargarDatosTarea(id);
     }

     function eventActualizarTarea(e){
        e.preventDefault();
        var id = $("#id-tarea").val();
        var titulo =$("#titulo-edit").val();
        var descripcion=$("#descripcion-edit").val();
        actualizarDatos(id,titulo,descripcion);
     }

     function eventCrearTarea(e){
        e.preventDefault();
        var titulo =$("#titulo").val();
        var descripcion=$("#descripcion").val();
        crearTarea(titulo,descripcion);
     }

     function eventEliminarTarea(e){
        const id = $(this).data('id');
        eliminarTareas(id);
     }

     function eventActualizarEstado(){
        const id = $(this).data("id");
        actualizarEstado(id);
     }

    async function apiRequest(url, data = {}, method = 'POST') {
        let options = {
            method: method,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        };

        if (method.toUpperCase() === 'POST') {
            options.body = new URLSearchParams(data);
        }

        try {
            const response = await fetch(url, options);
            if (!response.ok) {
                throw new Error('Error en la solicitud');
            }
            return await response.json();
        } catch (error) {
            console.error('Error en apiRequest:', error);
            throw error; // Opcional: re-lanzar el error si quieres manejarlo afuera
        }
    }
/*
   async function listarTareas(){
        apiRequest("php/tarea/tareas_list.php",{},'GET')
        .then( data => {
            renderizarTareas(data);
        }).catch(() => {
            toastr.error('Error al listar tareas');
        });
    }*/
    async function listarTareas(){
        try {
        const tarea = await apiRequest("php/tarea/tareas_list.php",{},'GET');
        renderizarTareas(tarea);
        
        } catch (error) {
            toastr("error al listar tareas");
        }

    }
    function renderizarTareas(tareas){
       
        var list_tareas=$("#lista_tareas");
        list_tareas.empty();

        tareas.forEach(tarea => {

            const tareaEstadoInfo = tareaEstado(tarea.estado);
            const fecha = formatoFecha(tarea.fecha_inicio);
            var lista=`<li class="card card-list p-3 mb-3">
                        <p  style="color:#239b56;font-style: italic;font-weight:500">${fecha}</p>
                        <h4 style="text-align:center">${tarea.titulo}</h4>
                        <p>${tarea.descripcion}</p>
                        <div class="btn btn-${tareaEstadoInfo[0]} mb-2" style="border-radius: 50%; "> 
                            <i class="fa fa-${tareaEstadoInfo[1]} ${tareaEstadoInfo[2]} "></i>
                        </div>
                        <div style="display: flex; gap: 10px">
                            <a class="btn btn-warning fa fa-edit btn-editar" data-toggle="modal" 
                                data-target="#exampleModal" data-id="${tarea.id}"></a>
                            <a class="btn btn-secondary btn-estado fa fa-clock" data-id="${tarea.id}" ></a>
                            <a class="btn btn-danger btn-eliminar fa fa-trash" data-id="${tarea.id}" ></a>
                        </div>
                    </li> `
                list_tareas.append(lista); 
            
        });
    }

    function eliminarTareas(id){
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'})
        .then((result) => {
            if (result.isConfirmed) {
                apiRequest('php/tarea/tareas_eliminar.php', {codigo: id})
                .then(data =>{
                        if (data.status==="success") {
                            toastr.success(data.message);
                            listarTareas();    
                        } else {
                        toastr.error(data.message);
                        }
                });
            }
        });
    }

    function cargarDatosTarea(id) {
        apiRequest("php/tarea/tareas_edit.php",{codigo:id})
        .then(data => {

               if (data.status !=="error") {
                var titulo= $("#titulo-edit");
                var descripcion=$("#descripcion-edit"); 
                var id = $("#id-tarea");

                id.val(data[0]["id"]);
                titulo.val(data[0]["titulo"]);
                descripcion.val(data[0]["descripcion"]);
               } else {
                   toastr.error('Error al cargar tarea');
               }
        });
    }
     
    function actualizarEstado(id){
       apiRequest("php/tarea/tareas_estado.php",{codigo:id})
       .then(data=>{
               if (data.status==="success") {
                  toastr.success(data.message);
                  listarTareas();
               } else {
                  toastr.error(data.message);    
               }
       });
    }

    function crearTarea(titulo,descripcion){
        apiRequest("php/tarea/tareas_create.php",{titulo,descripcion})
        .then(data=>{

            if (data.status === "success") {
                toastr.success(data.message);
                limpiarForm();
                listarTareas(); 
            } else {
                toastr.error(data.message);
            }
        });
    }

    function limpiarForm(){
        $("#titulo").val("");
        $("#descripcion").val("");
    }
   
    function actualizarDatos(id,titulo,descripcion){
       apiRequest("php/tarea/tareas_update.php",{codigo:id,titulo,descripcion})
       .then(data=>{
            if (data.status==="success") {   
                toastr.success(data.message);
                listarTareas();
                $('#exampleModal').modal('hide'); // Cerrar modal al editar
                actualizarPage();
            }else if(data.status=="error"){
                toastr.error(data.message);
            }else{
                toastr.warning(data.message);
            }
       });
    }   
  
    function tareaEstado(estado){      
        if (estado == 1) {
            return ["primary", "check", ""];
        } else {
            return ["warning", "exclamation", "p-1"];
        }
    }

     function formatoFecha(fecha_inicio){
        const fecha = new Date(fecha_inicio.replace(" ", "T"));
        return new Intl.DateTimeFormat('es-PE', {
            year: 'numeric', month: '2-digit', day: '2-digit',
            hour: '2-digit', minute: '2-digit', hour12: true
        }).format(fecha);
    }

     function actualizarPage(){
        $("#loader").fadeIn();
        setTimeout(() => {
            location.reload();
        }, 1000);
     }

function obtenerUsuariosSoloFetch(){
   fetch("php/tarea/tareas_list.php") 
   .then(response=>response.json())
   .then(data=> console.log(data))
   .catch(error=>console.log("Error solo Fech :"+error))
}


async function obtenerUsuarios(){
    try {
        const response =  await fetch("php/tarea/tareas_list.php");
        const data= await response.json();
        console.log(data);
    } catch (error) {
        console.log("Error",error);
    }

}


async function obtenerDatosProfesionales(){
    try {
        $response= await fecht("",{
            method:'POST',
            header:{
                'Content-Type':'aplication/json'
            },
            body: JSON.stringify({
                titule:'Nuevo Post',
                body:'este contenido post',
                userId:1
            })
        });

        const data= await response.json();
        console.log('Post creado',data);

    } catch (error) {
        console.error("error",error);
    }
}

async function apiRequest(url, data = {}, method = 'POST') {
    let options = {
        method: method,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
    };

    if (method.toUpperCase() === 'POST') {
        options.body = new URLSearchParams(data);
    }

    try {
        const response = await fetch(url, options);
        if (!response.ok) {
            throw new Error('Error en la solicitud');
        }
        return await response.json();
    } catch (error) {
        console.error('Error en apiRequest:', error);
        throw error; // Opcional: re-lanzar el error si quieres manejarlo afuera
    }
}

obtenerUsuarios();
obtenerUsuariosSoloFetch();

     init();
     eventClick();
  });
        


</script>
</body>
</html>


 <!--
var li = $("<li>").addClass("card card-list p-3 mb-3");
li.append(`<h4>${tarea.nombre}</h4>`);
li.append(`<p>${tarea.descripcion}</p>`);
// y así sigues...
list_tareas.append(li);
-->  


             