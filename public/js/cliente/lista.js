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
        CEP.consulta(App.campos.cep);
    },
    salvar: function(event){

        if(!event.valid()){
            return false;
        }

        $.ajax({
            url: App.formulario.attr('action'),
            method: App.formulario.attr('method'),
            dataType: "json",
            data: { 
                _token : App._token,
                dados : App.formulario.serialize(),
            },
            beforeSend: function () {
                Util.processing();
            },
            success: function (data) {
                setTimeout(() => { 
                    Util.hideAll();
                    bootbox.alert(data.message, function(){ 
                        window.location.href = window.BASE_HREF + 'admin/clientes';
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
        App.botoes.btnSalvar.on('click', function (event) {
            event.preventDefault();
            Form.validation(App.formulario);
            App.salvar(App.formulario);
        });

        App.clienteDatatable.on('click', '.btn-show', function (event) {
            event.preventDefault();            
            window.location.href = $(this).data('href');
        });

        App.clienteDatatable.on('click', '.btn-edit', function (event) { 
            event.preventDefault();
            window.location.href = $(this).data('href');
        });

        App.clienteDatatable.on('click', '.btn-destroy', function (event) { 
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
        App.clienteDatatable.DataTable(
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
        App.iniciarCampos();
        App.iniciarBotoes();
        App.iniciarClienteDatatable();
        App.iniciarMascaras();
    }
};