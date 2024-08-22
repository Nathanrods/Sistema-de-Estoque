document.querySelectorAll('.sidebar ul li').forEach(function(menuItem) {
    menuItem.addEventListener('click', function() {
        let submenu = this.querySelector('.submenu');
        if (submenu) {
            submenu.classList.toggle('active');
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Adicionar evento de clique a todos os links com data-content
    const menuLinks = document.querySelectorAll('a[data-content]');
    menuLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            const contentId = this.getAttribute('data-content');
            loadContent(contentId);
        });
    });

    function loadContent(contentId) {
        const contentDiv = document.getElementById('content');
        // Substitua o conteúdo com base no id
        fetch(`content/${contentId}.html`)
            .then(response => response.text())
            .then(data => {
                contentDiv.innerHTML = data;
            })
            .catch(error => {
                console.error('Erro ao carregar o conteúdo:', error);
            });
    }
});
