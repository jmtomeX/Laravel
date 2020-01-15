function getTypes(categoria_id) {
    var categoria_id = $("#categoria_id").val();
    var tipo_id = $("#tipo_id");

    $.ajax({
        type: "GET",
        url: "{{ url('expenditures/types') }}/" + categoria_id,
        dataType: 'json',
        success: function(data) {
            //Por si hiciera falta:
            //var obj = JSON.parse(data); 
            console.log(data);
            console.log(data.res);
            if (data.res >= 0) {
                tipo_id.empty();
                tipo_id.removeAttr('disabled');
                data.datos.forEach(element => {
                    tipo_id.append("<option value='" + element.id + "'>" + element.description);
                    console.log(element.description);
                });

            } else {
                alert("No se han podido cargar los datos")
            }
        },
        error: function(data) {
            alert(" Error al recoger los datos");
        }
    });

}

