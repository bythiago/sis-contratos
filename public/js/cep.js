CEP = {
    consulta: async function (input)
    {
        input.on('blur', function(event){
            CEP.valida($(this).val().replace(/\D/g, ''));
        });
    },
    valida: function(cep)
    {
        let validacep = /^[0-9]{8}$/;

        if(validacep.test(cep)){
            CEP.popula(cep);
        }

        return false;
    },
    busca: function(cep)
    {
        return new Promise(resolve => {
            setTimeout(() => {
                resolve(fetch(`https://viacep.com.br/ws/${cep}/json`));
            }, 500);
        });
    },
    objeto: function()
    {
        return {
            cep: $("#cep"),
            rua: $("#rua"),
            bairro: $("#bairro"),
            cidade: $("#cidade"),
            uf: $("#uf"),
        };
    },
    popula: async function(cep)
    {
        Util.processing();
        return await CEP.busca(cep).then(response => {
            response.json().then(data => {
                CEP.objeto().rua.val(data.logradouro);
                CEP.objeto().bairro.val(data.bairro);
                CEP.objeto().cidade.val(data.localidade);
                CEP.objeto().uf.val(data.uf);
            });
        }).then(() => {
            Util.hideAll();
        });
    },
}