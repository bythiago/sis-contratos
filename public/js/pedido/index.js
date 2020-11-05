$(function () {
    setTimeout(function () {
        Pedido.iniciar();
    }, 100);
});

Pedido = {
    formulario: null,
    campos: {
        cliente: null
    },
    botoes: [],
    elementos: [],

    iniciarCampos: function () {

        //token
        Pedido._token = $('meta[name="csrf-token"]').attr('content');

        //table
        Pedido.datatable = $("#pedido-table");

        //formulario
        Pedido.formulario = $("#formulario-lista");

        //campos
        Pedido.campos.cliente = $("#pedido-cliente");
        Pedido.campos.produto = $("#pedido-produto");

        //botoes
        Pedido.botoes.btnSalvar = $("#btn-salvar");

        //utils
        Util.formatarPalavras();
        Util.select2(Pedido.campos.cliente);
        Util.select2(Pedido.campos.produto);
    },
    salvar: function(event){

        if(!event.valid()){
            return false;
        }

        $.ajax({
            url: Pedido.formulario.attr('action'),
            method: Pedido.formulario.attr('method'),
            dataType: "json",
            data: { 
                _token : Pedido._token,
                dados : Pedido.formulario.serialize(),
            },
            beforeSend: function () {
                Util.processing();
            },
            success: function (data) {
                setTimeout(() => { 
                    Util.hideAll();
                    bootbox.alert(data.message, function(){ 
                        window.location.href = window.BASE_HREF + 'pedidos';
                    });
                }, 250);
            },
            error: function (error) {
                bootbox.alert(error.responseJSON.message, function(){ 
                    window.location.reload()
                });
            }
        });
    },
    iniciarBotoes: function() {
        Pedido.botoes.btnSalvar.on('click', function (event) {
            event.preventDefault();
            Form.validation(Pedido.formulario);
            Pedido.salvar(Pedido.formulario);
        });

        Pedido.datatable.on('click', '.btn-show', function (event) {
            event.preventDefault();            
            window.location.href = $(this).data('href');
        });

        Pedido.datatable.on('click', '.btn-edit', function (event) { 
            event.preventDefault();
            window.location.href = $(this).data('href');
        });

        Pedido.datatable.on('click', '.btn-destroy', function (event) { 
            event.preventDefault();

            const data = {
                pedido: $(this).data('pedido'),
                href: $(this).data('href')
            };

            bootbox.confirm({
                message: `Você tem certeza que deseja cancelar o <strong>Pedido ${data.pedido.id}</strong>?`,
                buttons: {
                    confirm: {
                        label: 'Sim',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'Não',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if(result === true){
                        Pedido.deletar(data);
                    }
                }
            });
        });
    },
    deletar: function(dados){
        $.ajax({
            url: `${dados.href}`,
            method: "DELETE",
            data: { 
                _token : Pedido._token,
                id : dados.pedido.id
            },
            beforeSend: function () {
                //Util.processing();
            },
            success: function (success) {
                Util.hideAll();
                bootbox.alert(success.message, function(){
                    window.location.reload();
                });
            },
            error: function (error) {
                console.log(error);
                Util.hideAll();
                bootbox.alert(error.statusText, function(){
                    window.location.reload();
                });
            }
        })
    },
    iniciarDatatable: function () {
        Pedido.datatable.DataTable(
            {
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json"
                }
            }
        );
    },
    iniciarMascaras: function (){
        Inputmask().mask(document.querySelectorAll("input"));
    },
    iniciar: function () {
        Pedido.iniciarCampos();
        Pedido.iniciarBotoes();
        Pedido.iniciarDatatable();
        Pedido.iniciarMascaras();
    }
};