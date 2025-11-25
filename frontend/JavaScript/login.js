// 1. PEGA O FORMULÁRIO E A DIV DE MENSAGEM
const form = document.getElementById('formlogin');
const mensagemDiv = document.getElementById('mensagem');

// 2. ESCUTA O SUBMIT
form.addEventListener('submit', function(e) {
    
    // 3. IMPEDE O COMPORTAMENTO PADRÃO
    e.preventDefault();
    
    // 4. PEGA OS VALORES DIGITADOS
    const email = document.getElementById('email').value.trim();
    const senha = document.getElementById('senha').value;
    
    // 5. VALIDAÇÕES BÁSICAS
    if (!email || !email.includes('@')) {
        mensagemDiv.innerHTML = '<p style="color: red;">E-mail inválido!</p>';
        return;
    }
    
    if (senha.length < 6) {
        mensagemDiv.innerHTML = '<p style="color: red;">Senha deve ter pelo menos 6 caracteres!</p>';
        return;
    }
    
    // 6. BUSCA OS DADOS SALVOS NO CADASTRO
    const usuarioSalvo = localStorage.getItem('usuario');
    
    // 7. VERIFICA SE EXISTE USUÁRIO CADASTRADO
    if (!usuarioSalvo) {
        mensagemDiv.innerHTML = '<p style="color: red;">Nenhum usuário cadastrado! <a href="tipocadastro.html">Cadastre-se primeiro</a></p>';
        return;
    }
    
    // 8. CONVERTE DE TEXTO PRA OBJETO
    const usuario = JSON.parse(usuarioSalvo);
    
    // 9. VERIFICA SE O EMAIL E SENHA BATEM
    if (email === usuario.email && senha === usuario.senha) {
        // LOGIN DEU CERTO! 
        mensagemDiv.innerHTML = '<p style="color: green;">Login realizado com sucesso!</p>';
        
        // Salva que o usuário tá logado
        localStorage.setItem('usuarioLogado', 'true');
        
        // Redireciona baseado no TIPO de usuário
        setTimeout(function() {
            if (usuario.tipo === 'profissional') {
                window.location.href = 'index-profissional.html';
            } else {
                window.location.href = 'index-cliente.html';
            }
        }, 1500);
        
    } else {
        // LOGIN DEU ERRADO! 
        mensagemDiv.innerHTML = '<p style="color: red;">E-mail ou senha incorretos!</p>';
    }
});