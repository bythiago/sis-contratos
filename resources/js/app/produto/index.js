export default {
    
    formulario: null,
    campos: [],
    botoes: [],
    elementos: [],

    iniciarCampos: function () {
        //token
        Produto.default._token = $('meta[name="csrf-token"]').attr('content');

        //table
        Produto.default.datatable = $("#produto-table");

        //formulario
        Produto.default.formulario = $("#formulario-lista");

        //botoes
        Produto.default.botoes.btnSalvar = $("#btn-salvar");

        //utils
        Util.default.formatarPalavras();
    },
    salvar: function(event){

        if(!event.valid()){
            return false;
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN' : Produto.default._token
            },
            url: Produto.default.formulario.attr('action'),
            method: "POST",
            dataType: "json",
            processData: false,
            contentType: false,
            data: new FormData(Produto.default.formulario[0]),
            beforeSend: function () {
                Util.default.processing();
            },
            success: function (data) {
                setTimeout(() => { 
                    Util.default.hideAll();
                    bootbox.alert(data.message, function(){ 
                        window.location.href = window.BASE_HREF + 'admin/produtos';
                    });
                }, 250);
            },
            error: function (error) {
                Util.default.hideAll();
                console.log(error);
                // bootbox.alert(error.responseJSON, function(){ 
                //     window.location.reload()
                // });
                // $('#validation-errors').html('');
                // $.each(error.responseJSON.errors, function(key, value) {
                //     console.log(key, value);
                //     $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div');
                // }); 
            }
        });
    },
    iniciarBotoes: function() {
        Produto.default.botoes.btnSalvar.on('click', function (event) {
            event.preventDefault();
            Form.default.validation(Produto.default.formulario);
            Produto.default.salvar(Produto.default.formulario);
        });

        Produto.default.datatable.on('click', '.btn-show', function (event) {
            event.preventDefault();            
            window.location.href = $(this).data('href');
        });

        Produto.default.datatable.on('click', '.btn-edit', function (event) { 
            event.preventDefault();
            window.location.href = $(this).data('href');
        });

        Produto.default.datatable.on('click', '.btn-destroy', function (event) { 
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
                        Produto.default.deletar(data);
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
                _token : Produto.default._token,
                id : dados.produto.id
            },
            beforeSend: function () {
                Util.default.processing();
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
        Produto.default.datatable.DataTable(
            {
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
        Produto.default.iniciarCampos();
        Produto.default.iniciarBotoes();
        Produto.default.iniciarDatatable();
        Produto.default.iniciarMascaras();
    }
};