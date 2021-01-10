export default {

    formulario: null,
    campos: [],
    botoes: [],
    elementos: [],

    iniciarCampos: function () {

        //token
        Pedido.default._token = $('meta[name="csrf-token"]').attr('content');

        //table
        Pedido.default.datatable = $("#pedido-table");

        //formulario
        Pedido.default.formulario = $("#formulario-pedido");

        //campos
        Pedido.default.campos.cliente = $("#pedido-cliente");
        Pedido.default.campos.produto = $("#pedido-produto");
        Pedido.default.campos.autocomplete = $("#pedido-id-produto");

        //botoes
        Pedido.default.botoes.btnSalvar = $("#btn-salvar");
        Pedido.default.botoes.btnAtualizar = $("#btn-update");

        //utils
        Form.default.autocomplete(Pedido.default.campos.autocomplete);
    },
    salvar: function(event){

        if(!event.valid()){
            return false;
        }
    
        $.ajax({
            url: Pedido.default.formulario.attr('action'),
            method: Pedido.default.formulario.attr('method'),
            dataType: "json",
            data: { 
                _token : Pedido.default._token,
                dados : Pedido.default.formulario.serialize(),
            },
            beforeSend: function () {
                Util.default.processing();
            },
            success: function (data) {
                Util.default.hideAll();
                setTimeout(() => { 
                    Util.default.hideAll();
                    bootbox.alert(data.message, function(){ 
                        window.location.href = $('#btn-salvar').data('redirect');
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
        Pedido.default.botoes.btnSalvar.on('click', function (event) {
            event.preventDefault();
            Form.default.validation(Pedido.default.formulario);
            Pedido.default.salvar(Pedido.default.formulario);
        });

        Pedido.default.datatable.on('click', '.btn-show', function (event) {
            event.preventDefault();            
            window.location.href = $(this).data('href');
        });

        Pedido.default.datatable.on('click', '.btn-edit', function (event) { 
            event.preventDefault();
            window.location.href = $(this).data('href');
        });

        Pedido.default.botoes.btnAtualizar.on('click', function (event) {
            event.preventDefault();

            const data = {
                pedido: $(this).data('pedido'),
                href: $(this).data('href'),
                redirect: $(this).data('redirect')
            };

            console.log(data);

            bootbox.confirm({
                message: `Você deseja concluir o orçamento do cliente <strong>${data.pedido.cliente.nome}</strong>?`,
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
                        Pedido.default.atualizar(data);
                    }
                }
            });
        })

        Pedido.default.datatable.on('click', '.btn-destroy', function (event) { 
            event.preventDefault();

            const data = {
                pedido: $(this).data('pedido'),
                href: $(this).data('href')
            };

            bootbox.confirm({
                message: `Você deseja remover o produto <strong>Pedido ${data.pedido.nome}</strong>?`,
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
                        Pedido.default.deletar(data);
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
                _token : Pedido.default._token,
                pedido: {
                    id_status: 2
                }
            },
            beforeSend: function () {
                //Util.default.processing();
            },
            success: function (success) {
                Util.default.hideAll();
                bootbox.alert(success.message, function(){
                    window.location.reload();
                });
            },
            error: function (error) {
                console.log(error);
                Util.default.hideAll();
                bootbox.alert(error.statusText, function(){
                    window.location.reload();
                });
            }
        })
    },
    atualizar: function(dados){
        console.log(dados);
        $.ajax({
            url: `${dados.href}`,
            method: "PUT",
            data: { 
                _token : Pedido.default._token,
                pedido: {
                    id_status: 3
                },
                orcamento: {
                    status: 2
                }
            },
            beforeSend: function () {
                //Util.default.processing();
            },
            success: function (success) {
                Util.default.hideAll();
                bootbox.alert(success.message, function(){
                    window.location.href = `${dados.redirect}`;
                });
            },
            error: function (error) {
                console.log(error);
                Util.default.hideAll();
                bootbox.alert(error.statusText, function(){
                    window.location.reload();
                });
            }
        })
    },
    iniciarDatatable: function () {
        Pedido.default.datatable.DataTable(
            {
                "order": [[ 0, "asc" ]],
                "scrollX": true,
                "language": {
                    "url": window.BASE_HREF + 'js/Portuguese-Brasil.json'
                }
            }
        );
    },
    iniciarMascaras: function (){
        Inputmask().mask(document.querySelectorAll("input"));
    },
    iniciar: function () {
        Pedido.default.iniciarCampos();
        Pedido.default.iniciarBotoes();
        Pedido.default.iniciarDatatable();
        Pedido.default.iniciarMascaras();
    }
};