$(function () {
    setTimeout(function () {
        Produto.iniciar();
    }, 100);
});

Produto = {
    formulario: null,
    campos: [],
    botoes: [],
    elementos: [],

    iniciarCampos: function () {

        //token
        Produto._token = $('meta[name="csrf-token"]').attr('content');

        //table
        Produto.datatable = $("#produto-table");

        //formulario
        Produto.formulario = $("#formulario-lista");

        //botoes
        Produto.botoes.btnSalvar = $("#btn-salvar");

        //utils
        Util.formatarPalavras();
    },
    salvar: function(event){

        if(!event.valid()){
            return false;
        }

        $.ajax({
            url: Produto.formulario.attr('action'),
            method: Produto.formulario.attr('method'),
            dataType: "json",
            data: { 
                _token : Produto._token,
                dados : Produto.formulario.serialize(),
            },
            beforeSend: function () {
                Util.processing();
            },
            success: function (data) {
                setTimeout(() => { 
                    Util.hideAll();
                    bootbox.alert(data.message, function(){ 
                        window.location.href = window.BASE_HREF + 'admin/produtos';
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
        Produto.botoes.btnSalvar.on('click', function (event) {
            event.preventDefault();
            Form.validation(Produto.formulario);
            Produto.salvar(Produto.formulario);
        });

        Produto.datatable.on('click', '.btn-show', function (event) {
            event.preventDefault();            
            window.location.href = $(this).data('href');
        });

        Produto.datatable.on('click', '.btn-edit', function (event) { 
            event.preventDefault();
            window.location.href = $(this).data('href');
        });

        Produto.datatable.on('click', '.btn-destroy', function (event) { 
            event.preventDefault();

            const data = {
                produto: $(this).data('produto'),
                href: $(this).data('href')
            };

            bootbox.confirm({
                message: `Você tem certeza que deseja excluir o produto <strong>${data.produto.nome}</strong>?`,
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
                        Produto.deletar(data);
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
                _token : Produto._token,
                id : dados.produto.id
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
        Produto.datatable.DataTable(
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
        Produto.iniciarCampos();
        Produto.iniciarBotoes();
        Produto.iniciarDatatable();
        Produto.iniciarMascaras();
    }
};