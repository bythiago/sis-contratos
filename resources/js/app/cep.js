export default {
    
    consulta: async function (input)
    {
        input.on('blur', function(event){
            CEP.default.valida($(this).val().replace(/\D/g, ''));
        });
    },
    valida: function(cep)
    {
        let validacep = /^[0-9]{8}$/;

        if(validacep.test(cep)){
            CEP.default.popula(cep);
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
        Util.default.processing();
        return await CEP.default.busca(cep).then(response => {
            response.json().then(data => {
                CEP.default.objeto().rua.val(data.logradouro);
                CEP.default.objeto().bairro.val(data.bairro);
                CEP.default.objeto().cidade.val(data.localidade);
                CEP.default.objeto().uf.val(data.uf);
            });
        }).then(() => {
            Util.default.hideAll();
        });
    },
}