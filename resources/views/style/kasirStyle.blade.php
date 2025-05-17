<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
    /* Global Styles */
:root {
    --primary-color: #8B0000;
    --secondary-color: #D32F2F;
    --text-light: #FFFFFF;
    --text-dark: #333333;
    --bg-gray: #F5F5F5;
    --primary-red: #8B0000;
    --dark-red: #D32F2F;
    --light-red: #F8D7DA;
    --white: #ffffff;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: var(--bg-gray);
}

/* Sidebar Styles */
.sidebar {
    background-color: var(--text-light);
    height: 100vh;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.sidebar .nav-link {
    color: var(--text-dark);
    padding: 10px 15px;
    border-radius: 5px;
    margin-bottom: 5px;
}

.sidebar .nav-link.active {
    background-color: var(--primary-color);
    color: var(--text-light);
}

.sidebar .nav-link:hover:not(.active) {
    background-color: rgba(139, 0, 0, 0.1);
}

.navbar-brand {
    color: var(--primary-color);
    font-weight: bold;
}

.logout {
    color: red;
}

.logo {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: var(--primary-color);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    margin-right: 10px;
}

/* Main Content */
.main-content {
    padding: 20px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.05);
    margin: 20px;
}

.content-area {
    padding: 20px;
}

.content-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.breadcrumb {
    margin-bottom: 0;
}

/* Tab Styles */
.tab-buttons {
    display: flex;
    background-color: #f8f9fa;
    border-radius: 5px;
    overflow: hidden;
    margin-bottom: 20px;
}

.tab-btn {
    flex: 1;
    text-align: center;
    padding: 10px;
    background-color: transparent;
    border: none;
    cursor: pointer;
}

.tab-btn.active {
    background-color: var(--primary-color);
    color: white;
}

.category-tab {
    border-bottom: 2px solid #ddd;
    margin-bottom: 20px;
}

.category-tab .nav-link {
    color: var(--text-dark);
    border: none;
    padding: 10px 20px;
    margin-right: 5px;
}

.category-tab .nav-link.active {
    border-bottom: 3px solid var(--primary-color);
    color: var(--primary-color);
    font-weight: bold;
}

/* Menu Card Styles */
.menu-card {
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    cursor: pointer;
    transition: transform 0.3s;
}

.menu-card:hover {
    transform: translateY(-5px);
}

.menu-image {
    height: 150px;
    background-color: var(--primary-color);
    display: flex;
    align-items: center;
    justify-content: center;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.menu-image img {
    max-width: 100%;
    max-height: 100%;
    border-radius: 50%;
    width: 120px;
    height: 120px;
    object-fit: cover;
}

.menu-details {
    padding: 15px;
    text-align: center;
}

.menu-title {
    font-weight: bold;
    margin-bottom: 5px;
    color: var(--text-dark);
}

.menu-price {
    color: var(--primary-color);
    font-weight: bold;
}

.menu-category {
    color: #777;
    font-size: 0.9rem;
}

/* Order Item Styles */
.order-item {
    padding: 15px 0;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.order-left {
    display: flex;
    flex-direction: column;
}

.order-id {
    font-weight: bold;
    margin-bottom: 4px;
}

.order-price {
    font-weight: bold;
}

.item-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.item-qty {
    width: 30px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.delete-btn {
    background-color: #f8d7da;
    color: #721c24;
    border: none;
    border-radius: 5px;
    width: 25px;
    height: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.note-input {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 8px;
    margin-top: 5px;
    width: 100%;
}

/* Notification Styles */
.notification-icon {
    position: relative;
}

.notification-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background-color: var(--primary-color);
    color: white;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    font-size: 0.7rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* User Profile */
.user-profile {
    display: flex;
    align-items: center;
}

.profile-img {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    margin-right: 10px;
}

/* Payment Method Styles */
.payment-method-container {
    display: flex;
    margin-bottom: 15px;
    overflow-x: auto;
    padding-bottom: 5px;
}

.payment-method {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
    min-width: 70px;
    margin-right: 10px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s;
}

.payment-method.active {
    border-color: var(--primary-color);
    background-color: rgba(139, 0, 0, 0.1);
}

.payment-method img {
    max-width: 100%;
    height: 30px;
    margin-bottom: 5px;
}

/* Payment Details */
.payment-details {
    background-color: #f9f9f9;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 15px;
}

.payment-summary {
    padding: 15px 0;
    border-top: 1px dashed #ddd;
    border-bottom: 1px dashed #ddd;
    margin: 15px 0;
}

/* Button Styles */
.cancel-btn {
    background-color: #f8f9fa;
    color: var(--text-dark);
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px 15px;
}

.confirm-btn {
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 15px;
}

.btn-primary {
    background-color: var(--primary-red);
    border-color: var(--primary-red);
}

.btn-primary:hover {
    background-color: var(--dark-red);
    border-color: var(--dark-red);
}

.checkout-btn {
    background-color: var(--primary-color);
    color: white;
    padding: 12px;
    border: none;
    border-radius: 5px;
    font-weight: bold;
    width: 100%;
    margin-top: 20px;
}

/* Order Summary */
.order-section {
    background-color: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    height: calc(100vh - 100px);
    overflow-y: auto;
}

.order-header {
    border-bottom: 1px solid #ddd;
    padding-bottom: 15px;
    margin-bottom: 15px;
}

.order-summary {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #ddd;
}

.bill-info {
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

/* Reservation Form Styles */
.reservation-form {
    background-color: var(--white);
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.reservation-form .form-control {
    margin-bottom: 15px;
}

/* Calendar Styles */
.calendar {
    background-color: var(--white);
    border-radius: 5px;
    padding: 10px;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
}

.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.calendar-days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 5px;
    text-align: center;
}

.calendar-days div {
    padding: 5px;
    border-radius: 50%;
    cursor: pointer;
}

.calendar-days div:hover {
    background-color: #eee;
}

.calendar-days .selected {
    background-color: var(--primary-red);
    color: var(--white);
}

/* Clock Styles */
.clock {
    position: relative;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background-color: var(--white);
    border: 2px solid #ddd;
    margin: 0 auto;
}

.clock-hand {
    position: absolute;
    width: 2px;
    height: 60px;
    background-color: var(--primary-red);
    left: 50%;
    bottom: 50%;
    transform-origin: bottom;
    transform: translateX(-50%) rotate(280deg);
    z-index: 1;
}

.clock-hand::after {
    content: "";
    position: absolute;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: var(--primary-red);
    bottom: -6px;
    left: -5px;
}

.clock-mark {
    position: absolute;
    width: 100%;
    height: 100%;
    font-size: 12px;
    transform: rotate(0deg);
}

.clock-mark div {
    position: absolute;
    padding: 3px;
    border-radius: 50%;
    border: 1px solid #ddd;
    background-color: var(--white);
}

/* Table Options */
.table-options {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
    margin-top: 20px;
}

.table-item {
    padding: 15px;
    border-radius: 5px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s;
}

.table-item.available {
    background-color: var(--white);
    border: 1px solid #ddd;
}

.table-item.reserved {
    background-color: var(--light-red);
    color: var(--white);
    border: 1px solid var(--light-red);
}

.table-item.selected {
    background-color: var(--primary-red);
    color: var(--white);
    border: 1px solid var(--primary-red);
}

.time-toggle {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}

.time-toggle button {
    border: none;
    background-color: #eee;
    padding: 5px 10px;
}

.time-toggle button.active {
    background-color: var(--primary-red);
    color: var(--white);
}

/* Table Number Styles */
.table-number {
    font-size: 22px;
    font-weight: bold;
}

.table-label {
    font-size: 12px;
}

/* Order List Styles */
.order-tabs {
    display: flex;
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
}

.order-tab {
    padding: 10px 20px;
    cursor: pointer;
    margin-right: 5px;
}

.order-tab.active {
    border-bottom: 2px solid var(--primary-color);
    color: var(--primary-color);
    font-weight: bold;
}

.time-badge {
    background-color: #f0f0f0;
    padding: 3px 8px;
    border-radius: 10px;
    font-size: 0.8rem;
}

.pay-btn {
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 5px;
    padding: 5px 10px;
    font-size: 0.8rem;
}

.complete-btn {
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 5px;
    padding: 5px 10px;
    font-size: 0.8rem;
}

.action-btn {
    width: 100%;
    padding: 10px;
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 5px;
    margin-bottom: 10px;
    text-align: left;
}

.menu-item {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    font-size: 0.95rem;
    border-bottom: 1px solid #ccc;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .sidebar {
        height: auto;
    }
    
    .menu-card {
        margin-bottom: 15px;
    }
    
    .payment-method-container {
        flex-wrap: wrap;
    }
    
    .payment-method {
        margin-bottom: 10px;
    }
}
</style>