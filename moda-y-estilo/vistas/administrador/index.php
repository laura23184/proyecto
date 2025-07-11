<?php  
include("head.php");  
    include '../../conexion.php';
    include '../../modelos/inventario_m.php';

    $resultado =  obtenerProducto($conn);
?>

<body>

 
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <i class="fas fa-tshirt"></i>
                <span>Moda&Estilo</span>
            </div>
            <nav>
                    <ul>
                    <li class="active" data-section="Inicio">
                        <a href="index.php">
                            <i class="fas fa-home"></i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li  data-section="inventario">
                        <a href="inventario.php">
                            <i class="fas fa-boxes"></i>
                            <span>Productos</span>
                        </a>
                    </li>
                    <li data-section="categorias">
                        <a href="categorias.php">
                            <i class="fas fa-tags"></i>
                            <span>Categorías</span>
                        </a>
                    </li>
                    <li data-section="Ventas">
                        <a href="ventas.php">
                            <i class="fas fa-chart-line"></i>
                            <span>Ventas</span>
                        </a>
                    </li>
                     <li data-section="clientes">
                        <a href="clientes.php">
                            <i class="fas fa-users"></i>
                            <span>clientes</span>
                        </a>
                    </li>
                    <li data-section="configuracion">
                        <a href="configuracion.php">
                            <i class="fas fa-cog"></i>
                            <span>Configuración</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="user-profile">
                <div class="user-info">
                    <span class="user-name"></span>
                    <span class="user-role">Administrador</span>
                </div>
                <a href="../../controlador/usuarios_c.php?accion=salir" class="btn-salir" title="Cerrar sesión">
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
                  <div class="content-section" id="dashboard-section">
                    <div class="page-header">
                        <h1>Inicio</h1>
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
                                            <th>Codigo/Producto</th>
                                            <th>Categoría</th>
                                            <th>Cantidad</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productos-recientes">
                                         <tr>
                                            <td>
                                                <select name="producto" id="producto" onchange="elegirProd()">
                                                    <?php 
                                                        foreach ($resultado as $key => $value) {
                                                    ?>
                                                        <option value="<?= $value['id'] ?>"><?= $value['nombre']."-".$value['codigo']; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                    
                                            </td>
                                            <td></td>
                                            <td><input type="number"></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                         <tr>
                                            <th>TOTAL:</th>
                                            <th></th>
                                            <th></th>
                                            <th>$</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <script>
                            function elegirProd() {
                                alert(document.getElementById('producto').value)
                            }
                        </script>
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