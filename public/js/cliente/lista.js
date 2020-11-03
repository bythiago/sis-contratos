$(function () {
    setTimeout(function () {
        App.iniciar();
    }, 100);
});

App = {
    formulario: null,
    campos: [],
    botoes: [],
    elementos: [],

    iniciarCampos: function () {

        //
        App.campos.nome = $("#cliente-nome");
        App.campos.cep = $("#cep");

        //
        App.clienteDatatable = $("#cliente-table");

        //
        Util.formatarPalavras();

        //
        CEP.buscaCEP(App.campos.cep);
    },
    iniciarBotoes: function() {
        let clienteId = null;

        App.clienteDatatable.on('click', '.btn-detalhes', function (event) {
            event.preventDefault();
            const clienteId = $(this).data('id');
            console.log(clienteId);

            $.ajax({
                url: `${window.location.origin}/html/php/laravel/sis-contratos/public/index.php/clientes/lista/${clienteId}`,
                method: "GET",
                data: { 
                    // _token : myself.token,
                    // dados : dados,
                    // perguntas: perguntas
                },
                beforeSend: function () {
                    Util.processing();
                },
                success: function (data) {
                    const message = App.iniciarDadosCliente(data);

                    Util.hideAll();
                    bootbox.dialog({
                        title: `Cliente: ${data.cliente.nome}`,
                        message : message,
                        size: 'large'
                    });
                },
                error: function (error) {
                    console.log(error);
                }
            })

        });

        App.clienteDatatable.on('click', '.btn-editar', function (event) { 
            event.preventDefault();
            const clienteId = $(this).data('id');
            console.log(clienteId);
        });

        App.clienteDatatable.on('click', '.btn-deletar', function (event) { 
            event.preventDefault();

            const data = {
                cliente: $(this).data('cliente'),
                href: $(this).data('href')
            };

            bootbox.confirm({
                message: `Você tem certeza que deseja excluir o cliente <strong>${data.cliente.nome}</strong>?`,
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
                        App.enviarDeleteCliente(data);
                    }
                }
            });
        });
    },
    enviarDeleteCliente: function(data){
        $.ajax({
            url: `${data.href}`,
            method: "GET",
            // data: { 
            //     // _token : myself.token,
            //     // dados : dados,
            //     // perguntas: perguntas
            // },
            beforeSend: function () {
                Util.processing();
            },
            success: function (success) {
                Util.hideAll();
                bootbox.alert(success.message, function(){
                    window.location.reload();
                });
            },
            error: function (error) {
                Util.hideAll();
                console.log(error);
            }
        })
    },
    iniciarDadosCliente: function(dados){ 
        return ``;
    },
    iniciarClienteDatatable: function () {
        App.clienteDatatable.DataTable();
    },
    iniciarMascaras: function (){
        Inputmask().mask(document.querySelectorAll("input"));
    },
    iniciar: function () {
        App.iniciarCampos();
        App.iniciarBotoes();
        App.iniciarClienteDatatable();
        App.iniciarMascaras();
    }
};