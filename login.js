const modo = document.getElementById('icone-lua');

modo.addEventListener('click', () => { 
    const form = document.getElementById('login'); 
    if(modo.classList.contains('fa-moon')){
        modo.classList.remove('fa-moon');
        modo.classList.add('fa-sun');

        form.classList.add('dark');
        return;
    }
    modo.classList.add('fa-moon');
    modo.classList.remove('fa-sun');
    form.classList.remove('dark');
});


// Lista de ícones disponíveis
var icones = ['../images/icone1.png', '../images/icone2.png', '../images/icone3.png', '../images/icone4.png', '../images/icone5.png', '../images/icone6.png'];
var indiceAtual = 0;

function mudarIcone(direcao) {
    // Atualiza o índice com base na direção (-1 para voltar, 1 para avançar)
    indiceAtual += direcao;

    // Se o índice for menor que 0, volta para o último ícone  
    if (indiceAtual < 0) {
        indiceAtual = icones.length - 1;
    }
    
    // Se o índice ultrapassar o último, volta para o primeiro
    if (indiceAtual >= icones.length) {
        indiceAtual = 0;
    }
    
    // Atualiza a imagem do ícone exibido
    var iconeSelecionado = document.getElementById('icone-selecionado');
    iconeSelecionado.src = icones[indiceAtual];
    
    // Atualiza o valor do campo oculto para o ícone selecionado
    document.getElementById('icone-escolhido-input').value = icones[indiceAtual];
}

const nome = document.getElementByID('nome').value;
const senha = document.getElementByID('senha').value;


fetch('https://http://digitalcore.azurewebsites.net/conn.php', {
    method: 'POST',
    headers: {
        'Content-Type: 'application/json'
    },
    body: JSON.stringify({ nome: nome, senha: senha })
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error =>
    console.log('erro', error));
    
