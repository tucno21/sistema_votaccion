// SUBIENDO LA FOTO DEL USUSARIO
$(".visorFoto").change(function(){
    var imagen = this.files[0];
    // console.log("image", imagen);


    //validar imagen
    if(imagen["type"] != "image/jpg" && imagen["type"] != "image/png" && imagen["type"] != "image/jpeg"){
        $(".visorFoto").val("");
        Swal.fire({
            title: "Error al subir imagen",
            text: "la imagen debe ser de formato JPQ o PNG",
            icon: "error",
            confirmButtonText:"Cerrar"
        });
    }else if(imagen["size"] > 1000000){
        $(".visorFoto").val("");
        Swal.fire({
            title: "Error de tamaño de imagen",
            text: "la imagen no debe pesar mas de 1MB",
            icon: "error",
            confirmButtonText:"Cerrar"
        });
    }else{
        //clase de js hace lectura de archivo
        var datosImagen = new FileReader;
        //leer como dato url la imagen cargada
        datosImagen.readAsDataURL(imagen);

        //la ruta de ña imagen reemplazar
        $(datosImagen).on("load", function(event){
            //
            var rutaImagen = event.target.result;
            // console.log("image", rutaImagen);

            $(".previsualizar").attr("src", rutaImagen);
        });
    }
})

// SUBIENDO LA FOTO DEL USUSARIO
$(".visorLogo").change(function(){
    var imagen = this.files[0];
    // console.log("image", imagen);


    //validar imagen
    if(imagen["type"] != "image/jpg" && imagen["type"] != "image/png" && imagen["type"] != "image/jpeg"){
        $(".visorLogo").val("");
        Swal.fire({
            title: "Error al subir imagen",
            text: "la imagen debe ser de formato JPQ o PNG",
            icon: "error",
            confirmButtonText:"Cerrar"
        });
    }else if(imagen["size"] > 1000000){
        $(".visorLogo").val("");
        Swal.fire({
            title: "Error de tamaño de imagen",
            text: "la imagen no debe pesar mas de 1MB",
            icon: "error",
            confirmButtonText:"Cerrar"
        });
    }else{
        //clase de js hace lectura de archivo
        var datosImagen = new FileReader;
        //leer como dato url la imagen cargada
        datosImagen.readAsDataURL(imagen);

        //la ruta de ña imagen reemplazar
        $(datosImagen).on("load", function(event){
            //
            var rutaImagen = event.target.result;
            // console.log("image", rutaImagen);

            $(".previsualizar2").attr("src", rutaImagen);
        });
    }
})

$(".avisoAlertaxx").on("click", function(event){
    event.preventDefault();
    const href = $(this).attr("href");
    // console.log(href)

    Swal.fire({
        icon: "warning",
        title: "¿Estas seguro?",
        text: "¡No podrás revertir esto!",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí, bórralo!"
    }).then((result)=>{
        if(result.isConfirmed){
            document.location.href = href;
            // console.log(document.location.href)
        }
    });
})
