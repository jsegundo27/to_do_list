
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1241b5bdda.js" crossorigin="anonymous"></script>
    <style>
      body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg,rgb(44, 46, 48), #bdc3c7);
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
            padding: 0;
            opacity: 0;
            animation: aparecer 1s ease-in forwards;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
       }
      
        @keyframes aparecer {
            to {
                opacity: 2;
            }
        }

        .main-tarea, .section1, .section2, .card-list {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

        }
        .main-tarea{
            min-width: 1000px;
            width: 60%;
            display: flex !important;
           
            background:#fbfcfc;
            padding: 20px;
            border-radius: 8px;
     
        }
        .section1{
            width: 60%;
         
            padding: 15px;
            border-radius: 10px;
      
            margin: 10px;
        }
        .section2{
            width: 40%;
            padding: 8px;
            border-radius: 10px;
         
            margin: 10px;
        }
        .section1 img{
            max-width: 300px;
            border-radius: 50%;
        }
        .tarea-datos{
            display: flex;
            align-items: center;
            padding: 5px;
        }
        .forn-control{
            margin: 8px;
        }
        .contendor-info{
            padding: 20px;
        }
        .tarea-formulario{
            margin: 20px;
        }
        .tareas-lista {
            padding: 20px;
            max-height: 500px;
            overflow-y: auto;
        }
        .tareas-lista ul{
            margin: 0;
            padding: 0;
            list-style: none;
            overflow-y: auto; 
        }
       
         .card-list{
            display: flex;flex-direction:column;align-items: center;
            margin:10px;
            transition: all 0.3s ease-in-out;
         }
        
        .card-list:hover {
            transform: scale(1.02);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            background:  rgba(236, 236, 236, 0.3);
        }
    </style>
</head>
<body>
    
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
                    <form action="php/tarea/tareas_create.php" method="POST">
                        <div class="forn-control">
                            <input class="form-control" type="text"  placeholder="Ingrese la tarea" name="titulo">
                        </div>
                        <div class="forn-control">
                            <textarea class="form-control" type="text" name="descripcion">  </textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Agregar Tarea</button>
                    </form>
                </div>
        </div>

        <div class="section2">
            <div class="tareas-lista">
                <ul>
                    <li class="card card-list p-3 " >
                        <h4>Tarea 1</h4>
                        <p>Hacer limpieza tu casa</p>
                        <div class="btn btn-warning w-50">Pendiente</div>
                        <div style="display: flex;margin: 10px;">
                        <a class="btn btn-warning fa fa-edit mr-3" href=""></a><a class="btn btn-danger fa fa-trash" href=""></a>
                        </div>
                        
                    </li>
                    <li class="card card-list p-3 " >
                        <h4>Tarea 2</h4>
                        <p>Hacer limpieza tu casa</p>
                        <div class="btn btn-primary w-50">Terminado</div>
                        <div style="display: flex;margin: 10px;">
                        <a class="btn btn-warning fa fa-edit mr-3" href=""></a><a class="btn btn-danger fa fa-trash" href=""></a>
                        </div>
                        
                    </li>
                    <li class="card card-list p-3 " >
                        <h4>Tarea 3</h4>
                        <p>Hacer limpieza tu casa</p>
                        <div class="btn btn-warning w-50">Pendiente</div>
                        <div style="display: flex;margin: 10px;">
                        <a class="btn btn-warning fa fa-edit mr-3" href=""></a><a class="btn btn-danger fa fa-trash" href=""></a>
                        </div>
                        
                    </li>
                    <li class="card card-list p-3 " >
                        <h4>Tarea 4</h4>
                        <p>Hacer limpieza tu casa</p>
                        <div class="btn btn-primary w-50">Terminado</div>
                        <div style="display: flex;margin: 10px;">
                        <a class="btn btn-warning fa fa-edit mr-3" href=""></a><a class="btn btn-danger fa fa-trash" href=""></a>
                        </div>
                        
                    </li>
            
                   
                </ul>
            </div>
        </div>

   </div>










<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>
</html>


 <!--
    <section id="lista_tareas">
    

include ("php/tarea/tareas_list.php");
foreach(  $list_tareas as $tarea){
    echo $tarea["titulo"];
}

</section>
-->  