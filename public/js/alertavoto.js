
$(".avisoAlertaxx").on("click", function(event){
    event.preventDefault();
    const href = $(this).attr("link");
    // console.log(href);

    Swal.fire({
        icon: "warning",
        title: "¿Estas seguro de tu voto?",
        text: "¡No podrás cambiar esto!",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí, Votaré!"
    }).then((result)=>{
        if(result.isConfirmed){
            document.location.href = href;
        }
    });
})