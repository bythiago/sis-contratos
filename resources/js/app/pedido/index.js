export default {

    formulario: null,
    campos: {
        cliente: null
    },
    botoes: [],
    elementos: [],

    iniciarCampos: function () {

        //token
        Pedido.default._token = $('meta[name="csrf-token"]').attr('content');

        //table
        Pedido.default.datatable = $("#pedido-table");

        //formulario
        Pedido.default.formulario = $("#formulario-lista");

        //campos
        Pedido.default.campos.cliente = $("#pedido-cliente");
        Pedido.default.campos.produto = $("#pedido-produto");
        Pedido.default.campos.autocomplete = $("#pedido-id-produto");

        //botoes
        Pedido.default.botoes.btnSalvar = $("#btn-salvar");

        //utils
        Util.default.formatarPalavras();
        Form.default.select2(Pedido.default.campos.cliente);
        Form.default.select2(Pedido.default.campos.produto);
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
                setTimeout(() => { 
                    Util.default.hideAll();
                    bootbox.alert(data.message, function(){ 
                        window.location.href = window.BASE_HREF + 'admin/pedidos';
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

        Pedido.default.datatable.on('click', '.btn-destroy', function (event) { 
            event.preventDefault();

            const data = {
                pedido: $(this).data('pedido'),
                href: $(this).data('href')
            };

            bootbox.confirm({
                message: `Você tem certeza que deseja cancelar o <strong>Pedido ${data.Pedido.default.id}</strong>?`,
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
                id : dados.Pedido.default.id
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
    iniciarDatatable: function () {
        Pedido.default.datatable.DataTable(
            {
                "order": [[ 0, "desc" ]],
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
        Pedido.default.iniciarCampos();
        Pedido.default.iniciarBotoes();
        Pedido.default.iniciarDatatable();
        Pedido.default.iniciarMascaras();
    }
};