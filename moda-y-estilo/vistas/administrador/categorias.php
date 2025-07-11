
<?php 

    include("head.php"); 
    include '../../conexion.php';
    include '../../modelos/categorias_m.php';

    $resultado =  obtenerCategorias($conn);
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
                    <li  data-section="Inicio">
                        <a href="index.php">
                            <i class="fas fa-home"></i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li data-section="inventario">
                        <a href="inventario.php">
                            <i class="fas fa-boxes"></i>
                            <span>Productos</span>
                        </a>
                    </li>
                    <li class="active" data-section="categorias">
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
                <img src="https://randomuser.me/api/portraits/men/65.jpg" alt="Usuario">
                <div class="user-info">
                    <span class="user-name">Juan</span>
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

              <!-- Categorías Section -->
               <div class="content">
                <div class="content-section" id="categorias-section">
                    <div class="page-header">
                        <h1>Categorías</h1>
                        <p>Gestión de categorías de productos</p>
                    </div>

                    <div class="config-section">
                        <div class="section-header">
                            <h2>Lista de categorías</h2>
                            <button class="btn-add" id="btn-nueva-categoria">
                                <i class="fas fa-plus"></i>
                                <span>Nueva categoría</span>
                            </button>
                        </div>

                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tabla-categorias">
                                    <?php 
                                        foreach ($resultado as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?= $value['nombre']; ?></td>
                                        <td>
                                            <button onClick="verParaEditar('<?= $value['id'] ?>','<?= $value['nombre'] ?>')" class="btn btn-warning"><i class="fas fa-pencil"></i></button> 
                                            <a href="../../controlador/categorias_c.php?accion=eliminar&id=<?= $value['id'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>

                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
                <form id="" action="../../controlador/categorias_c.php?accion=crear" method="post">
                    <input type="hidden" id="id" name="id" >
                    <div class="form-group">
                        <label for="categoryName">Nombre de la categoría</label>
                        <input type="text" id="nombre" name="nombre" required>
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
    function verParaEditar(id, nombre) {
        document.getElementById("id").value = id;
        document.getElementById("nombre").value = nombre;
        document.getElementById("addCategoryModal").classList.add('active');
    }

        document.addEventListener('DOMContentLoaded', function() {
            

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
                document.getElementById("id").value ="";
                document.getElementById("nombre").value ="";
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
            
          
        });
    </script>
</body>
</html>