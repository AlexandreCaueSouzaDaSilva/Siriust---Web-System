// 1. Pegar o formulário e a div de mensagem
const form = document.getElementById('formCadastro');
const mensagemDiv = document.getElementById('mensagem');

// 2. Escutar o submit
form.addEventListener('submit', function(e) {
    
    // 3. Impedir reload
    e.preventDefault();
    
    // 4. Pegar os valores dos inputs
    const nome = document.getElementById('nome').value;
    const email = document.getElementById('email').value;
    const senha = document.getElementById('senha').value;
    const confirmarSenha = document.getElementById('confirmarSenha').value;
    
    // 5. VALIDAÇÕES
    
    // Verifica se o nome tem pelo menos 3 letras
    if (nome.length < 3) {
        mensagemDiv.innerHTML = '<p style="color: red;">Nome precisa ter pelo menos 3 caracteres!</p>';
        return; // Para aqui
    }

    // Verifica se o email foi preenchido e tem @
    if (!email || !email.includes('@')) {
    mensagemDiv.innerHTML = '<p style="color: red;">Email inválido!</p>';
    return;
    }

    // Verifica se a senha tem pelo menos 6 caracteres
    if (senha.length < 6) {
        mensagemDiv.innerHTML = '<p style="color: red;">Senha precisa ter pelo menos 6 caracteres!</p>';
        return;
    }

    // Verifica se a senha é igual à confirmação de senha
    if (senha !== confirmarSenha) {
    mensagemDiv.innerHTML = '<p style="color: red;">As senhas não coincidem!</p>';
    return; // Para aqui
    }
    
    // 6. Criar o objeto com os dados
    const dadosCliente = {
        nome: nome,
        email: email,
        senha: senha,
        tipo: 'cliente' // Importante: marca que é cliente
    };
    
    // 7. Salvar no localStorage (fake, por enquanto)
    localStorage.setItem('usuario', JSON.stringify(dadosCliente));
    
    // 8. Mostrar mensagem de sucesso
    mensagemDiv.innerHTML = '<p style="color: green;">Cadastro realizado com sucesso!</p>';
    
    // 9. Redirecionar depois de 1.5 segundos
    setTimeout(function() {
        window.location.href = 'index-cliente.html';
    }, 1500);
});