// 1. PEGA O FORMULÁRIO (a tag <form> inteira)
const form = document.getElementById('formCadastro');

// 2. PEGA A DIV ONDE VAI MOSTRAR MENSAGENS
const mensagemDiv = document.getElementById('mensagem');

// 3. ESCUTA QUANDO O USUÁRIO CLICAR EM "CADASTRAR"
form.addEventListener('submit', function(e) {
    
    // 4. IMPEDE O COMPORTAMENTO PADRÃO (recarregar página)
    e.preventDefault();
    
    // 5. PEGA OS VALORES QUE O USUÁRIO DIGITOU
    const nome = document.getElementById('nome').value;
    const email = document.getElementById('email').value;
    const senha = document.getElementById('senha').value;
    const confirmarSenha = document.getElementById('confirmarSenha').value;
    const crm = document.getElementById('crm').value;
    
    // 6. VALIDAÇÕES BÁSICAS
    
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

        // Verifica se o CRM foi preenchido
    if (crm.length < 4) {
        mensagemDiv.innerHTML = '<p style="color: red;">CRM inválido!</p>';
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

    // 7. SE PASSOU NAS VALIDAÇÕES, CRIA O OBJETO COM OS DADOS
    const dadosProfissional = {
        nome: nome,
        email: email,
        crm: crm,
        senha: senha,
        tipo: 'profissional' // Marca que é profissional
    };
    
    // 8. AQUI VOCÊ VAI ENVIAR PRO BACKEND (quando seu colega terminar)
    // Por enquanto, vamos SIMULAR salvando no navegador
    
    console.log('Dados para cadastro:', dadosProfissional);
    
    // Salvar fake (enquanto não tem backend)
    localStorage.setItem('usuario', JSON.stringify(dadosProfissional));
    
    // Quando tiver backend, é só trocar por:
    /*
    fetch('http://seubackend.com/cadastro', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dadosProfissional)
    })
    .then(response => response.json())
    .then(data => {
        if (data.sucesso) {
            mensagemDiv.innerHTML = '<p style="color: green;">Cadastro realizado!</p>';
            setTimeout(() => {
                window.location.href = 'index-profissional.html';
            }, 1500);
        } else {
            mensagemDiv.innerHTML = '<p style="color: red;">Erro: ' + data.mensagem + '</p>';
        }
    })
    .catch(erro => {
        mensagemDiv.innerHTML = '<p style="color: red;">Erro ao cadastrar!</p>';
    });
    */
    
    // 9. MOSTRA MENSAGEM DE SUCESSO
    mensagemDiv.innerHTML = '<p style="color: green;">Cadastro realizado com sucesso!</p>';
    
    // 10. REDIRECIONA PRO INDEX DEPOIS DE 1.5 SEGUNDOS
    setTimeout(function() {
        window.location.href = 'index-profissional.html';
    }, 1500);
});