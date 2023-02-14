$("#vender").click(function (e) { 
    e.preventDefault();
    var datos = new FormData();
    datos.append('total', $("input[name=total]").val())
    datos.append('pago', $("input[name=pago]").val())
    datos.append('cambio',$("input[name=cambio]").val())
    fetch('../includes/terminarVenta.php', {
        method: 'POST',
        body: datos
    }).then((res) => res.json()).then((Response) => {
        if(Response === "0Sucess"){
            Swal.fire({
                icon: 'success',
                title: 'Compra realizada correctamente, imprimiendo ticket...',
                showConfirmButton: false,
                timer: 4000
              })
        }
        if(Response === "0Error"){
            Swal.fire({
                icon: 'warning',
                title: 'Se realizo la venta, pero no se pudo imprimir el ticket verifique la impresora',
                showConfirmButton: false,
                timer: 2500
              })
        }
        if(Response === "1Error"){
            Swal.fire({
                icon: 'error',
                title: 'No se guardo la compra debido a un error contacte al administrador',
                showConfirmButton: false,
                timer: 2500
              })
        }

    })
});