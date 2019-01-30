$(document).ready(function() {
	$(".parsley_validate").parsley({
		errorClass: 'is-invalid text-danger',
		successClass: 'is-valid text-success', // Comentar caso não queira que o campo fique verde quando for válido.
		errorsWrapper: "<div class=\"invalid-feedback\"></div>",
		errorTemplate: '<div></div>',
		trigger: 'change keyup'
	}) /* Caso seja necessário validar os campos assim que a página carregar,
		utilizar a função a seguir aqui: .validate()*/ ;
});