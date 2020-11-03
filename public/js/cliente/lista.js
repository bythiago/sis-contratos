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
        App._token = $('meta[name="csrf-token"]').attr('content');
        App.campos.nome = $("#cliente-nome");
        App.campos.cep = $("#cep");

        //
        App.clienteDatatable = $("#cliente-table");

        //
        App.formulario = $("#formulario-lista");

        //
        App.botoes.btnSalvar = $("#btn-salvar");

        //
        Util.formatarPalavras();

        //
        CEP.buscaCEP(App.campos.cep);
    },
    salvar: function(event){

        if(!event.valid()){
            return false;
        }

        $.ajax({
            url: App.formulario.attr('action'),
            method: "POST",
            dataType: "json",
            data: { 
                _token : App._token,
                dados : App.formulario.serialize(),
            },
            beforeSend: function () {
                // Util.processing();
            },
            success: function (data) {
                Util.hideAll();
                bootbox.alert("This is an alert with a callback!", function(){ 
                    console.log('This was logged in the callback!'); 
                });
            },
            error: function (error) {
                console.log(error);
            }
        });
    },
    iniciarBotoes: function() {
        App.botoes.btnSalvar.on('click', function (event) {
            event.preventDefault();
            Form.validation(App.formulario);
            App.salvar(App.formulario);
        });

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
            });

        });

        App.clienteDatatable.on('click', '.btn-editar', function (event) { 
            event.preventDefault();
            const clienteId = $(this).data('id');
            console.log(clienteId);
        });

        App.clienteDatatable.on('click', '.btn-excluir', function (event) { 
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
    enviarDeleteCliente: function(dados){
        $.ajax({
            url: `${dados.href}`,
            method: "DELETE",
            data: { 
                _token : App._token,
                clienteId : dados.cliente.id
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