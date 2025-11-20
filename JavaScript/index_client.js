// ===== FUNÇÃO: ABRIR/FECHAR SIDEBAR =====
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
            
    // Adiciona ou remove classe "closed" da sidebar
    sidebar.classList.toggle('closed');
    
    // Expande ou retrai o conteúdo principal
    mainContent.classList.toggle('expanded');
}

// ===== FUNÇÃO: NAVEGAR ENTRE PÁGINAS =====
function navigateTo(pageId, pageName) {
    // 1. ESCONDE TODAS AS PÁGINAS
    const allPages = document.querySelectorAll('.page-content');
    allPages.forEach(page => {
        page.classList.remove('active'); // Remove classe "active" de todas
    });

    // 2. MOSTRA APENAS A PÁGINA CLICADA
    const targetPage = document.getElementById('page-' + pageId);
    targetPage.classList.add('active'); // Adiciona "active" na página certa

    // 3. ATUALIZA BREADCRUMBS (migalhas de pão)
    document.getElementById('currentPage').textContent = pageName;

    // 4. REMOVE "ACTIVE" DE TODOS OS LINKS DO MENU
    const allLinks = document.querySelectorAll('.sidebar-menu a');
    allLinks.forEach(link => {
        link.classList.remove('active');
    });

    // 5. ADICIONA "ACTIVE" NO LINK CLICADO
    const clickedLink = document.querySelector(`a[href="#${pageId}"]`);
    clickedLink.classList.add('active');

    // 6. FECHA SIDEBAR NO MOBILE (opcional)
    if (window.innerWidth <= 768) {
        toggleSidebar();
    }
}

// ===== FECHA SIDEBAR NO MOBILE AO CARREGAR =====
window.addEventListener('load', function() {
    if (window.innerWidth <= 768) {
        document.getElementById('sidebar').classList.add('closed');
        document.getElementById('mainContent').classList.add('expanded');
    }
});