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
                    // bootbox.dialog({
                    //     message:
                    //         '<div class="text-center"><i class="fas fa-cog fa-spin"></i> Processando</div>',
                    //     closeButton: false,
                    // });
                },
                success: function (data) {
                    const message = App.iniciarDadosCliente(data);

                    bootbox.hideAll();
                    bootbox.dialog({
                        title: `Cliente: ${data.cliente.nome}`,
                        message : message,
                        size: 'large'
                    });
                },
                error: function (error) {
                    console.log(error);
                    // bootbox.hideAll();
                    // bootbox.alert({
                    //     title: 'Error',
                    //     message: 'Não foi possivel cadastrar o formulário'
                    // });
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
                // bootbox.dialog({
                //     message:
                //         '<div class="text-center"><i class="fas fa-cog fa-spin"></i> Processando</div>',
                //     closeButton: false,
                // });
            },
            success: function (data) {
                bootbox.hideAll();
                bootbox.alert(/*data.message*/'aaa', function(){
                    window.location.reload();
                });
            },
            error: function (error) {
                console.log(error);
                // bootbox.hideAll();
                // bootbox.alert({
                //     title: 'Error',
                //     message: 'Não foi possivel cadastrar o formulário'
                // });
            }
        })
    },
    iniciarDadosCliente: function(dados){ 
        return `
            <div class="form-group">
                <label for="nome">Nome</label>
                <input class="form-control" value="${dados.cliente.nome}" ${dados.readonly}>
            </div>
            <div class="form-group">
                <label for="nome">CPF</label>
                <input class="form-control" value="${dados.cliente.cpf}" ${dados.readonly}>
            </div>
            <div class="form-group">
                <label for="nome">Dt. Nascimento</label>
                <input class="form-control" value="${dados.cliente.nascimento}" ${dados.readonly}>
            </div>
            <div class="form-group">
                <label for="nome">CEP</label>
                <input class="form-control" value="${dados.cliente.cep}" ${dados.readonly}>
            </div>
            <div class="form-group">
                <label for="nome">Bairro</label>
                <input class="form-control" value="${dados.cliente.bairro}" ${dados.readonly}>
            </div>
            <div class="form-group">
                <label for="nome">Cidade</label>
                <input class="form-control" value="${dados.cliente.cidade}" ${dados.readonly}>
            </div>
            <div class="form-group">
                <label for="nome">UF</label>
                <input class="form-control" value="${dados.cliente.uf}" ${dados.readonly}>
            </div>
            <div class="form-group">
                <label for="nome">Observação</label>
                <textarea class="form-control" ${dados.readonly}>${dados.cliente.observacao}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-info">
                    Cancelar
                    <i class="far fa-arrow-left"></i>
                </button>
                <button class="btn btn-success">
                    Salvar
                    <i class="far fa-save"></i>
                </button>
            </div>
        `;
    },
    iniciarClienteDatatable: function () {
        App.clienteDatatable.DataTable();
    },
    iniciarMascaras: function (){
        Inputmask().mask(document.querySelectorAll("input"));
        // https://github.com/RobinHerbots/Inputmask
    },
    iniciar: function () {
        App.iniciarCampos();
        App.iniciarBotoes();
        App.iniciarClienteDatatable();
        App.iniciarMascaras();
    }
};