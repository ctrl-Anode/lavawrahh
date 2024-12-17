<style>.sidebar {
    background-color: #1a5f7a;
    color: #ffffff;
    width: 250px;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    overflow-y: auto;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.sidebar .navbar-brand {
    padding: 20px 15px;
    font-size: 1.5em;
    color: #ffffff;
    text-decoration: none;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.sidebar a {
    padding: 15px;
    color: #ffffff;
    text-decoration: none;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
}

.sidebar a:hover, .sidebar a.active {
    background-color: #2980b9;
}

.sidebar .icon {
    margin-right: 10px;
    width: 20px;
    text-align: center;
}

.sidebar a:hover .icon, .sidebar a.active .icon {
    color: #f1c40f;
}

.sidebar .nav-link {
    font-weight: bold;
    background-color: #154f66;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.sidebar a:last-child {
    margin-top: auto;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

/* Scrollbar Styles */
.sidebar::-webkit-scrollbar {
    width: 5px;
}

.sidebar::-webkit-scrollbar-track {
    background: #154f66;
}

.sidebar::-webkit-scrollbar-thumb {
    background: #2980b9;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background: #3498db;
}

/* Responsive Design */
@media (max-width: 768px) {
    .sidebar {
        width: 60px;
    }

    .sidebar .navbar-brand, .sidebar a span:not(.icon) {
        display: none;
    }

    .sidebar a {
        padding: 15px 0;
        justify-content: center;
    }

    .sidebar .icon {
        margin-right: 0;
    }
}</style>