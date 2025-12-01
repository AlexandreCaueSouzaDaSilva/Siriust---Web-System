// ===== MESMAS FUNÇÕES DA VERSÃO PACIENTE =====
        
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    sidebar.classList.toggle('closed');
    mainContent.classList.toggle('expanded');
}

function navigateTo(pageId, pageName) {
    // Esconde todas as páginas
    const allPages = document.querySelectorAll('.page-content');
    allPages.forEach(page => {
        page.classList.remove('active');
    });

    // Mostra a página clicada
    const targetPage = document.getElementById('page-' + pageId);
    targetPage.classList.add('active');

    // Atualiza breadcrumbs
    document.getElementById('currentPage').textContent = pageName;

    // Atualiza menu ativo
    const allLinks = document.querySelectorAll('.sidebar-menu a');
    allLinks.forEach(link => {
        link.classList.remove('active');
    });

    const clickedLink = document.querySelector(`a[href="#${pageId}"]`);
    clickedLink.classList.add('active');

    // Fecha sidebar no mobile
    if (window.innerWidth <= 768) {
        toggleSidebar();
    }
}

// Comportamento inicial mobile
 window.addEventListener('load', function() {
    if (window.innerWidth <= 768) {
        document.getElementById('sidebar').classList.add('closed');
        document.getElementById('mainContent').classList.add('expanded');
    }
});