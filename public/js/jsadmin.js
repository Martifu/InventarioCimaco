$("#menu-toggle").click(function (e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

$(document).ready(function () {
    $('#buscador').keyup(function () {

        var rex = new RegExp($(this).val(), 'i');
        $('#tabledatasucursales tr').hide();
        $('#tabledatasucursales tr').filter(function () {
            return rex.test($(this).text());
        }).show();

    });

    /*
    $('#tablesucursales').DataTable();
    $('#tableproductos').DataTable();
    $('#tablerepartidores').DataTable();
    $('#tableusuarios').DataTable();
*/

    $("#selectubicacionsu").on("change", function () {
        var value = $(this).val().toLowerCase();
        $("#tabledatasucursales tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#selectstadosu").on("change", function () {
        var value = $(this).val().toLowerCase();
        console.log(value);
        $("#tabledatasucursales tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    //Registrar nueva sucursal

    $('#guardarsucu').click(function () {
        $('#alerta').remove();
        nomsuc = $('#inpnomsucursal').val();
        diresu = $('#inpdiresucursal').val();
        telsu = $('#inptelesucursal').val();
        ubisu = $('#inpubisucursal').val();
        stasu = $('#estadosucursal').val();
        token = $("input[name = '_token']").val();
        tr = "";
        err = "";
        contenido = $('#notifiacion');
        $.ajax({
            url: "/registrarsucursal",
            data: {nombresu: nomsuc, diresuc: diresu, telesu: telsu, ubicsu: ubisu, statsu: stasu, _token: token},
            type: "POST",
            datatype: "json",
            success: function (response) {
                console.log(response);
                $('#tablesucursales').prepend("<tr class='item" + response.parametros.id + "'><input type='hidden' class='id col1' value=" + response.parametros.id + "><td>" + response.parametros.nombre + "</td><td>" + response.parametros.direccion + "</td><td>" + response.parametros.telefono + "</td><td>" + response.parametros.ubicacion + "</td><td>" + response.parametros.estado + "</td><td><button class='btn btn-warning' data-id=" + response.parametros.id + " data-toggle='modal' data-target='#modaleditarsucursal' id='btneditarsucur'>Editar</button><button class='btn btn-danger' data-id='" + response.parametros.id + "' data-toggle='modal' data-target='#modalconfirmar' id='btneliminarsu'>Eliminar</button></td></tr>");
                err = "<div id='alerta' class='alert alert-info'>" + response.respuesta + "</div>";
                contenido.append(err);
                $('.col1').each(function (index) {
                    $(this).html(index + 1);
                });
                $('#alerta').show().delay(10000).fadeOut("fast");
                $('#addsucursalmodal').modal('hide');
            }
        });
    });

    tabla = $('#tablesucursales');

    //Cargar datos sucursal - editar
    tabla.on('click', '#btneditarsucur', function () {
        idsucursal = $(this).parent().parent().find('.id').val();
        nombresucursal = $('#inpnomsucursaledit');
        diresucur = $('#inpdiresucursaledit');
        telesucur = $('#inptelesucursaledit');
        ubisucurs = $('#inpubisucursaledit');
        statussuc = $('#estadosucursaledit');
        idsucurs = $('#inpidsuscursalinp');
        token = $("input[name = '_token']").val();
      
        $.ajax({
            url: '/cargarsucursal',
            type: 'POST',
            datatype: 'JSON',
            data: {id: idsucursal, token: token},
            success: function (response) {
                console.log(response)
                nombresucursal.val(response.datos[0].nombre);
                diresucur.val(response.datos[0].direccion);
                telesucur.val(response.datos[0].telefono);
                statussuc.val(response.datos[0].estado);
                ubisucurs.val(response.datos[0].ubicacion);
                idsucurs.val(response.datos[0].id);
            }
        });
    });

    //Editar sucursal

    $('#editarsucu').on('click', function () {
        $('#alerta').remove();
        idsucursal = $('#inpidsuscursalinp').val();
        nombresucuredit = $('#inpnomsucursaledit').val();
        direccionsucursal = $('#inpdiresucursaledit').val();
        telefonosuscursal = $('#inptelesucursaledit').val();
        ubicacionsucursal = $('#inpubisucursaledit').val();
        statussucursal = document.getElementById("estadosucursaledit").value;
        token = $("input[name = '_token']").val();
        contenido = $('#notifiacion');
        err = "";
        $.ajax({
            type: 'POST',
            data: {
                id: idsucursal,
                token: token,
                nombresu: nombresucuredit,
                direcsu: direccionsucursal,
                telefonosu: telefonosuscursal,
                ubicacionsu: ubicacionsucursal,
                statusucu: statussucursal
            },
            datatype: 'JSON',
            url: '/editarsucursal',
            success: function (response) {
                console.log(response);
                err = "<div id='alerta' class='alert alert-success'>" + response.Mensaje + "</div>";
                contenido.append(err);
                $('.item' + response.datos.id).replaceWith("<tr class='item" + response.datos.id + "'><input type='hidden' class='id col1' value='" + response.datos.id + "'><td>" + response.datos.nombre + "</td><td>" + response.datos.direccion + "</td><td>" + response.datos.telefono + "</td><td>" + response.datos.ubicacion + "</td><td>" + response.datos.estado + "</td>" +
                    "<td><button class='btn btn-warning' data-toggle='modal' data-target='#modaleditarsucursal' id='btneditarsucur'>Editar</button><button class='btn btn-danger' data-id='{{$sucursal->id}}' data-toggle='modal' data-target='#modalconfirmar' id='btneliminarsu'>Eliminar</button></td></tr>");
                $('.col1').each(function (index) {
                    $(this).html(index + 1);
                });
                $('#alerta').show().delay(4000).fadeOut("fast");
                $('#modaleditarsucursal').modal('hide');
            }
        });
    });


    //Cargar-Sucursal-Eliminar
    tabla.on('click', '#btneliminarsu', function () {
        idsucursal = $(this).parent().parent().find('.id').val();
        idsucursalcar = $('#ideliminar');
        nombresucucarg = $('#nombresu');
        token = $("input[name = '_token']").val();
        $.ajax({
            url: '/cargarsucursal',
            type: 'POST',
            datatype: 'JSON',
            data: {id: idsucursal, token: token},
            success: function (response) {
                idsucursalcar.val(response.datos[0].id);
                nombresucucarg.val(response.datos[0].nombre);
            }
        });
    });


    //ELiminar sucursal
    $('#borrar').on('click', function () {
        $('#alerta').remove();
        ideliminar = $('#ideliminar').val();
        token = $("input[name = '_token']").val();
        contenido = $('#notifiacion');
        err = "";
        $.ajax({
            type: 'POST',
            data: {id: idsucursal, token: token},
            datatype: 'JSON',
            url: '/eliminarsucursal',
            success: function (response) {
                $('.item' + response['id']).remove();
                $('.col1').each(function (index) {
                    $(this).html(index + 1);
                });
                err = "<div id='alerta' class='alert alert-success'>" + response.Mensaje + "</div>";
                contenido.append(err);

                $('#alerta').show().delay(4000).fadeOut("fast");
            }
        });
    });


    //REPARTIDORES

    //Guardar repartidor
    $('#guardarrepa').click(function () {
        $('#alerta').remove();
        nombrerepa = $('#inpnomrepa').val();
        apellidorepa = $('#inaperepa').val();
        teleforepa = $('#inptelre').val();
        correre = $('#inemailre').val();
        zonare = $('#inzonare').val();
        token = $("input[name = '_token']").val();
        tr = "";
        err = "";
        contenido = $('#notifiacion');
        $.ajax({
            url: "/registrarrepartidor",
            data: {
                nombrerepar: nombrerepa,
                apellidorepar: apellidorepa,
                teleforepar: teleforepa,
                correore: correre,
                zonre: zonare,
                _token: token
            },
            type: "POST",
            datatype: "json",
            success: function (response) {
                console.log(response);
                $('#tablerepartidores').prepend("<tr class='item" + response.Persona.id + "'><input type='hidden' class='id col1' value=" + response.Persona.id + "><td>" + response.Persona.Nombre + "</td><td>" + response.Persona.Apellido + "</td><td>" + response.Persona.Telefono + "</td><td>" + response.Repartidor.correo + "</td><td>" + response.Repartidor.zona + "</td><td></td><td><button class='btn btn-warning' data-id=" + response.Persona.id + " data-toggle='modal' data-target='#editreparti' id='btneditrepa'>Editar</button><button class='btn btn-danger' data-id='" + response.Persona.id + "' data-toggle='modal' data-target='#modalconfirmareliminar' id='btneliminarrepa'>Eliminar</button></td></tr>");
                err = "<div id='alerta' class='alert alert-info'>" + response.mensaje + "</div>";
                contenido.append(err);
                $('.col1').each(function (index) {
                    $(this).html(index + 1);
                });
                $('#alerta').show().delay(10000).fadeOut("fast");
                $('#addrepartidor').modal('hide');
            }
        });
    });

    tablarepartidor = $('#tablerepartidores');

    //Cargar datos repartidor - editar
    tablarepartidor.on('click', '#btneditrepa', function () {
        idrepar = $(this).parent().parent().find('.id').val();
        nomrepa = $('#inpnomrepacar');
        aperepa = $('#inaperepacar');
        telerepa = $('#inptelrecar');
        correpa = $('#inemailrecar');
        zonarepa = $('#inzonarecar');
        idinpre = $('#inpidre');
        token = $("input[name = '_token']").val();
        $.ajax({
            url: '/cargarrepartidor',
            type: 'POST',
            datatype: 'JSON',
            data: {id: idrepar, token: token},
            success: function (response) {
                console.log(response);
                nomrepa.val(response.datos[0].persona.Nombre);
                aperepa.val(response.datos[0].persona.Apellido);
                telerepa.val(response.datos[0].persona.Telefono);
                correpa.val(response.datos[0].correo);
                zonarepa.val(response.datos[0].zona);
                idinpre.val(response.datos[0].id);
            }
        });
    });

    $('#guardarrepaedt').on('click', function () {
        $('#alerta').remove();
        idrepartidor = $('#inpidre').val();
        nombrerepar = $('#inpnomrepacar').val();
        apellrepa = $('#inaperepacar').val();
        telefonorepa = $('#inptelrecar').val();
        correorepar = $('#inemailrecar').val();
        zonarepar = $('#inzonarecar').val();
        token = $("input[name = '_token']").val();
        contenido = $('#notifiacion');
        err = "";
        $.ajax({
            type: 'POST',
            data: {
                id: idrepartidor,
                token: token,
                nombrepartido: nombrerepar,
                apellidore: apellrepa,
                teleforepart: telefonorepa,
                emailrepa: correorepar,
                zonarepart: zonarepar
            },
            datatype: 'JSON',
            url: '/editarrepartidor',
            success: function (response) {
                console.log(response);
                err = "<div id='alerta' class='alert alert-success'>" + response.Mensaje + "</div>";
                contenido.append(err);
                $('.item' + response.datos2.id).replaceWith("<tr class='item" + response.datos2.id + "'><input type='hidden' class='id col1' value='" + response.datos2.id + "'><td>" + response.datos.Nombre + "</td><td>" + response.datos.Apellido + "</td><td>" + response.datos.Telefono + "</td><td>" + response.datos2.correo + "</td><td>" + response.datos2.zona + "</td><td></td>" +
                    "<td><button class='btn btn-warning' data-toggle='modal' data-target='#editreparti' id='btneditrepa'>Editar</button><button class='btn btn-danger' data-id='" + response.datos.id + "' data-toggle='modal' data-target='#modalconfirmareliminar' id='btneliminarrepa'>Eliminar</button></td></tr>");
                $('.col1').each(function (index) {
                    $(this).html(index + 1);
                });
                $('#alerta').show().delay(4000).fadeOut("fast");
                $('#editreparti').modal('hide');
            }
        });
    });

    //Cargar-Repartidor-Eliminar
    tablarepartidor.on('click', '#btneliminarrepa', function () {
        idrepartidorr = $(this).parent().parent().find('.id').val();
        idrepart = $('#ideliminarre');
        nombrerepart = $('#nombrerepa');
        token = $("input[name = '_token']").val();
        $.ajax({
            url: '/cargarrepartidor',
            type: 'POST',
            datatype: 'JSON',
            data: {id: idrepartidorr, token: token},
            success: function (response) {
                console.log(response);
                idrepart.val(response.datos[0].id);
                nombrerepart.val(response.datos[0].Nombre);
            }
        });
    });

    $('#btneliminarep').on('click', function () {
        $('#alerta').remove();
        ideliminarep = $('#ideliminarre').val();
        token = $("input[name = '_token']").val();
        contenido = $('#notifiacion');
        err = "";
        $.ajax({
            type: 'POST',
            data: {id: ideliminarep, token: token},
            datatype: 'JSON',
            url: '/eliminarrepartidor',
            success: function (response) {
                $('.item' + response['id']).remove();
                $('.col1').each(function (index) {
                    $(this).html(index + 1);
                });
                err = "<div id='alerta' class='alert alert-success'>" + response.Mensaje + "</div>";
                contenido.append(err);

                $('#alerta').show().delay(4000).fadeOut("fast");
            }
        });
    });

    // Membresias
    $('#savemembre').on('click', function () {
        $('#alerta').remove();
        tipoplan = $('#inptiplan').val();
        precioplan = $('#inpreplan').val();
        descplan = $('#inpdesplan').val();
        detaplan = $('#inpdeplan').val();
        token = $("input[name = '_token']").val();
        tr = "";
        err = "";
        contenido = $('#notifiacion');
        $.ajax({
            url: "/registrarmembresia",
            data: {
                preplan: precioplan,
                desplan: descplan,
                detplan: detaplan,
                tipplan: tipoplan,
                _token: token
            },
            type: "POST",
            datatype: "json",
            success: function (response) {
                console.log(response);
                $('#tablemembresias').prepend("<tr class='item" + response.membresia.id + "'><input type='hidden' class='id col1' value=" + response.membresia.id + "><td>" + response.membresia.tipo + "</td><td>$" + response.membresia.precio + "</td><td>" + response.membresia.Descripcion + "</td><td><button class='btn btn-warning' data-id=" + response.membresia.id + " data-toggle='modal' data-target='#editmembresia' id='btneditmembre'>Editar</button><button class='btn btn-danger' data-id='" + response.membresia.id + "' data-toggle='modal' data-target='#modalconfirmareliminarmem' id='btnelimirplan'>Eliminar</button></td></tr>");
                err = "<div id='alerta' class='alert alert-info'>" + response.mensaje + "</div>";
                contenido.append(err);
                $('.col1').each(function (index) {
                    $(this).html(index + 1);
                });
                $('#alerta').show().delay(3000).fadeOut("fast");
                $('#addmembresia').modal('hide');
            }
        });
    });


    tablamembresias = $('#tablemembresias');

    //Cargar datos membresia - editar
    tablamembresias.on('click', '#btneditmembre', function () {
        idmem = $(this).parent().parent().find('.id').val();
        tipomem = $('#inptiplanedit');
        premem = $('#inpreplanedit');
        descmem = $('#inpdesplanedit');
        detamem = $('#inpdeplanedit');
        idmembresia = $('#inpeditid');
        token = $("input[name = '_token']").val();
        $.ajax({
            url: '/cargarmembresia',
            type: 'POST',
            datatype: 'JSON',
            data: {id: idmem, token: token},
            success: function (response) {
                console.log(response);
                tipomem.val(response.datos[0].tipo);
                premem.val(response.datos[0].Precio);
                descmem.val(response.datos[0].Descripcion);
                detamem.val(response.datos[0].detalles);
                idmembresia.val(response.datos[0].id);
            }
        });
    });

    $('#savemembreedit').on('click', function () {
        $('#alerta').remove();
        idmembresia = $('#inpeditid').val();
        tipomembre = $('#inptiplanedit').val();
        preciomembre = $('#inpreplanedit').val();
        descripmembre = $('#inpdesplanedit').val();
        detallmembre = $('#inpdeplanedit').val();
        token = $("input[name = '_token']").val();
        contenido = $('#notifiacion');
        err = "";
        $.ajax({
            type: 'POST',
            data: {
                id: idmembresia,
                token: token,
                tipome: tipomembre,
                premembre: preciomembre,
                descrimembre: descripmembre,
                detallememb: detallmembre,
            },
            datatype: 'JSON',
            url: '/editarmembresia',
            success: function (response) {
                console.log(response);
                err = "<div id='alerta' class='alert alert-success'>" + response.Mensaje + "</div>";
                contenido.append(err);
                $('.item' + response.datos.id).replaceWith("<tr class='item" + response.datos.id + "'><input type='hidden' class='id col1' value='" + response.datos.id + "'><td>" + response.datos.tipo + "</td><td>" + response.datos.precio + "</td><td>" + response.datos.Descripcion + "</td><td><button class='btn btn-warning' data-toggle='modal' data-target='#editmembresia' id='btneditmembre'>Editar</button><button class='btn btn-danger' data-id='" + response.datos.id + "' data-toggle='modal' data-target='#modalconfirmareliminarmem' id='btnelimirplan'>Eliminar</button></td></tr>");
                $('.col1').each(function (index) {
                    $(this).html(index + 1);
                });
                $('#alerta').show().delay(4000).fadeOut("fast");
                $('#editmembresia').modal('hide');
            }
        });
    });

    //Cargar-Membresias-Eliminar
    tablamembresias.on('click', '#btnelimirplan', function () {
        idmembresi = $(this).parent().parent().find('.id').val();
        idplan = $('#ideliminarplan');
        tipopplan = $('#notipoplan');
        token = $("input[name = '_token']").val();
        $.ajax({
            url: '/cargarmembresia',
            type: 'POST',
            datatype: 'JSON',
            data: {id: idmembresi, token: token},
            success: function (response) {
                console.log(response);
                idplan.val(response.datos[0].id);
                tipopplan.val(response.datos[0].tipo);
            }
        });
    });

    //Eliminar Membresia
    $('#btneliminarmembre').on('click', function () {
        $('#alerta').remove();
        idplanel = $('#ideliminarplan').val();
        token = $("input[name = '_token']").val();
        contenido = $('#notifiacion');
        err = "";
        $.ajax({
            type: 'POST',
            data: {id: idplanel, token: token},
            datatype: 'JSON',
            url: '/eliminarmembresia',
            success: function (response) {
                $('.item' + response['id']).remove();
                $('.col1').each(function (index) {
                    $(this).html(index + 1);
                });
                err = "<div id='alerta' class='alert alert-success'>" + response.Mensaje + "</div>";
                contenido.append(err);

                $('#alerta').show().delay(4000).fadeOut("fast");
            }
        });
    });


    //Productos

    $('#saveproducto').on('click', function () {
        $('#alerta').remove();
        nompro = $('#inpnompro').val();
        servpro = $('#inserpro').val();
        preciopro = $('#inprepro').val();
        detallpro = $('#indepro').val();
        token = $("input[name = '_token']").val();
        tr = "";
        err = "";
        contenido = $('#notifiacion');
        $.ajax({
            url: "/registrarproducto",
            data: {
                nompro: nompro,
                servpro: servpro,
                preciopro: preciopro,
                detallpro: detallpro,
                _token: token
            },
            type: "POST",
            datatype: "json",
            success: function (response) {
                console.log(response);
                $('#tableproductos').prepend("<tr class='item" + response.producto.id + "'><input type='hidden' class='id col1' value=" + response.producto.id + "><td>" + response.producto.producto + "</td><td>$" + response.producto.precio + "</td><td><button class='btn btn-warning' data-id=" + response.producto.id + " data-toggle='modal' data-target='#modaleditproducto' id='btneditprodu'>Editar</button><button class='btn btn-danger' data-id='" + response.producto.id + "' data-toggle='modal' data-target='#modalconfirmareliprod' id='btneliminarpro'>Eliminar</button></td></tr>");
                err = "<div id='alerta' class='alert alert-info'>" + response.mensaje + "</div>";
                contenido.append(err);
                $('.col1').each(function (index) {
                    $(this).html(index + 1);
                });
                $('#alerta').show().delay(10000).fadeOut("fast");
                $('#addproductos').modal('hide');
            }
        });
    });

    tablaproductos = $('#tableproductos');

    //Cargar datos membresia - editar
    tablaproductos.on('click', '#btneditprodu', function () {
        idproducto = $(this).parent().parent().find('.id').val();
        nomprodu = $('#inpnomproedit');
        preciopro = $('#inpreproedit');
        serviproduc = $('#inserproedit');
        detallproduc = $('#indeproedit');
        idproin = $('#idproducto');
        token = $("input[name = '_token']").val();
        $.ajax({
            url: '/cargarproducto',
            type: 'POST',
            datatype: 'JSON',
            data: {id: idproducto, token: token},
            success: function (response) {
                console.log(response);
                nomprodu.val(response.datos['producto']);
                preciopro.val(response.datos['precio']);
                serviproduc.val(response.datos['servicio']);
                detallproduc.val(response.datos['detalles']);
                idproin.val(response.datos['id']);
            }
        });
    });


    //Editar producto
    $('#saveproductoedit').on('click', function () {
        $('#alerta').remove();
        idproductosave = $('#idproducto').val();
        nomprodusave = $('#inpnomproedit').val();
        precioprosave = $('#inpreproedit').val();
        serviproducsave = $('#inserproedit').val();
        detallproducsave = $('#indeproedit').val();
        token = $("input[name = '_token']").val();
        contenido = $('#notifiacion');
        err = "";
        $.ajax({
            type: 'POST',
            data: {
                id: idproductosave,
                token: token,
                nomprodusave: nomprodusave,
                precioprosave: precioprosave,
                serviproducsave: serviproducsave,
                detallproducsave: detallproducsave,
            },
            datatype: 'JSON',
            url: '/editarproducto',
            success: function (response) {
                console.log(response);
                err = "<div id='alerta' class='alert alert-success'>" + response.Mensaje + "</div>";
                contenido.append(err);
                $('.item' + response.datos.id).replaceWith("<tr class='item" + response.datos.id + "'><input type='hidden' class='id col1' value='" + response.datos.id + "'><td>" + response.datos.producto + "</td><td>$" + response.datos.precio + "</td><td><button class='btn btn-warning' data-toggle='modal' data-target='#modaleditproducto' id='btneditprodu'>Editar</button><button class='btn btn-danger' data-id='" + response.datos.id + "' data-toggle='modal' data-target='#modalconfirmareliprod' id='btneliminarpro'>Eliminar</button></td></tr>");
                $('.col1').each(function (index) {
                    $(this).html(index + 1);
                });
                $('#alerta').show().delay(4000).fadeOut("fast");
                $('#modaleditproducto').modal('hide');
            }
        });
    });

    //Cargar-Membresias-Eliminar
    tablaproductos.on('click', '#btneliminarpro', function () {
        idproddele = $(this).parent().parent().find('.id').val();
        diproductoid = $('#ideliminarproducto');
        nomproducto = $('#nombreproducto');
        token = $("input[name = '_token']").val();
        $.ajax({
            url: '/cargarproducto',
            type: 'POST',
            datatype: 'JSON',
            data: {id: idproddele, token: token},
            success: function (response) {
                console.log(response);
                diproductoid.val(response.datos['id']);
                nomproducto.val(response.datos['producto']);
            }
        });
    });

    //Eliminar Producto
    $('#btneliminarproducto').on('click', function () {
        $('#alerta').remove();
        idproductoeli = $('#ideliminarproducto').val();
        token = $("input[name = '_token']").val();
        contenido = $('#notifiacion');
        err = "";
        $.ajax({
            type: 'POST',
            data: {id: idproductoeli, token: token},
            datatype: 'JSON',
            url: '/eliminarproducto',
            success: function (response) {
                $('.item' + response['id']).remove();
                $('.col1').each(function (index) {
                    $(this).html(index + 1);
                });
                err = "<div id='alerta' class='alert alert-success'>" + response.Mensaje + "</div>";
                contenido.append(err);

                $('#alerta').show().delay(4000).fadeOut("fast");
            }
        });
    });

    //Login

    $('.btnin').click(function () {
        $('#alerta').remove();
        var usuario = $('#inputcorreo').val();
        var password = $('#inputpass').val();
        token = $("input[name = '_token']").val();
        err = "";
        contenido = $('#notifiacion');
        $.ajax({
            data: {usuario: usuario, password: password, _token: token},
            datatype: 'JSON',
            type: 'post',
            url: '/logeos',
            success: function (response) {
                console.log(response);

                if (response.respuesta==1)
                {
                    location.href = '/administrador/sucursales';
                }
                else
                {
                    err = "<div id='alerta' class='alert alert-danger'>" + response.Mensaje + "</div>";
                    contenido.append(err);
                }

            }
        });

    });



});




