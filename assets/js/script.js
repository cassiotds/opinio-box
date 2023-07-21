let debounceTimer;

function buscarEndereco() {
    const cep = document.getElementById('cep').value;
    const url = `https://viacep.com.br/ws/${cep}/json/`;

    // Fazer a requisição à API ViaCEP
    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.erro) {
                alert('CEP não encontrado. Verifique se o CEP está correto e tente novamente.');
            } else {
                document.getElementById('endereco').value = data.logradouro;
                document.getElementById('bairro').value = data.bairro;
                document.getElementById('cidade').value = data.localidade;
                document.getElementById('estado').value = data.uf;
            }
        })
        .catch(error => {
            alert('Ocorreu um erro ao buscar o endereço. Tente novamente mais tarde.');
            console.error('Erro na busca do CEP:', error);
        });
}

// Adicione o evento onblur para acionar a busca do endereço quando o campo perde o foco
document.getElementById('cep').onblur = () => {
    buscarEndereco();
};