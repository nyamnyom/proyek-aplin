<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wei Hong Restaurant - Daftar Pesanan</title>
    @include('style.kasirStyle')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 px-0 sidebar">
                <div class="p-3 d-flex align-items-center">
                    <div class="logo">WH</div>
                    <span class="navbar-brand">Wei Hong</span>
                </div>
                <div class="p-3">
                    <h6 class="text-uppercase text-muted mb-3 small">Main Menu</h6>
                    <ul class="nav flex-column">
                        <li class="nav-item" >
                            <a class="nav-link" href="restaurant-pos-system.php">
                                <i class="fas fa-plus-circle me-2"></i> Tambah Pesanan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reservasi-meja.php">
                                <i class="fas fa-bookmark me-2"></i> Reservasi Meja
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="daftar-pesanan.php">
                                <i class="fas fa-clipboard-list me-2"></i> Daftar Pesanan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-percentage me-2"></i> Promosi dan Diskon
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cog me-2"></i> Pengaturan Sistem
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10 px-0">
                <!-- Top Navigation -->
                <nav class="navbar navbar-expand navbar-light bg-white p-3">
                    <div class="container-fluid">
                        <form class="d-flex flex-grow-1 mx-4">
                            <input class="form-control search-bar" type="search" placeholder="What are you looking for?" aria-label="Search">
                        </form>
                        <div class="d-flex align-items-center">
                            <div class="notification-icon mx-3">
                                <i class="fas fa-bell fa-lg text-muted"></i>
                                <span class="notification-badge">3</span>
                            </div>
                            <div class="notification-icon mx-3">
                                <i class="fas fa-comment fa-lg text-muted"></i>
                                <span class="notification-badge">2</span>
                            </div>
                            <div class="notification-icon mx-3">
                                <i class="fas fa-heart fa-lg text-muted"></i>
                                <span class="notification-badge">1</span>
                            </div>
                            <div class="user-profile ms-4 dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                    <img src="https://img.freepik.com/premium-photo/fun-unique-cartoon-profile-picture-that-represents-your-style-personality_1283595-14223.jpg" alt="Profile" class="profile-img">
                                    <div class="ms-2">
                                        <div class="small fw-bold">Alexander Brick</div>
                                        <div class="text-muted small">Kasir</div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item logout" href="../login.php">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
                
                <!-- Main Content Area -->
                <div class="row mx-0">
                    <div class="col-md-8">
                        <div class="main-content">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="mb-0">Daftar Pesanan</h4>
                                <div class="text-muted small">
                                    <a href="#" class="text-decoration-none text-muted">Main Menu</a> / Daftar Pesanan
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="order-tabs">
                                <div class="order-tab active" data-tab="pending">Pending</div>
                                <div class="order-tab" data-tab="completed">Selesai</div>
                                <div class="order-tab" data-tab="cancelled">Dibatalkan</div>
                            </div>
                            
                            <!-- Pending Orders Section -->
                            <div class="tab-content" id="pending-tab">
                                <div class="order-item">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="fw-bold">Pesanan #34652</div>
                                        <div class="time-badge">17:04</div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="small">Nama: <span class="fw-bold">Matthew</span></div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bold me-3">Rp 250.000</div>
                                            <button class="pay-btn complete-btn" data-order-id="34652">Paid</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="order-item">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="fw-bold">Pesanan #34653</div>
                                        <div class="time-badge">17:10</div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="small">Nama: <span class="fw-bold">Erick</span></div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bold me-3">Rp 80.000</div>
                                            <button class="pay-btn complete-btn" data-order-id="34653">Paid</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="order-item">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="fw-bold">Pesanan #34654</div>
                                        <div class="time-badge">17:14</div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="small">Nama: <span class="fw-bold">Reva</span></div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bold me-3">Rp 350.000</div>
                                            <button class="pay-btn complete-btn" data-order-id="34654">Paid</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="order-item">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="fw-bold">Pesanan #34655</div>
                                        <div class="time-badge">17:20</div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="small">Nama: <span class="fw-bold">Jeremy</span></div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bold me-3">Rp 310.000</div>
                                            <button class="pay-btn complete-btn" data-order-id="34655">Paid</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="order-item">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="fw-bold">Pesanan #34656</div>
                                        <div class="time-badge">17:30</div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="small">Nama: <span class="fw-bold">Valen</span></div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bold me-3">Rp 250.000</div>
                                            <button class="pay-btn complete-btn" data-order-id="34656">Paid</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="order-item">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="fw-bold">Pesanan #34657</div>
                                        <div class="time-badge">17:40</div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="small">Nama: <span class="fw-bold">Ovidio</span></div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bold me-3">Rp 365.000</div>
                                            <button class="pay-btn complete-btn" data-order-id="34657">Paid</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="order-item">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="fw-bold">Pesanan #34658</div>
                                        <div class="time-badge">17:44</div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="small">Nama: <span class="fw-bold">Jessica</span></div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bold me-3">Rp 240.000</div>
                                            <button class="pay-btn complete-btn" data-order-id="34658">Paid</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Completed Orders Section (Initially Hidden) -->
                            <div class="tab-content" id="completed-tab" style="display: none;">
                                <!-- Completed orders will be dynamically added here -->
                            </div>
                            
                            <!-- Cancelled Orders Section (Initially Hidden) -->
                            <div class="tab-content" id="cancelled-tab" style="display: none;">
                                <!-- We won't implement this as per your request -->
                                <p class="text-muted text-center my-5">No cancelled orders</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Panel - Order Details -->
                    <div class="col-md-4">
                        <div class="right-panel" id="order-details">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <div class="fw-bold">Pesanan #34652 | Matthew</div>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-outline-secondary date-selector">
                                        <i class="far fa-calendar me-1"></i> Select 02/12/24
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="fw-bold">Menu</div>
                                    <div class="fw-bold">Qty</div>
                                </div>
                                
                                <div class="menu-item">
                                    <div>Nasi Semacem Babi</div>
                                    <div>2</div>
                                </div>
                                
                                <div class="menu-item">
                                    <div>Nasi Chachu Babi</div>
                                    <div>1</div>
                                </div>
                                
                                <div class="menu-item">
                                    <div>Mie Semacem Babi</div>
                                    <div>3</div>
                                </div>
                                
                                <div class="menu-item">
                                    <div>Mie Chachu Babi</div>
                                    <div>1</div>
                                </div>
                            </div>
                            
                            <div class="mt-4 mb-3">
                                <button class="action-btn" id="complete-action-btn">
                                    <i class="fas fa-check me-2"></i> Complete
                                </button>
                            </div>
                            
                            <div class="mb-3">
                                <button class="action-btn" id="print-btn" style="background-color: #28a745;">
                                    <i class="fas fa-print me-2"></i> Print Nota
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching functionality
            const tabs = document.querySelectorAll('.order-tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('active'));
                    
                    // Add active class to clicked tab
                    this.classList.add('active');
                    
                    // Hide all tab contents
                    document.querySelectorAll('.tab-content').forEach(content => {
                        content.style.display = 'none';
                    });
                    
                    // Show the selected tab content
                    const tabName = this.getAttribute('data-tab');
                    document.getElementById(tabName + '-tab').style.display = 'block';
                });
            });
            
            // Function to move an order to completed
            function moveToCompleted(orderId, orderName, orderAmount, orderTime) {
                // Create the completed order element
                const completedOrder = document.createElement('div');
                completedOrder.className = 'order-item';
                completedOrder.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="fw-bold">Pesanan #${orderId}</div>
                        <div class="time-badge">${orderTime}</div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">Nama: <span class="fw-bold">${orderName}</span></div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="fw-bold me-3">${orderAmount}</div>
                            <button class="pay-btn" style="background-color: #28a745;" disabled>Completed</button>
                        </div>
                    </div>
                `;
                
                // Add to completed tab
                document.getElementById('completed-tab').appendChild(completedOrder);
                
                // Remove from pending tab
                const pendingOrder = document.querySelector(`[data-order-id="${orderId}"]`).closest('.order-item');
                pendingOrder.remove();

                // Show notification
                alert(`Order #${orderId} has been marked as completed!`);
            }
            
            // Complete button event handler (for buttons in the list)
            document.querySelectorAll('.complete-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-order-id');
                    const orderItem = this.closest('.order-item');
                    const orderName = orderItem.querySelector('.fw-bold').nextElementSibling.textContent;
                    const orderAmount = orderItem.querySelector('.fw-bold.me-3').textContent;
                    const orderTime = orderItem.querySelector('.time-badge').textContent;
                    
                    moveToCompleted(orderId, orderName, orderAmount, orderTime);
                });
            });
            
            // Complete action button (in the right panel)
            document.getElementById('complete-action-btn').addEventListener('click', function() {
                // Get the currently displayed order details
                const orderDetails = document.querySelector('#order-details .fw-bold').textContent;
                const regex = /#(\d+)\s*\|\s*(\w+)/;
                const match = orderDetails.match(regex);
                
                if (match) {
                    const orderId = match[1];
                    const orderName = match[2];
                    
                    // Find the order in the pending list
                    const pendingOrder = document.querySelector(`[data-order-id="${orderId}"]`);
                    if (pendingOrder) {
                        const orderItem = pendingOrder.closest('.order-item');
                        const orderAmount = orderItem.querySelector('.fw-bold.me-3').textContent;
                        const orderTime = orderItem.querySelector('.time-badge').textContent;
                        
                        moveToCompleted(orderId, orderName, orderAmount, orderTime);
                    }
                }
            });
            
            // Print button
            document.getElementById('print-btn').addEventListener('click', function() {
                alert('Printing receipt...');
                // In a real app, this would trigger a print action
            });
            
            // Handle order detail view when clicking on order items
            document.querySelectorAll('.order-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    // Don't trigger if clicking on the complete button
                    if (e.target.classList.contains('complete-btn')) {
                        return;
                    }
                    
                    const orderId = this.querySelector('.fw-bold').textContent.replace('Pesanan #', '');
                    const orderName = this.querySelector('.fw-bold').nextElementSibling.textContent;
                    
                    // Update the right panel with this order's details
                    document.querySelector('#order-details .fw-bold').textContent = `Pesanan #${orderId} | ${orderName}`;
                });
            });
        });
    </script>
</body>
</html>
