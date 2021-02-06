export default {
    autocomplete: function (input) {
        input.select2({
            ajax: {
                url: input.data('href'),
                dataType: "json",
                processResults: function (data) {
                    return {
                        results: data.results,
                    };
                },
            },
            minimumInputLength: 3,
            allowClear: true,
            placeholder : `${input.data('placeholder')}`,
            theme: 'bootstrap4'
        });
    },
    select2: function(input){
        input.select2({
            theme: 'bootstrap4'
        });
    },
    validation: function(input){
        return input.validate(
            {
                errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
                highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
                unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    },
    readonly: function(){
        if((typeof readonly != 'undefined') && (readonly.length > 0)){
            $("form :input").attr("readonly", true);
        } 
    },
    iniciar: function(){
        Form.default.readonly();      
    }
}