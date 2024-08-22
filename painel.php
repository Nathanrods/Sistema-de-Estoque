<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Estoque</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="sidebar">
    <h2>Menu</h2>
    <ul>
        <li>
            <a href="#" data-content="produtos">Produtos</a>
            <ul class="submenu">
                <li><a href="#" data-content="adicionar-produto">Adicionar Novo Produto</a></li>
                <li><a href="#" data-content="gerenciar-produtos">Gerenciar Produtos</a></li>
                <li><a href="#" data-content="categorias-produtos">Categorias de Produtos</a></li>
            </ul>
        </li>
        <li>
            <a href="#" data-content="fornecedores">Fornecedores</a>
            <ul class="submenu">
                <li><a href="#" data-content="adicionar-fornecedor">Adicionar Novo Fornecedor</a></li>
                <li><a href="#" data-content="gerenciar-fornecedores">Gerenciar Fornecedores</a></li>
                <li><a href="#" data-content="historico-compras">Histórico de Compras</a></li>
            </ul>
        </li>
        <li>
            <a href="#" data-content="inventario">Inventário</a>
            <ul class="submenu">
                <li><a href="#" data-content="adicionar-inventario">Adicionar Novo Inventário</a></li>
                <li><a href="#" data-content="gerenciar-inventario">Gerenciar Inventário</a></li>
                <li><a href="#" data-content="relatorios-inventario">Relatórios de Inventário</a></li>
            </ul>
        </li>
        <li>
            <a href="#" data-content="vendas">Vendas</a>
            <ul class="submenu">
                <li><a href="#" data-content="nova-venda">Nova Venda</a></li>
                <li><a href="#" data-content="gerenciar-vendas">Gerenciar Vendas</a></li>
                <li><a href="#" data-content="relatorios-vendas">Relatórios de Vendas</a></li>
            </ul>
        </li>
        <li>
            <a href="#" data-content="compras">Compras</a>
            <ul class="submenu">
                <li><a href="#" data-content="nova-compra">Nova Compra</a></li>
                <li><a href="#" data-content="gerenciar-compras">Gerenciar Compras</a></li>
                <li><a href="#" data-content="relatorios-compras">Relatórios de Compras</a></li>
            </ul>
        </li>
        <li>
            <a href="#" data-content="funcionarios">Funcionários</a>
            <ul class="submenu">
                <li><a href="#" data-content="adicionar-funcionario">Adicionar Novo Funcionário</a></li>
                <li><a href="#" data-content="gerenciar-funcionarios">Gerenciar Funcionários</a></li>
                <li><a href="#" data-content="papéis-permissoes">Papéis e Permissões</a></li>
            </ul>
        </li>
        <li>
            <a href="#" data-content="clientes">Clientes</a>
            <ul class="submenu">
                <li><a href="#" data-content="adicionar-cliente">Adicionar Novo Cliente</a></li>
                <li><a href="#" data-content="gerenciar-clientes">Gerenciar Clientes</a></li>
                <li><a href="#" data-content="historico-compras-clientes">Histórico de Compras dos Clientes</a></li>
            </ul>
        </li>
        <li>
            <a href="#" data-content="relatorios">Relatórios</a>
            <ul class="submenu">
                <li><a href="#" data-content="relatorios-vendas">Relatórios de Vendas</a></li>
                <li><a href="#" data-content="relatorios-compras">Relatórios de Compras</a></li>
                <li><a href="#" data-content="relatorios-inventario">Relatórios de Inventário</a></li>
            </ul>
        </li>
        <li>
            <a href="#" data-content="configuracoes">Configurações</a>
            <ul class="submenu">
                <li><a href="#" data-content="config-gerais">Configurações Gerais</a></li>
                <li><a href="#" data-content="config-usuarios">Configurações de Usuários</a></li>
                <li><a href="#" data-content="config-sistema">Configurações de Sistema</a></li>
            </ul>
        </li>
        <li>
            <a href="#" data-content="ajuda">Ajuda</a>
            <ul class="submenu">
                <li><a href="#" data-content="documentacao">Documentação</a></li>
                <li><a href="#" data-content="suporte-tecnico">Suporte Técnico</a></li>
                <li><a href="#" data-content="faq">FAQ</a></li>
            </ul>
        </li>
    </ul>
</div>

<div class="topbar">
    <div class="user-menu">
        <img src="get_image.php" alt="User Image" class="user-image">
        <span><?php echo htmlspecialchars($user['username']); ?></span>
        <div class="dropdown">
            <ul>
                <li><a href="#">Perfil</a></li>
                <li><a href="#">Configurações</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </div>
    </div>
</div>

<div id="content" class="content fixo">
    <h1>Bem-vindo ao Sistema de Estoque</h1>
    <p>Conteúdo principal aqui.</p>
</div>

<script src="script.js"></script>
</body>
</html>
