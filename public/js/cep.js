CEP = {
    buscaCEP: async function (input) {
        input.on('blur', function(event){
            var cep = $(this).val().replace(/\D/g, '');

            if(CEP.validaCEP(cep) === true){
                CEP.ajaxCEP(cep)
                    .catch(e => {
                        console.log(e);
                    }).then(v => {
                        CEP.popularCEP(v);
                    }
                );
            }
        });
    },
    objetoCEP: function(data){
        return {
            cep: $("#cep"),
            rua: $("#rua"),
            bairro: $("#bairro"),
            cidade: $("#cidade"),
            uf: $("#uf"),
        };
    },
    popularCEP: function(data){
        if(!data.erro){
            CEP.objetoCEP().rua.val(data.logradouro);//.attr('readonly', 'readonly');
            CEP.objetoCEP().bairro.val(data.bairro);//.attr('readonly', 'readonly');
            CEP.objetoCEP().cidade.val(data.localidade);//;.attr('readonly', 'readonly');
            CEP.objetoCEP().uf.val(data.uf);//.attr('readonly', 'readonly');
        } else {
            CEP.objetoCEP().cep.removeAttr('readonly').val('');
            CEP.objetoCEP().rua.removeAttr('readonly').val('');
            CEP.objetoCEP().bairro.removeAttr('readonly').val('');
            CEP.objetoCEP().cidade.removeAttr('readonly').val('');
            CEP.objetoCEP().uf.removeAttr('readonly').val('');
        }
    },
    validaCEP: function(cep){
        let validacep = /^[0-9]{8}$/;

        if(validacep.test(cep)){
            return true;
        }

        return false;
    },
    ajaxCEP: async function (cep) {
        return await $.ajax({
            url: `https://viacep.com.br/ws/${cep}/json`,
            method: "GET",
            beforeSend: function (data) {
                // bootbox.dialog({
                //     message:
                //         '<div class="text-center"><i class="fas fa-cog fa-spin"></i> Processando</div>',
                //     closeButton: false,
                // });
            },
            success: function (data) {
                Util.hideAll();
                return data;
            },
            error: function (error) {
                Util.hideAll();
                return error;
            }
        });
    },
}