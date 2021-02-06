export default {

    formulario: null,
    campos: [],
    botoes: [],
    elementos: [],
    clienteDatatable: null,
    
    iniciarCampos: function () {

        //
        Cliente.default._token = $('meta[name="csrf-token"]').attr('content');
        Cliente.default.campos.nome = $("#cliente-nome");
        Cliente.default.campos.cep = $("#cep");

        //
        Cliente.default.clienteDatatable = $("#cliente-table");

        //
        Cliente.default.formulario = $("#formulario-lista");

        //
        Cliente.default.botoes.btnSalvar = $("#btn-salvar");

        //
        Util.default.formatarPalavras();

        //
        CEP.default.consulta(Cliente.default.campos.cep);
    },
    salvar: function(event){

        if(!event.valid()){
            return false;
        }

        $.ajax({
            url: Cliente.default.formulario.attr('action'),
            method: Cliente.default.formulario.attr('method'),
            dataType: "json",
            data: { 
                _token : Cliente.default._token,
                dados : Cliente.default.formulario.serialize(),
            },
            beforeSend: function () {
                Util.default.processing();
            },
            success: function (data) {
                setTimeout(() => { 
                    Util.default.hideAll();
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
        Cliente.default.botoes.btnSalvar.on('click', function (event) {
            event.preventDefault();
            Form.default.validation(Cliente.default.formulario);
            Cliente.default.salvar(Cliente.default.formulario);
        });

        Cliente.default.clienteDatatable.on('click', '.btn-show', function (event) {
            event.preventDefault();            
            window.location.href = $(this).data('href');
        });

        Cliente.default.clienteDatatable.on('click', '.btn-edit', function (event) { 
            event.preventDefault();
            window.location.href = $(this).data('href');
        });

        Cliente.default.clienteDatatable.on('click', '.btn-destroy', function (event) { 
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
                        Cliente.default.enviarDeleteCliente(data);
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
                _token : Cliente.default._token,
                clienteId : dados.cliente.id
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
    iniciarDadosCliente: function(dados){ 
        return ``;
    },
    iniciarClienteDatatable: function () {
        Cliente.default.clienteDatatable.DataTable(
            {
                processing: true,
                serverSide: true,
                ajax: Cliente.default.clienteDatatable.data('href'),
                columns: [
                    {data: 'nome', name: 'nome'},
                    {data: 'cpf', name: 'cpf'},
                    {data: 'sexo.descricao', name: 'sexo.descricao'},
                    {data: 'cidade', name: 'cidade'},
                    {data: 'bairro', name: 'bairro'},
                    {data: 'action', name: 'action'},
                ],
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
        Cliente.default.iniciarCampos();
        Cliente.default.iniciarBotoes();
        Cliente.default.iniciarClienteDatatable();
        Cliente.default.iniciarMascaras();
    }
}