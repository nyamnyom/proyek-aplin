<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
    :root {
        --primary-color: #8B0000;
        --secondary-color: #D32F2F;
        --text-light: #FFFFFF;
        --text-dark: #333333;
        --bg-gray: #F5F5F5;
    }
    
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: var(--bg-gray);
    }
    
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
    
    .search-bar {
        border-radius: 20px;
        border: 1px solid #ddd;
    }
    
    .main-content {
        padding: 20px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.05);
        margin: 20px;
    }
    
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
    
    .order-tabs {
        display: flex;
        border-bottom: 1px solid #ddd;
        margin-bottom: 20px;
    }
    
    .order-tab {
        padding: 10px 20px;
        cursor: pointer;
        position: relative;
    }
    
    .order-tab.active {
        color: var(--primary-color);
        font-weight: bold;
    }
    
    .order-tab.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: var(--primary-color);
    }
    
    .order-item {
        padding: 15px;
        border-radius: 5px;
        background-color: white;
        margin-bottom: 10px;
        border: 1px solid #eee;
    }
    
    .time-badge {
        background-color: var(--primary-color);
        color: white;
        padding: 2px 8px;
        border-radius: 3px;
        font-size: 0.8rem;
    }
    
    .pay-btn {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 5px 15px;
        border-radius: 3px;
        cursor: pointer;
        font-size: 0.8rem;
    }
    
    .right-panel {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.05);
        padding: 20px;
        margin: 20px 0;
    }
    
    .menu-item {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }
    
    .menu-item:last-child {
        border-bottom: none;
    }
    
    .action-btn {
        background-color: #8B0000;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }
    
    .date-selector {
        padding: 5px 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        cursor: pointer;
    }

    .logout{
        color: red;
    }
</style>