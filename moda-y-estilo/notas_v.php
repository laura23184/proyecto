<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleStock - Gestión de Inventario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6C63FF;
            --secondary-color: #4D44DB;
            --accent-color: #FF6584;
            --text-color: #2D3748;
            --text-light: #718096;
            --bg-color: #F8FAFC;
            --sidebar-bg: #f54bec;
            --card-bg: #ffffff;
            --border-color: #dd00fa;
            --success-color: #48BB78;
            --warning-color: #ED8936;
            --danger-color: #F56565;
            --info-color: #4299E1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background-color: var(--sidebar-bg);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            padding: 25px 20px;
            color: var(--primary-color);
            font-size: 20px;
            font-weight: 700;
        }

        .logo i {
            font-size: 24px;
            margin-right: 10px;
        }

        nav ul {
            list-style: none;
            padding: 0 15px;
            margin-top: 20px;
        }

        nav ul li {
            margin-bottom: 5px;
            border-radius: 8px;
            overflow: hidden;
        }

        nav ul li a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            text-decoration: none;
            color: var(--text-light);
            font-weight: 500;
            transition: all 0.3s ease;
        }

        nav ul li a i {
            margin-right: 12px;
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        nav ul li a:hover {
            color: var(--primary-color);
            background-color: rgba(108, 99, 255, 0.1);
        }

        nav ul li.active a {
            color: var(--primary-color);
            background-color: rgba(108, 99, 255, 0.1);
        }

        .user-profile {
            margin-top: auto;
            padding: 20px;
            display: flex;
            align-items: center;
            border-top: 1px solid var(--border-color);
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            display: block;
            font-weight: 600;
            font-size: 14px;
        }

        .user-role {
            display: block;
            font-size: 12px;
            color: var(--text-light);
        }

        .user-profile i {
            color: var(--text-light);
            cursor: pointer;
            transition: color 0.3s;
        }

        .user-profile i:hover {
            color: var(--primary-color);
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 30px;
            background-color: var(--sidebar-bg);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            z-index: 10;
        }

        .search-bar {
            position: relative;
            width: 400px;
        }

        .search-bar i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .search-bar input {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background-color: var(--bg-color);
            font-size: 14px;
            transition: all 0.3s;
        }

        .search-bar input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-notification {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--bg-color);
            border: none;
            color: var(--text-light);
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-notification:hover {
            background-color: rgba(108, 99, 255, 0.1);
            color: var(--primary-color);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--accent-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
        }

        .btn-add {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-add:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(108, 99, 255, 0.3);
        }

        /* Botón de salir */
        .btn-salir {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background-color: var(--danger-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-salir:hover {
            background-color: #E53E3E;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 101, 101, 0.3);
        }

        .content {
            padding: 30px;
            flex: 1;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .page-header p {
            color: var(--text-light);
            font-size: 14px;
        }

        /* Stats Cards */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 24px;
            color: white;
        }

        .bg-blue {
            background-color: var(--primary-color);
        }

        .bg-green {
            background-color: var(--success-color);
        }

        .bg-orange {
            background-color: var(--warning-color);
        }

        .bg-purple {
            background-color: #9F7AEA;
        }

        .card-info h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .card-info p {
            color: var(--text-light);
            font-size: 14px;
        }

        /* Content Row */
        .content-row {
            display: flex;
            gap: 30px;
        }

        .recent-products {
            flex: 2;
        }

        .quick-actions {
            flex: 1;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-header h2 {
            font-size: 18px;
            font-weight: 600;
        }

        .view-all {
            color: var(--primary-color);
            font-size: 14px;
            text-decoration: none;
            font-weight: 500;
        }

        .view-all:hover {
            text-decoration: underline;
        }

        /* Table Styles */
        .table-container {
            background-color: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px 20px;
            text-align: left;
        }

        th {
            background-color: var(--bg-color);
            font-weight: 600;
            font-size: 14px;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            font-size: 14px;
            border-top: 1px solid var(--border-color);
        }

        tr:hover td {
            background-color: rgba(108, 99, 255, 0.05);
        }

        /* Quick Actions */
        .action-buttons {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            text-align: left;
        }

        .action-btn i {
            font-size: 18px;
            color: var(--primary-color);
        }

        .action-btn span {
            font-size: 14px;
            font-weight: 500;
        }

        .action-btn:hover {
            border-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        /* Low Stock Items */
        .low-stock-items {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .stock-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .stock-item:last-child {
            border-bottom: none;
        }

        .stock-item img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 15px;
        }

        .stock-info {
            flex: 1;
        }

        .stock-info h4 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 3px;
        }

        .stock-info p {
            font-size: 12px;
            color: var(--text-light);
        }

        .stock-quantity {
            font-size: 14px;
            font-weight: 600;
            color: var(--danger-color);
        }

        /* Modal Styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }

        .modal.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background-color: white;
            border-radius: 12px;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-20px);
            transition: all 0.3s;
        }

        .modal.active .modal-content {
            transform: translateY(0);
        }

        .modal-header {
            padding: 20px 25px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 20px;
            font-weight: 600;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-light);
            transition: color 0.3s;
        }

        .close-modal:hover {
            color: var(--danger-color);
        }

        .modal-body {
            padding: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2);
        }

        .form-row {
            display: flex;
            gap: 20px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .sizes-container .size-inputs {
            margin-bottom: 10px;
        }

        .size-input {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .size-input input {
            flex: 1;
            padding: 10px 15px;
        }

        .remove-size {
            background-color: var(--danger-color);
            color: white;
            border: none;
            border-radius: 6px;
            width: 36px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .remove-size:hover {
            background-color: #E53E3E;
        }

        .add-size-btn {
            background-color: var(--bg-color);
            color: var(--primary-color);
            border: 1px dashed var(--primary-color);
            padding: 8px 15px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .add-size-btn:hover {
            background-color: rgba(108, 99, 255, 0.1);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }

        .cancel-btn {
            padding: 12px 20px;
            background-color: var(--bg-color);
            color: var(--text-light);
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .cancel-btn:hover {
            background-color: #E2E8F0;
        }

        .submit-btn {
            padding: 12px 20px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .submit-btn:hover {
            background-color: var(--secondary-color);
        }

        /* Configuración Styles */
        .config-section {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .config-section h3 {
            margin-bottom: 20px;
            color: var(--primary-color);
            font-size: 18px;
        }

        .config-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        /* Reportes Styles */
        .reporte-container {
            display: flex;
            gap: 30px;
            margin-bottom: 30px;
        }

        .reporte-grafico {
            flex: 2;
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .reporte-detalle {
            flex: 1;
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        /* Responsive Styles */
        @media (max-width: 1200px) {
            .content-row, .reporte-container {
                flex-direction: column;
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
                overflow: hidden;
            }
            
            .logo span,
            nav ul li a span,
            .user-info,
            .btn-add span {
                display: none;
            }
            
            .logo {
                justify-content: center;
                padding: 25px 0;
            }
            
            nav ul li a {
                justify-content: center;
                padding: 15px 0;
            }
            
            nav ul li a i {
                margin-right: 0;
                font-size: 20px;
            }
            
            .user-profile {
                justify-content: center;
                padding: 20px 0;
            }
            
            .user-profile img {
                margin-right: 0;
            }
        }

        @media (max-width: 768px) {
            .stats-cards {
                grid-template-columns: 1fr 1fr;
            }
            
            header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
                padding: 15px;
            }
            
            .search-bar {
                width: 100%;
            }
            
            .header-actions {
                width: 100%;
                justify-content: space-between;
            }
        }

        @media (max-width: 576px) {
            .stats-cards, .config-grid {
                grid-template-columns: 1fr;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            .modal-content {
                margin: 0 15px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <i class="fas fa-tshirt"></i>
                <span>StyleStock</span>
            </div>
            <nav>
                <ul>
                    <li class="active" data-section="dashboard">
                        <a href="#">
                            <i class="fas fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li data-section="inventario">
                        <a href="#">
                            <i class="fas fa-boxes"></i>
                            <span>Inventario</span>
                        </a>
                    </li>
                    <li data-section="categorias">
                        <a href="#">
                            <i class="fas fa-tags"></i>
                            <span>Categorías</span>
                        </a>
                    </li>
                    <li data-section="reportes">
                        <a href="#">
                            <i class="fas fa-chart-line"></i>
                            <span>Reportes</span>
                        </a>
                    </li>
                    <li data-section="configuracion">
                        <a href="#">
                            <i class="fas fa-cog"></i>
                            <span>Configuración</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="user-profile">
                <img src="https://randomuser.me/api/portraits/men/65.jpg" alt="Usuario">
                <div class="user-info">
                    <span class="user-name">Juan</span>
                    <span class="user-role">Administrador</span>
                </div>
                <a href="../controlador/usuarios_c.php?accion=salir" class="btn-salir" title="Cerrar sesión">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <header>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Buscar...">
                </div>
                <div class="header-actions">
                    <button class="btn-notification">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                    <button class="btn-add" id="main-action-btn">
                        <i class="fas fa-plus"></i>
                        <span>Agregar</span>
                    </button>
                </div>
            </header>

            <div class="content">
                <!-- Dashboard Section -->
                <div class="content-section" id="dashboard-section">
                    <div class="page-header">
                        <h1>Dashboard</h1>
                        <p>Resumen general del inventario</p>
                    </div>

                    <!-- Stats Cards -->
                    <div class="stats-cards">
                        <div class="card">
                            <div class="card-icon bg-blue">
                                <i class="fas fa-tshirt"></i>
                            </div>
                            <div class="card-info">
                                <h3>1,248</h3>
                                <p>Productos en stock</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-icon bg-green">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="card-info">
                                <h3>$48,750</h3>
                                <p>Valor total</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-icon bg-orange">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="card-info">
                                <h3>24</h3>
                                <p>Productos bajos</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-icon bg-purple">
                                <i class="fas fa-calendar-week"></i>
                            </div>
                            <div class="card-info">
                                <h3>56</h3>
                                <p>Agregados hoy</p>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Products and Quick Actions -->
                    <div class="content-row">
                        <div class="recent-products">
                            <div class="section-header">
                                <h2>Productos recientes</h2>
                                <a href="#" class="view-all">Ver todos</a>
                            </div>
                            <div class="table-container">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Producto</th>
                                            <th>Categoría</th>
                                            <th>Tallas</th>
                                            <th>Stock</th>
                                            <th>Precio</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productos-recientes">
                                        <!-- Los datos se llenarán con JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="quick-actions">
                            <div class="section-header">
                                <h2>Acciones rápidas</h2>
                            </div>
                            <div class="action-buttons">
                                <button class="action-btn">
                                    <i class="fas fa-barcode"></i>
                                    <span>Generar códigos de barras</span>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-file-export"></i>
                                    <span>Exportar inventario</span>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-file-import"></i>
                                    <span>Importar productos</span>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-filter"></i>
                                    <span>Filtrar por categoría</span>
                                </button>
                            </div>

                            <div class="low-stock">
                                <div class="section-header">
                                    <h2>Productos con stock bajo</h2>
                                </div>
                                <div class="low-stock-items" id="low-stock-items">
                                    <!-- Los datos se llenarán con JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inventario Section -->
                <div class="content-section" id="inventario-section" style="display: none;">
                    <div class="page-header">
                        <h1>Inventario</h1>
                        <p>Gestión de productos y stock</p>
                    </div>

                    <div class="filtros-inventario">
                        <div class="search-bar" style="width: 300px;">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Buscar producto...">
                        </div>
                        <select id="filtro-categoria">
                            <option value="">Todas las categorías</option>
                            <option value="camisas">Camisas</option>
                            <option value="pantalones">Pantalones</option>
                            <option value="vestidos">Vestidos</option>
                            <option value="zapatos">Zapatos</option>
                        </select>
                        <select id="filtro-estado">
                            <option value="">Todos los estados</option>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>

                    <div class="table-container" style="margin-top: 20px;">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Categoría</th>
                                    <th>Tallas</th>
                                    <th>Stock</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tabla-inventario">
                                <!-- Los datos se llenarán con JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <div class="paginacion" style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center;">
                        <div class="mostrando">
                            Mostrando 1-10 de 1248 productos
                        </div>
                        <div class="paginas">
                            <button class="pagina-btn"><i class="fas fa-chevron-left"></i></button>
                            <button class="pagina-btn active">1</button>
                            <button class="pagina-btn">2</button>
                            <button class="pagina-btn">3</button>
                            <span>...</span>
                            <button class="pagina-btn">25</button>
                            <button class="pagina-btn"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- Modal para agregar producto -->
    <div class="modal" id="addProductModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Agregar nuevo producto</h2>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="productForm">
                    <div class="form-group">
                        <label for="productName">Nombre del producto</label>
                        <input type="text" id="productName" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="productCategory">Categoría</label>
                            <select id="productCategory" required>
                                <option value="">Seleccionar categoría</option>
                                <option value="camisas">Camisas</option>
                                <option value="pantalones">Pantalones</option>
                                <option value="vestidos">Vestidos</option>
                                <option value="zapatos">Zapatos</option>
                                <option value="accesorios">Accesorios</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="productBrand">Marca</label>
                            <input type="text" id="productBrand" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="productPrice">Precio</label>
                            <input type="number" id="productPrice" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="productCost">Costo</label>
                            <input type="number" id="productCost" step="0.01" required>
                        </div>
                    </div>
                    <div class="form-group sizes-container">
                        <label>Tallas y cantidades</label>
                        <div class="size-inputs">
                            <div class="size-input">
                                <input type="text" placeholder="Talla (ej. S)" class="size">
                                <input type="number" placeholder="Cantidad" class="quantity" min="0">
                                <button type="button" class="remove-size"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <button type="button" class="add-size-btn">+ Agregar talla</button>
                    </div>
                    <div class="form-group">
                        <label for="productDescription">Descripción</label>
                        <textarea id="productDescription" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="productImage">Imagen del producto</label>
                        <input type="file" id="productImage" accept="image/*">
                    </div>
                    <div class="form-actions">
                        <button type="button" class="cancel-btn">Cancelar</button>
                        <button type="submit" class="submit-btn">Guardar producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para agregar categoría -->
    <div class="modal" id="addCategoryModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Nueva categoría</h2>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="categoryForm">
                    <div class="form-group">
                        <label for="categoryName">Nombre de la categoría</label>
                        <input type="text" id="categoryName" required>
                    </div>
                    <div class="form-group">
                        <label for="categoryDescription">Descripción</label>
                        <textarea id="categoryDescription" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="categoryImage">Imagen representativa</label>
                        <input type="file" id="categoryImage" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="categoryStatus">Estado</label>
                        <select id="categoryStatus">
                            <option value="activa">Activa</option>
                            <option value="inactiva">Inactiva</option>
                        </select>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="cancel-btn">Cancelar</button>
                        <button type="submit" class="submit-btn">Guardar categoría</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Datos de ejemplo para el inventario
            const sampleProducts = [
                {
                    id: 'PRD-001',
                    name: 'Camiseta básica blanca',
                    category: 'Camisas',
                    sizes: ['S', 'M', 'L', 'XL'],
                    stock: 124,
                    price: 19.99,
                    image: 'https://via.placeholder.com/80',
                    status: 'activo'
                },
                {
                    id: 'PRD-002',
                    name: 'Jeans slim fit azul',
                    category: 'Pantalones',
                    sizes: ['28', '30', '32', '34'],
                    stock: 56,
                    price: 49.99,
                    image: 'https://via.placeholder.com/80',
                    status: 'activo'
                },
                {
                    id: 'PRD-003',
                    name: 'Vestido floral verano',
                    category: 'Vestidos',
                    sizes: ['S', 'M', 'L'],
                    stock: 32,
                    price: 39.99,
                    image: 'https://via.placeholder.com/80',
                    status: 'activo'
                },
                {
                    id: 'PRD-004',
                    name: 'Zapatillas deportivas',
                    category: 'Zapatos',
                    sizes: ['36', '38', '40', '42'],
                    stock: 78,
                    price: 59.99,
                    image: 'https://via.placeholder.com/80',
                    status: 'activo'
                },
                {
                    id: 'PRD-005',
                    name: 'Chaqueta denim',
                    category: 'Chaquetas',
                    sizes: ['S', 'M', 'L'],
                    stock: 15,
                    price: 69.99,
                    image: 'https://via.placeholder.com/80',
                    status: 'inactivo'
                }
            ];

            // Datos de ejemplo para productos con stock bajo
            const lowStockProducts = [
                {
                    name: 'Camiseta básica negra',
                    category: 'Camisas',
                    stock: 3,
                    image: 'https://via.placeholder.com/40'
                },
                {
                    name: 'Shorts vaqueros',
                    category: 'Pantalones',
                    stock: 5,
                    image: 'https://via.placeholder.com/40'
                },
                {
                    name: 'Bolso bandolera',
                    category: 'Accesorios',
                    stock: 2,
                    image: 'https://via.placeholder.com/40'
                }
            ];

            // Datos de ejemplo para categorías
            const sampleCategories = [
                {
                    name: 'Camisas',
                    description: 'Camisas de vestir y casuales',
                    products: 45,
                    status: 'activa'
                },
                {
                    name: 'Pantalones',
                    description: 'Jeans, pantalones formales y casuales',
                    products: 32,
                    status: 'activa'
                },
                {
                    name: 'Vestidos',
                    description: 'Vestidos para diferentes ocasiones',
                    products: 28,
                    status: 'activa'
                },
                {
                    name: 'Zapatos',
                    description: 'Calzado para hombre y mujer',
                    products: 15,
                    status: 'activa'
                },
                {
                    name: 'Accesorios',
                    description: 'Bolsos, cinturones y más',
                    products: 12,
                    status: 'inactiva'
                }
            ];

            // Elementos del DOM
            const tableBody = document.querySelector('#productos-recientes');
            const lowStockContainer = document.querySelector('#low-stock-items');
            const addProductBtn = document.querySelector('.btn-add');
            const modal = document.getElementById('addProductModal');
            const closeModalBtn = document.querySelector('.close-modal');
            const cancelBtn = document.querySelector('.cancel-btn');
            const productForm = document.getElementById('productForm');
            const sizeInputsContainer = document.querySelector('.size-inputs');
            const addSizeBtn = document.querySelector('.add-size-btn');
            const mainActionBtn = document.getElementById('main-action-btn');
            const categoryModal = document.getElementById('addCategoryModal');
            const categoryForm = document.getElementById('categoryForm');
            const btnNuevaCategoria = document.getElementById('btn-nueva-categoria');
            const tablaCategorias = document.getElementById('tabla-categorias');
            const tablaInventario = document.getElementById('tabla-inventario');
            
            // Navegación entre secciones
            const navItems = document.querySelectorAll('nav ul li');
            const contentSections = document.querySelectorAll('.content-section');

            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    const section = this.getAttribute('data-section');
                    
                    // Remover clase active de todos los items
                    navItems.forEach(navItem => {
                        navItem.classList.remove('active');
                    });
                    
                    // Agregar clase active al item seleccionado
                    this.classList.add('active');
                    
                    // Ocultar todas las secciones
                    contentSections.forEach(sec => {
                        sec.style.display = 'none';
                    });
                    
                    // Mostrar la sección correspondiente
                    document.getElementById(`${section}-section`).style.display = 'block';
                    
                    // Cambiar el texto del botón principal según la sección
                    switch(section) {
                        case 'inventario':
                            mainActionBtn.innerHTML = '<i class="fas fa-plus"></i><span>Agregar producto</span>';
                            break;
                        case 'categorias':
                            mainActionBtn.innerHTML = '<i class="fas fa-plus"></i><span>Agregar categoría</span>';
                            break;
                        case 'reportes':
                            mainActionBtn.innerHTML = '<i class="fas fa-file-export"></i><span>Exportar reporte</span>';
                            break;
                        case 'configuracion':
                            mainActionBtn.innerHTML = '<i class="fas fa-save"></i><span>Guardar cambios</span>';
                            break;
                        default:
                            mainActionBtn.innerHTML = '<i class="fas fa-plus"></i><span>Agregar</span>';
                    }
                });
            });

            // Llenar la tabla con productos
            function populateTable() {
                tableBody.innerHTML = '';
                
                sampleProducts.forEach(product => {
                    const row = document.createElement('tr');
                    
                    row.innerHTML = `
                        <td>${product.id}</td>
                        <td>
                            <div class="product-info">
                                <img src="${product.image}" alt="${product.name}">
                                <span>${product.name}</span>
                            </div>
                        </td>
                        <td>${product.category}</td>
                        <td>${product.sizes.join(', ')}</td>
                        <td>${product.stock}</td>
                        <td>$${product.price.toFixed(2)}</td>
                        <td>
                            <button class="action-icon edit-btn" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="action-icon delete-btn" title="Eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    `;
                    
                    tableBody.appendChild(row);
                });
            }

            // Llenar la tabla de inventario
            function populateInventoryTable() {
                tablaInventario.innerHTML = '';
                
                sampleProducts.forEach(product => {
                    const row = document.createElement('tr');
                    const statusBadge = product.status === 'activo' ? 
                        '<span class="badge activo">Activo</span>' : 
                        '<span class="badge inactivo">Inactivo</span>';
                    
                    row.innerHTML = `
                        <td>${product.id}</td>
                        <td>
                            <div class="product-info">
                                <img src="${product.image}" alt="${product.name}">
                                <span>${product.name}</span>
                            </div>
                        </td>
                        <td>${product.category}</td>
                        <td>${product.sizes.join(', ')}</td>
                        <td>${product.stock}</td>
                        <td>$${product.price.toFixed(2)}</td>
                        <td>${statusBadge}</td>
                        <td>
                            <button class="action-icon edit-btn" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="action-icon delete-btn" title="Eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    `;
                    
                    tablaInventario.appendChild(row);
                });
            }

            // Llenar la tabla de categorías
            function populateCategoriesTable() {
                tablaCategorias.innerHTML = '';
                
                sampleCategories.forEach(category => {
                    const row = document.createElement('tr');
                    const statusBadge = category.status === 'activa' ? 
                        '<span class="badge activo">Activa</span>' : 
                        '<span class="badge inactivo">Inactiva</span>';
                    
                    row.innerHTML = `
                        <td>${category.name}</td>
                        <td>${category.description}</td>
                        <td>${category.products}</td>
                        <td>${statusBadge}</td>
                        <td>
                            <button class="action-icon edit-btn" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="action-icon delete-btn" title="Eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    `;
                    
                    tablaCategorias.appendChild(row);
                });
            }

            // Llenar la sección de stock bajo
            function populateLowStock() {
                lowStockContainer.innerHTML = '';
                
                lowStockProducts.forEach(product => {
                    const item = document.createElement('div');
                    item.className = 'stock-item';
                    
                    item.innerHTML = `
                        <img src="${product.image}" alt="${product.name}">
                        <div class="stock-info">
                            <h4>${product.name}</h4>
                            <p>${product.category}</p>
                        </div>
                        <div class="stock-quantity">${product.stock}</div>
                    `;
                    
                    lowStockContainer.appendChild(item);
                });
            }

            // Mostrar modal
            function showModal(modalId) {
                document.getElementById(modalId).classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            // Ocultar modal
            function hideModal(modalId) {
                document.getElementById(modalId).classList.remove('active');
                document.body.style.overflow = 'auto';
            }

            // Agregar campo de talla
            function addSizeInput() {
                const sizeInput = document.createElement('div');
                sizeInput.className = 'size-input';
                
                sizeInput.innerHTML = `
                    <input type="text" placeholder="Talla (ej. S)" class="size">
                    <input type="number" placeholder="Cantidad" class="quantity" min="0">
                    <button type="button" class="remove-size"><i class="fas fa-times"></i></button>
                `;
                
                sizeInputsContainer.appendChild(sizeInput);
                
                // Agregar evento al botón de eliminar
                const removeBtn = sizeInput.querySelector('.remove-size');
                removeBtn.addEventListener('click', () => {
                    sizeInput.remove();
                });
            }

            // Event Listeners
            addProductBtn.addEventListener('click', () => showModal('addProductModal'));
            btnNuevaCategoria.addEventListener('click', () => showModal('addCategoryModal'));
            
            // Cerrar modales
            document.querySelectorAll('.close-modal').forEach(btn => {
                btn.addEventListener('click', function() {
                    const modal = this.closest('.modal');
                    hideModal(modal.id);
                });
            });
            
            document.querySelectorAll('.cancel-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const modal = this.closest('.modal');
                    hideModal(modal.id);
                });
            });
            
            // Cerrar modal al hacer clic fuera del contenido
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        hideModal(modal.id);
                    }
                });
            });

            addSizeBtn.addEventListener('click', addSizeInput);

            // Enviar formulario de producto
            productForm.addEventListener('submit', (e) => {
                e.preventDefault();
                
                // Aquí iría la lógica para guardar el producto
                alert('Producto guardado exitosamente!');
                hideModal('addProductModal');
                productForm.reset();
                
                // Limpiar campos de tallas excepto el primero
                const sizeInputs = document.querySelectorAll('.size-input');
                sizeInputs.forEach((input, index) => {
                    if (index > 0) {
                        input.remove();
                    } else {
                        input.querySelector('.size').value = '';
                        input.querySelector('.quantity').value = '';
                    }
                });
            });

            // Enviar formulario de categoría
            categoryForm.addEventListener('submit', (e) => {
                e.preventDefault();
                
                // Aquí iría la lógica para guardar la categoría
                alert('Categoría guardada exitosamente!');
                hideModal('addCategoryModal');
                categoryForm.reset();
                populateCategoriesTable();
            });

            // Botón principal dinámico
            mainActionBtn.addEventListener('click', function() {
                const activeSection = document.querySelector('nav ul li.active').getAttribute('data-section');
                
                switch(activeSection) {
                    case 'inventario':
                        showModal('addProductModal');
                        break;
                    case 'categorias':
                        showModal('addCategoryModal');
                        break;
                    case 'reportes':
                        alert('Exportando reporte...');
                        break;
                    case 'configuracion':
                        document.getElementById('form-tienda').dispatchEvent(new Event('submit'));
                        break;
                    default:
                        showModal('addProductModal');
                }
            });

            // Inicializar la página
            populateTable();
            populateInventoryTable();
            populateCategoriesTable();
            populateLowStock();
            
            // Agregar el primer campo de talla
            addSizeInput();
        });
    </script>
</body>
</html>