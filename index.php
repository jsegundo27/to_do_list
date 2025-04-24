
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
            <textarea class="form-control" id="descripcion-edit" name="titulo-edit"></textarea>
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
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function(){

   
     $.ajax({
            url:"php/tarea/tareas_list.php",
            type:"GET",
            success: function(response){
                 var list_tareas=$("#lista_tareas");
                 var data=JSON.parse(response);
                    data.forEach(tarea => {
              
                  
                    var tarea_des=tareaEstado(tarea.estado);
                    

                     lista=`<li class="card card-list p-3 mb-3">
                                <h4>${tarea.titulo}</h4>
                                <p>${tarea.descripcion}</p>
                                <div class="btn btn-${tarea_des[0]} mb-2" style="border-radius: 50%; "> 
                                  <i class="fa fa-${tarea_des[1]} ${tarea_des[2]} "></i>
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
     });

     $(document).on("click",".btn-eliminar",function(e){
        var id = $(this).data("id");
        Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url:"php/tarea/tareas_eliminar.php",
                            data:{codigo:id},
                            type:"POST",
                            success: function(response){
                                actualizarDatos();
                            }
        });
                    }
                });
        
     });

     $(document).on("click",".btn-editar",function(e){
        var id = $(this).data("id");
        $.ajax({
            url:"php/tarea/tareas_edit.php",
            data:{codigo:id},
            type:"POST",
            success: function(response){
               var data=JSON.parse(response);
               console.log(data);
               var titulo= $("#titulo-edit");
               var descripcion=$("#descripcion-edit"); 
               var id = $("#id-tarea");
               id.val(data[0]["id"]);

               titulo.val(data[0]["titulo"]);
               descripcion.val(data[0]["descripcion"]);
              

            }
        });
     });
     
     $(document).on("click",".btn-estado",function(e){
        var id = $(this).data("id");
        $.ajax({
            url:"php/tarea/tareas_estado.php",
            data:{codigo:id},
            type:"POST",
            success: function(response){
               var data=JSON.parse(response);
               toastr.success(data);
               actualizarDatos();

            }
        });
     });

     //create tarea
    $("#form-tarea").submit(function(e){
        e.preventDefault();

        var titulo =$("#titulo").val();
        var descripcion=$("#descripcion").val();
        validarCampos();    
        $.ajax({
            url:"php/tarea/tareas_create.php",
            data:{titulo:titulo,descripcion:descripcion},
            type:"POST",
            success: function(response){

                var data=response;
                if (data.status === "success") {
                    toastr.success(data.message);
                    actualizarDatos(); // o recargar la lista
                } else {
                    toastr.error(data.message);
                }

            }
        });
    });
   
     $("#form-tarea-editar").submit(function(e){
        e.preventDefault();
        var id = $("#id-tarea").val();
        console.log(id);
        var titulo =$("#titulo-edit").val();
        var descripcion=$("#descripcion-edit").val();
        $.ajax({
            url:"php/tarea/tareas_update.php",
            data:{codigo:id,titulo:titulo,descripcion:descripcion},
            type:"POST",
            success: function(response){
               var data=JSON.parse(response);
               toastr.success('¡Tarea editada con éxito!');
               actualizarDatos();

            }
        });
     });

      
     

     function tareaEstado(estado){      
            if (estado == 1) {
                color="primary";
                icono="check";
                clas="";
            }else{
                color="warning";
                icono="exclamation";
                clas="p-1";
            }

            let lista = [color, icono, clas];

            return lista ;
     }


     function validarCampos(){
        var titulo=$("#titulo").val();
        var descripcion=$("#descripcion").val();
        if (titulo=="" || descripcion=="") {
            toastr.warning('Advertencia: falta llenar campos');
        }
     }

     function actualizarDatos(){
        $("#loader").fadeIn();
        setTimeout(() => {
        location.reload();
     }, 1000);
     }
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


             