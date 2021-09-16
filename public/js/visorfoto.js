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

$(".tablaProductos tbody").on("click", "a.avisoAlertaProducto", function(event){
    event.preventDefault();
    const href = $(this).attr("href");
    console.log(href)

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
            console.log(document.location.href)
        }
    });
})


// function AlertaEliminar(){
//     Swal.fire({
//         icon: "warning",
//         title: "¿Estas seguro?",
//         text: "¡No podrás revertir esto!",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "¡Sí, bórralo!"
//     }).then((result)=>{
//         if(result.isConfirmed){
//             Swal.fire(
//                 "¡Eliminado!",
//                 "El usuario ha sido eliminado.",
//                 "success")
//         }
//     });
// }
//AGREGANDO nuevo codigo dependiente de la categoria
$(".nuevaCategoria").change(function(){
    var valor = $(".nuevaCategoria").val();
    // console.log(valor);

    $.ajax({
        method: "GET",
        url: "/productos/buscar",
        dataType: "json",
        success: function(res){
            var buscar = res[valor - 1];

            if(!buscar){
                var nuevoCodigo = valor + "01";
                $("#nuevoCodigo").val(nuevoCodigo);
            }else{
                var codigo = buscar["code"];
                var nuevoCodigo = Number(codigo) + 1;
                $("#nuevoCodigo").val(nuevoCodigo);
            }
            // console.log("nuevoCodigo", buscar);
        }
    })

})

//AGREGANDO PRECIO DE VENTA EN FUNCION al PRECIO DE VENTA
$("#precioCompra").change(function() {

    if($("#ventaporcentaje").prop("checked")){
        var valorCompra = $("#precioCompra").val();
        var valorPorcentaje = $("#valorPorcentaje").val();
    
        var resultado = Number(valorCompra * valorPorcentaje / 100) + Number(valorCompra);
    
        $("#precioVenta").val(resultado);
        $("#precioVenta").prop("readonly", true);
    }
})
//AGREGANDO PRECIO DE VENTA EN FUNCION al al PORCENTAJE
$("#valorPorcentaje").change(function() {
    if($(".ventaporcentaje").prop('checked', true)){
        var valorCompra = $("#precioCompra").val();
        var valorPorcentaje = $("#valorPorcentaje").val();
    
        var resultado = Number(valorCompra * valorPorcentaje / 100) + Number(valorCompra);
    
        $("#precioVenta").val(resultado);
        $("#precioVenta").prop("readonly", true);
    }
})
//cuando checked esta DESBLOQUEDO 
$("#ventaporcentaje").on("click", function() {

        $("#precioVenta").prop("readonly", false);
    
});


//mascara de los imputs
//Datemask dd/mm/yyyy
$('#datemask').inputmask('yyyy/mm/dd', { 'placeholder': 'yyyy/mm/dd' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask()