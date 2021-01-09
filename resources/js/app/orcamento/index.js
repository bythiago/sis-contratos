export default Orcamento;

Orcamento = {
    
    formulario: null,
    campos: [],
    botoes: [],
    elementos: [],

    iniciarCampos: function () {

        //token
        Orcamento._token = $('meta[name="csrf-token"]').attr('content');

        //campos
        Orcamento.campos.autocomplete = $("#pedido-id-produto");
        Form.default.autocomplete(Orcamento.campos.autocomplete);

        // //table
        // Orcamento.datatable = $("#produto-table");

        // //formulario
        // Orcamento.formulario = $("#formulario-lista");

        // //botoes
        // Orcamento.botoes.btnSalvar = $("#btn-salvar");
        Orcamento.botoes.btnProdutoAdicionar = $("#btnProdutoAdicionar");
        // Orcamento.botoes.btnProdutoRemover = $("btnProdutoRemover");

        //utils
        Util.default.formatarPalavras();
    },
    adicionarProduto: function(){
        Orcamento.botoes.btnProdutoAdicionar.on('click', function(event){
            event.preventDefault();
            Form.default.validation(Orcamento.formulario);
            
            if(!Orcamento.formulario.valid()){
                return false;
            }

            $.ajax({
                url: Orcamento.formulario.attr('action'),
                method: Orcamento.formulario.attr('method'),
                dataType: "json",
                data: { 
                    _token : Orcamento._token,
                    dados : Orcamento.formulario.serialize(),
                },
                beforeSend: function () {
                    // Util.default.processing();
                },
                success: function (data) {
                    console.log(data);
                    // setTimeout(() => { 
                    //     Util.default.hideAll();
                    //     bootbox.alert(data.message, function(){ 
                    //         window.location.href = window.BASE_HREF + 'pedidos';
                    //     });
                    // }, 250);
                },
                error: function (error) {
                    bootbox.alert(error.responseJSON.message, function(){ 
                        window.location.reload()
                    });
                }
            });
        });
    },
    salvar: function(event){

        if(!event.valid()){
            return false;
        }

        $.ajax({
            url: Orcamento.formulario.attr('action'),
            method: Orcamento.formulario.attr('method'),
            dataType: "json",
            data: { 
                _token : Orcamento._token,
                dados : Orcamento.formulario.serialize(),
            },
            beforeSend: function () {
                Util.default.processing();
            },
            success: function (data) {
                setTimeout(() => { 
                    Util.default.hideAll();
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
        Orcamento.botoes.btnSalvar.on('click', function (event) {
            event.preventDefault();
            Form.default.validation(Orcamento.formulario);
            Orcamento.salvar(Orcamento.formulario);
        });

        Orcamento.datatable.on('click', '.btn-show', function (event) {
            event.preventDefault();            
            window.location.href = $(this).data('href');
        });

        Orcamento.datatable.on('click', '.btn-edit', function (event) { 
            event.preventDefault();
            window.location.href = $(this).data('href');
        });

        Orcamento.datatable.on('click', '.btn-destroy', function (event) { 
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
                        Orcamento.deletar(data);
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
                _token : Orcamento._token,
                id : dados.produto.id
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
        Orcamento.datatable.DataTable(
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
        Orcamento.iniciarCampos();
        //Orcamento.iniciarBotoes();
        //Orcamento.iniciarDatatable();
        Orcamento.iniciarMascaras();
        Orcamento.adicionarProduto();
    }
};