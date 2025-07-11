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
    <title>Moda&Estilo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">

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
            background-color: #ffb1fb;
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
            color: #CC00CC;
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
            color: black;
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
            background-color:  #ffb1fb;
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
        .mm{
        margin:2%;
        padding: 1%;
        }
    </style>
</head>
