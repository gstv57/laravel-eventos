function consultaCep(cep) {
    var cepFormatado = cep.replace(/\D/g, '');
    if (cepFormatado.length !== 8) {
        console.log('Formato de CEP inválido.');
        return;
    }

    fetch(`https://viacep.com.br/ws/${cepFormatado}/json/`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('endereco').value = data.logradouro || '';
            document.getElementById('neighborhood').value = data.bairro || '';
            document.getElementById('city').value = data.localidade || '';
            document.getElementById('state').value = data.uf || '';

        })
        .catch(error => console.error('Erro ao consultar CEP:', error));
}
