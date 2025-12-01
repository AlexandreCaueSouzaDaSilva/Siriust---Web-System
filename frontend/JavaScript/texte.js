// ===== DADOS DO SISTEMA (simulação de banco de dados) =====
let userData = {
    nome: 'Maria Silva',
    email: 'maria.silva@email.com',
    telefone: '(81) 99999-9999',
    cpf: '123.456.789-00',
    dataNascimento: '15/05/1990',
    endereco: 'Rua das Flores, 123 - Recife/PE'
};

let consultas = [
    { id: 1, data: '15/11/2025', hora: '14:00', medico: 'Dr. João Silva', especialidade: 'Cardiologia', status: 'Agendada' },
    { id: 2, data: '18/11/2025', hora: '10:30', medico: 'Dra. Ana Costa', especialidade: 'Dermatologia', status: 'Agendada' },
    { id: 3, data: '22/11/2025', hora: '16:00', medico: 'Dr. Pedro Santos', especialidade: 'Ortopedia', status: 'Agendada' }
];

let historico = [
    { id: 1, data: '08/11/2025', medico: 'Dr. João Silva', especialidade: 'Cardiologia', observacoes: 'Consulta de rotina. Pressão normal.' },
    { id: 2, data: '01/11/2025', medico: 'Dra. Ana Costa', especialidade: 'Dermatologia', observacoes: 'Tratamento para acne.' },
    { id: 3, data: '25/10/2025', medico: 'Dr. Pedro Santos', especialidade: 'Ortopedia', observacoes: 'Dor no joelho. Recomendado fisioterapia.' }
];

let prontuarios = [
    { id: 1, data: '08/11/2025', especialidade: 'Cardiologia', diagnostico: 'Pressão arterial normal', tratamento: 'Manter atividades físicas' },
    { id: 2, data: '01/11/2025', especialidade: 'Dermatologia', diagnostico: 'Acne leve', tratamento: 'Pomada tópica' },
    { id: 3, data: '25/10/2025', especialidade: 'Ortopedia', diagnostico: 'Tendinite', tratamento: 'Fisioterapia 2x semana' }
];

let lembretes = [
    { id: 1, titulo: 'Tomar medicamento', hora: '08:00', ativo: true },
    { id: 2, titulo: 'Consulta amanhã', hora: '14:00', ativo: true },
    { id: 3, titulo: 'Exame de sangue', data: '20/11/2025', ativo: true }
];

// ===== CONTROLE DE SIDEBAR =====
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    
    sidebar.classList.toggle('closed');
    mainContent.classList.toggle('expanded');
}

// ===== NAVEGAÇÃO ENTRE PÁGINAS =====
function navigateTo(page, pageName) {
    // Atualiza breadcrumb
    document.getElementById('currentPage').textContent = pageName;
    
    // Remove classe 'active' de todos os links
    document.querySelectorAll('.sidebar-menu a').forEach(link => {
        link.classList.remove('active');
    });
    
    // Adiciona 'active' no link clicado
    event.target.closest('a').classList.add('active');
    
    // Esconde todas as páginas
    document.querySelectorAll('.page-content').forEach(page => {
        page.classList.remove('active');
    });
    
    // Mostra a página clicada
    document.getElementById('page-' + page).classList.add('active');
    
    // Carrega conteúdo dinâmico
    if (page === 'historico') renderHistorico();
    if (page === 'prontuarios') renderProntuarios();
    if (page === 'lembretes') renderLembretes();
    if (page === 'configuracoes') renderConfiguracoes();
    if (page === 'especialidades') renderEspecialidades();
    if (page === 'dashboard') renderDashboard();
}

// ===== RENDERIZAR DASHBOARD =====
function renderDashboard() {
    const dashboardPage = document.getElementById('page-dashboard');
    dashboardPage.innerHTML = `
        <div class="content-card">
            <h2>Bem-vindo ao SIRIUST</h2>
            <p>Olá, <strong>${userData.nome}</strong>! Acompanhe suas consultas e informações médicas.</p>
        </div>

        <div class="dashboard-grid">
            <div class="stat-card">
                <h3>${consultas.length}</h3>
                <p>Consultas Agendadas</p>
            </div>
            <div class="stat-card">
                <h3>${historico.length}</h3>
                <p>Consultas Realizadas</p>
            </div>
            <div class="stat-card">
                <h3>${lembretes.filter(l => l.ativo).length}</h3>
                <p>Lembretes Pendentes</p>
            </div>
            <div class="stat-card">
                <h3>${prontuarios.length}</h3>
                <p>Prontuários</p>
            </div>
        </div>

        <div class="content-card">
            <h2>Próximas Consultas</h2>
            ${consultas.map(c => `
                <div style="padding:10px; border-bottom:1px solid #eee; display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <strong>${c.data} - ${c.hora}</strong> - ${c.medico} (${c.especialidade})
                    </div>
                    <button onclick="cancelarConsulta(${c.id})" style="background:#e74c3c; color:white; padding:8px 15px; border:none; border-radius:5px; cursor:pointer;">
                        Cancelar
                    </button>
                </div>
            `).join('')}
        </div>
    `;
}

// ===== RENDERIZAR HISTÓRICO =====
function renderHistorico() {
    const historicoPage = document.getElementById('page-historico');
    historicoPage.innerHTML = `
        <div class="content-card">
            <h2>Histórico de Consultas</h2>
            <table style="width:100%; border-collapse: collapse; margin-top:20px;">
                <thead>
                    <tr style="background:#044E54; color:white;">
                        <th style="padding:12px; text-align:left;">Data</th>
                        <th style="padding:12px; text-align:left;">Médico</th>
                        <th style="padding:12px; text-align:left;">Especialidade</th>
                        <th style="padding:12px; text-align:left;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    ${historico.map(h => `
                        <tr style="border-bottom:1px solid #ddd;">
                            <td style="padding:12px;">${h.data}</td>
                            <td style="padding:12px;">${h.medico}</td>
                            <td style="padding:12px;">${h.especialidade}</td>
                            <td style="padding:12px;">
                                <button onclick="verDetalhesConsulta(${h.id})" style="background:#044E54; color:white; padding:6px 12px; border:none; border-radius:5px; cursor:pointer;">
                                    Ver Detalhes
                                </button>
                            </td>
                        </tr>
                    `).join('')}
                </tbody>
            </table>
        </div>
    `;
}

// ===== VER DETALHES DE CONSULTA =====
function verDetalhesConsulta(id) {
    const consulta = historico.find(h => h.id === id);
    alert(📋 Detalhes da Consulta\n\nData: ${consulta.data}\nMédico: ${consulta.medico}\nEspecialidade: ${consulta.especialidade}\nObservações: ${consulta.observacoes});
}

// ===== RENDERIZAR PRONTUÁRIOS =====
function renderProntuarios() {
    const prontuariosPage = document.getElementById('page-prontuarios');
    prontuariosPage.innerHTML = `
        <div class="content-card">
            <h2>Meus Prontuários</h2>
            ${prontuarios.map(p => `
                <div style="background:#f8f9fa; padding:15px; margin:10px 0; border-radius:8px; border-left:4px solid #044E54;">
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <h3 style="color:#044E54; margin-bottom:5px;">📄 ${p.especialidade}</h3>
                            <p style="color:#666; font-size:0.9em;">Data: ${p.data}</p>
                            <p style="margin-top:8px;"><strong>Diagnóstico:</strong> ${p.diagnostico}</p>
                            <p><strong>Tratamento:</strong> ${p.tratamento}</p>
                        </div>
                        <button onclick="baixarProntuario(${p.id})" style="background:#044E54; color:white; padding:10px 20px; border:none; border-radius:5px; cursor:pointer;">
                            📥 Baixar PDF
                        </button>
                    </div>
                </div>
            `).join('')}
        </div>
    `;
}

// ===== BAIXAR PRONTUÁRIO =====
function baixarProntuario(id) {
    const prontuario = prontuarios.find(p => p.id === id);
    alert(📥 Download iniciado!\n\nProntuário: ${prontuario.especialidade}\nData: ${prontuario.data}\n\n(Em um sistema real, isso geraria um PDF));
}

// ===== RENDERIZAR LEMBRETES =====
function renderLembretes() {
    const lembretesPage = document.getElementById('page-lembretes');
    lembretesPage.innerHTML = `
        <div class="content-card">
            <h2>Lembretes</h2>
            <button onclick="mostrarFormLembrete()" style="background:#044E54; color:white; padding:10px 20px; border:none; border-radius:5px; cursor:pointer; margin-bottom:20px;">
                ➕ Adicionar Lembrete
            </button>
            
            <div id="formLembrete" style="display:none; background:#f8f9fa; padding:20px; border-radius:8px; margin-bottom:20px;">
                <h3 style="color:#044E54; margin-bottom:15px;">Novo Lembrete</h3>
                <input type="text" id="novoLembreteTitulo" placeholder="Título do lembrete" style="width:100%; padding:10px; margin-bottom:10px; border:1px solid #ddd; border-radius:5px;">
                <input type="text" id="novoLembreteHora" placeholder="Hora (ex: 08:00)" style="width:100%; padding:10px; margin-bottom:10px; border:1px solid #ddd; border-radius:5px;">
                <div style="display:flex; gap:10px;">
                    <button onclick="adicionarLembrete()" style="background:#27ae60; color:white; padding:10px 20px; border:none; border-radius:5px; cursor:pointer;">
                        Salvar
                    </button>
                    <button onclick="document.getElementById('formLembrete').style.display='none'" style="background:#95a5a6; color:white; padding:10px 20px; border:none; border-radius:5px; cursor:pointer;">
                        Cancelar
                    </button>
                </div>
            </div>

            <div id="listaLembretes">
                ${lembretes.map(l => `
                    <div style="background:${l.ativo ? '#e8f8f5' : '#f8f9fa'}; padding:15px; margin:10px 0; border-radius:8px; display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <h3 style="color:#044E54;">⏰ ${l.titulo}</h3>
                            <p style="color:#666;">${l.hora || l.data}</p>
                        </div>
                        <div style="display:flex; gap:10px;">
                            <button onclick="toggleLembrete(${l.id})" style="background:${l.ativo ? '#27ae60' : '#95a5a6'}; color:white; padding:8px 15px; border:none; border-radius:5px; cursor:pointer;">
                                ${l.ativo ? '✓ Ativo' : 'Inativo'}
                            </button>
                            <button onclick="removerLembrete(${l.id})" style="background:#e74c3c; color:white; padding:8px 15px; border:none; border-radius:5px; cursor:pointer;">
                                🗑
                            </button>
                        </div>
                    </div>
                `).join('')}
            </div>
        </div>
    `;
}

function mostrarFormLembrete() {
    document.getElementById('formLembrete').style.display = 'block';
}

function adicionarLembrete() {
    const titulo = document.getElementById('novoLembreteTitulo').value;
    const hora = document.getElementById('novoLembreteHora').value;
    
    if (!titulo || !hora) {
        alert('⚠ Preencha todos os campos!');
        return;
    }
    
    lembretes.push({
        id: lembretes.length + 1,
        titulo: titulo,
        hora: hora,
        ativo: true
    });
    
    renderLembretes();
}

function toggleLembrete(id) {
    const lembrete = lembretes.find(l => l.id === id);
    lembrete.ativo = !lembrete.ativo;
    renderLembretes();
}

function removerLembrete(id) {
    if (confirm('Deseja realmente remover este lembrete?')) {
        lembretes = lembretes.filter(l => l.id !== id);
        renderLembretes();
    }
}

// ===== RENDERIZAR ESPECIALIDADES =====
function renderEspecialidades() {
    const especialidadesPage = document.getElementById('page-especialidades');
    const especialidades = [
        { nome: 'Cardiologia', icone: '🫀', medicos: 5 },
        { nome: 'Neurologia', icone: '🧠', medicos: 3 },
        { nome: 'Ortopedia', icone: '🦴', medicos: 4 },
        { nome: 'Oftalmologia', icone: '👁', medicos: 6 },
        { nome: 'Odontologia', icone: '🦷', medicos: 8 },
        { nome: 'Pediatria', icone: '👶', medicos: 7 }
    ];
    
    especialidadesPage.innerHTML = `
        <div class="content-card">
            <h2>Especialidades Médicas</h2>
            <p>Escolha a especialidade para agendar consulta:</p>
            
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(250px, 1fr)); gap:20px; margin-top:20px;">
                ${especialidades.map(e => `
                    <div style="background:linear-gradient(135deg, #044E54, #0a4d4d); color:white; padding:25px; border-radius:10px; cursor:pointer; transition:transform 0.3s;" onclick="agendarConsulta('${e.nome}')">
                        <div style="font-size:3em; text-align:center; margin-bottom:10px;">${e.icone}</div>
                        <h3 style="text-align:center; margin-bottom:5px;">${e.nome}</h3>
                        <p style="text-align:center; opacity:0.8; font-size:0.9em;">${e.medicos} médicos disponíveis</p>
                    </div>
                `).join('')}
            </div>
        </div>
    `;
}

function agendarConsulta(especialidade) {
    const data = prompt(📅 Agendar consulta de ${especialidade}\n\nDigite a data (DD/MM/AAAA):);
    const hora = prompt('⏰ Digite o horário (HH:MM):');
    
    if (data && hora) {
        consultas.push({
            id: consultas.length + 1,
            data: data,
            hora: hora,
            medico: 'Dr. Novo Médico',
            especialidade: especialidade,
            status: 'Agendada'
        });
        alert(✅ Consulta agendada co1m sucesso!\n\nData: ${data}\nHora: ${hora}\nEspecialidade: ${especialidade});
        renderDashboard();
    }
}

function cancelarConsulta(id) {
    if (confirm('Deseja realmente cancelar esta consulta?')) {
        consultas = consultas.filter(c => c.id !== id);
        alert('❌ Consulta cancelada com sucesso!');
        renderDashboard();
    }
}

// ===== RENDERIZAR CONFIGURAÇÕES / PERFIL =====
function renderConfiguracoes() {
    const configPage = document.getElementById('page-configuracoes');
    configPage.innerHTML = `
        <div class="content-card">
            <h2>Meu Perfil</h2>
            
            <div id="viewMode">
                <div style="background:#f8f9fa; padding:20px; border-radius:8px; margin-bottom:20px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                        <h3 style="color:#044E54;">Dados Pessoais</h3>
                        <button onclick="modoEdicao()" style="background:#044E54; color:white; padding:10px 20px; border:none; border-radius:5px; cursor:pointer;">
                            ✏ Editar Perfil
                        </button>
                    </div>
                    
                    <div style="display:grid; gap:15px;">
                        <div>
                            <strong style="color:#666;">Nome:</strong>
                            <p style="color:#044E54; font-size:1.1em;">${userData.nome}</p>
                        </div>
                        <div>
                            <strong style="color:#666;">Email:</strong>
                            <p style="color:#044E54; font-size:1.1em;">${userData.email}</p>
                        </div>
                        <div>
                            <strong style="color:#666;">Telefone:</strong>
                            <p style="color:#044E54; font-size:1.1em;">${userData.telefone}</p>
                        </div>
                        <div>
                            <strong style="color:#666;">CPF:</strong>
                            <p style="color:#044E54; font-size:1.1em;">${userData.cpf}</p>
                        </div>
                        <div>
                            <strong style="color:#666;">Data de Nascimento:</strong>
                            <p style="color:#044E54; font-size:1.1em;">${userData.dataNascimento}</p>
                        </div>
                        <div>
                            <strong style="color:#666;">Endereço:</strong>
                            <p style="color:#044E54; font-size:1.1em;">${userData.endereco}</p>
                        </div>
                    </div>
                </div>
                
                <button onclick="logout()" style="background:#e74c3c; color:white; padding:12px 30px; border:none; border-radius:5px; cursor:pointer; font-size:1em; width:100%;">
                    🚪 Sair da Conta
                </button>
            </div>
            
            <div id="editMode" style="display:none;">
                <div style="background:#f8f9fa; padding:20px; border-radius:8px; margin-bottom:20px;">
                    <h3 style="color:#044E54; margin-bottom:20px;">Editar Dados</h3>
                    
                    <div style="display:grid; gap:15px;">
                        <div>
                            <label style="color:#666; display:block; margin-bottom:5px;"><strong>Nome:</strong></label>
                            <input type="text" id="editNome" value="${userData.nome}" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px;">
                        </div>
                        <div>
                            <label style="color:#666; display:block; margin-bottom:5px;"><strong>Email:</strong></label>
                            <input type="email" id="editEmail" value="${userData.email}" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px;">
                        </div>
                        <div>
                            <label style="color:#666; display:block; margin-bottom:5px;"><strong>Telefone:</strong></label>
                            <input type="text" id="editTelefone" value="${userData.telefone}" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px;">
                        </div>
                        <div>
                            <label style="color:#666; display:block; margin-bottom:5px;"><strong>CPF:</strong></label>
                            <input type="text" id="editCpf" value="${userData.cpf}" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px;" disabled>
                        </div>
                        <div>
                            <label style="color:#666; display:block; margin-bottom:5px;"><strong>Data de Nascimento:</strong></label>
                            <input type="text" id="editDataNascimento" value="${userData.dataNascimento}" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px;">
                        </div>
                        <div>
                            <label style="color:#666; display:block; margin-bottom:5px;"><strong>Endereço:</strong></label>
                            <input type="text" id="editEndereco" value="${userData.endereco}" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px;">
                        </div>
                    </div>
                    
                    <div style="display:flex; gap:10px; margin-top:20px;">
                        <button onclick="salvarEdicao()" style="background:#27ae60; color:white; padding:12px 30px; border:none; border-radius:5px; cursor:pointer; flex:1;">
                            ✓ Salvar Alterações
                        </button>
                        <button onclick="cancelarEdicao()" style="background:#95a5a6; color:white; padding:12px 30px; border:none; border-radius:5px; cursor:pointer; flex:1;">
                            ✗ Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function modoEdicao() {
    document.getElementById('viewMode').style.display = 'none';
    document.getElementById('editMode').style.display = 'block';
}

function cancelarEdicao() {
    document.getElementById('editMode').style.display = 'none';
    document.getElementById('viewMode').style.display = 'block';
}

function salvarEdicao() {
    userData.nome = document.getElementById('editNome').value;
    userData.email = document.getElementById('editEmail').value;
    userData.telefone = document.getElementById('editTelefone').value;
    userData.dataNascimento = document.getElementById('editDataNascimento').value;
    userData.endereco = document.getElementById('editEndereco').value;
    
    // Atualiza nome na navbar
    document.querySelector('.user-menu span').textContent = userData.nome;
    
    alert('✅ Dados atualizados com sucesso!');
    renderConfiguracoes();
}

function logout() {
    if (confirm('Deseja realmente sair da sua conta?')) {
        alert('👋 Até logo, ' + userData.nome + '!');
        // Aqui você redirecionaria para a página de login
        window.location.href = '/login.html';
    }
}

// ===== INICIALIZAÇÃO =====
document.addEventListener('DOMContentLoaded', function() {
    renderDashboard();
    
    // Fecha sidebar no mobile ao clicar fora
    document.addEventListener('click', function(e) {
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.querySelector('.menu-toggle');
        
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        }
    });
});