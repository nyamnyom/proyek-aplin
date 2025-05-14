@extends('Layout.layout-kasir')

@section('title', 'Wei Hong Restaurant - Daftar Pesanan')

@section('content')
    <!-- Main Content Area -->
    <div class="row mx-0" style=" height: 100vh;">
        <div class="col-md-8" style="overflow-y: auto; height: 100vh;">
            <div class="main-content" style="min-height: 100%; padding-right: 15px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Daftar Pesanan</h4>
                </div>
                
                <!-- Pending Orders Section -->
                <div class="tab-content mb-5" id="pending-tab">
                    <div class="order-item">
                        <div class="order-left">
                            <div class="order-id">Pesanan #34653</div>
                            <div class="order-time">Time : 17:10</div>
                        </div>
                        <div class="order-price">Rp 80.000</div>
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
        <div class="col-md-4 p-1">
            <div class="main-content" id="order-details">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <div class="fw-bold">Pesanan #34652</div>
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
                
                <div class="mb-3">
                    <button class="action-btn" id="print-btn" style="background-color: #28a745;">
                        <i class="fas fa-print me-2"></i> Print Nota
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
    @section('scripts')
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
    @endsection
