$(document).ready( function () {
    $('#table_id').DataTable({
        order: [[1, 'desc']],
        language: {
            processing:     "Tratamiento en curso...",
            search:         "Buscar:" ,
            lengthMenu:    "Mostrar _MENU_ Ventas",
            info:           "Mostrando de la venta_START_ al _END_ de un total de _TOTAL_ ventas",
            infoEmpty:      "No existen registros",
            infoFiltered:   "(filtrado de _MAX_ ventas en total)",
            infoPostFix:    "",
            loadingRecords: "Cargando elementos...",
            zeroRecords:    "No se encontraron los datos de tu busqueda..",
            emptyTable:     "No hay ningun registro en la tabla",
            paginate: {
                first:      "Primero",
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "Ultimo"
            },
            aria: {
                sortAscending:  ": Active para odernar en modo ascendente",
                sortDescending: ": Active para ordenar en modo descendente  ",
            }
}
    } );
} );
