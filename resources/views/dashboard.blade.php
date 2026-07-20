<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop Admin Dashboard</title>
    <!-- Google Fonts & FontAwesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg-body: #f8fafc;
            --bg-sidebar: #1e293b;
            --sidebar-hover: #334155;
            --accent-color: #8b5a2b; /* Màu nâu cafe */
            --accent-hover: #6f4e37;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --white: #ffffff;
            --border-color: #e2e8f0;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* --- LAYOUT SIDEBAR --- */
        .sidebar {
            width: 260px;
            background-color: var(--bg-sidebar);
            color: var(--white);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s;
            flex-shrink: 0;
        }

        .sidebar-brand {
            padding: 24px;
            font-size: 20px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid var(--sidebar-hover);
            color: #f59e0b;
        }

        .sidebar-menu {
            list-style: none;
            padding: 20px 12px;
            flex-grow: 1;
        }

        .sidebar-item {
            margin-bottom: 8px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
            cursor: pointer;
        }

        .sidebar-link:hover, .sidebar-link.active {
            background-color: var(--sidebar-hover);
            color: var(--white);
        }

        .sidebar-link.active {
            border-left: 4px solid var(--accent-color);
            background-color: rgba(139, 90, 43, 0.15);
            color: #ffedd5;
        }

        /* --- MAIN CONTENT & HEADER --- */
        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden; /* Giữ khung cố định */
        }

        .topbar {
            background-color: var(--white);
            height: 75px; /* Tăng nhẹ chiều cao header */
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px; /* Thêm khoảng cách hai bên */
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            flex-shrink: 0;
        }

        .page-title h2 {
            font-size: 24px; /* Tăng size chữ tiêu đề chính */
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background-color: var(--accent-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .content-body {
            padding: 30px;
            overflow-y: auto; /* Cho phép cuộn trang chính */
            flex-grow: 1;
        }

        /* --- TOOLBAR / FILTERS --- */
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .filter-group {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding: 10px 16px 10px 40px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            width: 280px;
            outline: none;
            font-size: 14px;
            transition: all 0.2s;
        }

        .search-box input:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(139, 90, 43, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .select-filter {
            padding: 10px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            outline: none;
            background-color: var(--white);
            font-size: 14px;
            cursor: pointer;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: var(--accent-color);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--accent-hover);
        }

        /* --- BẢNG SẢN PHẨM --- */
        .card-table {
            background-color: var(--white);
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background-color: #f8fafc;
            padding: 16px 20px;
            font-weight: 600;
            font-size: 13px;
            color: var(--text-muted);
            text-transform: uppercase;
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .prod-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .prod-img {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            object-fit: cover;
            background-color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .prod-name {
            font-weight: 600;
            color: var(--text-main);
        }

        .prod-desc {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-danger { background-color: #fee2e2; color: var(--danger); }
        .badge-warning { background-color: #fef3c7; color: var(--warning); }
        .badge-success { background-color: #d1fae5; color: var(--success); }

        /* Nút gạt Toggle Switch */
        .switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }

        .switch input { opacity: 0; width: 0; height: 0; }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: #cbd5e1;
            transition: .3s;
            border-radius: 24px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px; width: 18px;
            left: 3px; bottom: 3px;
            background-color: white;
            transition: .3s;
            border-radius: 50%;
        }

        input:checked + .slider { background-color: var(--success); }
        input:checked + .slider:before { transform: translateX(20px); }

        .actions-btn {
            display: flex;
            gap: 8px;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-color);
            background: var(--white);
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-icon.edit:hover { border-color: var(--accent-color); color: var(--accent-color); }
        .btn-icon.delete:hover { border-color: var(--danger); color: var(--danger); }

        /* --- LƯỚI DANH MỤC --- */
        .grid-categories {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .card-category {
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }

        .cate-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 12px;
        }

        .cate-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background-color: #fdf6b2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .cate-title { font-weight: 700; font-size: 18px; }
        .cate-desc { color: var(--text-muted); font-size: 13px; min-height: 38px;}

        .cate-footer {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid var(--border-color);
            padding-top: 14px;
        }

        /* ==================== SỬA LỖI TRÀN KHUNG POPUP MODAL TẠI ĐÂY ==================== */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0, 0, 0, 0.45);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px; /* Tạo vùng đệm an toàn xung quanh viền màn hình */
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-container {
            background: var(--white);
            border-radius: 14px;
            width: 520px;
            max-width: 100%;
            max-height: 85vh; /* Giới hạn: Chỉ chiếm tối đa 85% chiều cao màn hình */
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.15);
            transform: translateY(-20px);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column; /* Chia nhỏ kết cấu theo trục dọc */
            overflow: hidden;
        }

        .modal-overlay.active .modal-container {
            transform: translateY(0);
        }

        .modal-header {
            padding: 22px 26px; /* Tăng padding tạo độ thoáng rộng */
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0; /* Cố định vị trí Header ở đỉnh, không bị bóp méo */
        }

        .modal-header h3 {
            font-size: 18px;
            font-weight: 700;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-muted);
            line-height: 1;
        }

        .modal-body {
            padding: 26px;
            overflow-y: auto; /* KÍCH HOẠT THANH CUỘN NỘI BỘ KHI CÁC Ô FORM QUÁ DÀI */
            flex-grow: 1;
        }

        .form-group {
            margin-bottom: 20px; /* Thêm margin cho các group nhập liệu thông thoáng */
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px; /* Tăng khoảng cách từ nhãn đến ô input */
            color: #334155;
        }

        .form-control {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            outline: none;
            font-size: 14px;
            background-color: #f8fafc;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            background-color: var(--white);
        }

        .modal-footer {
            padding: 18px 26px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            flex-shrink: 0; /* Cố định vị trí hai nút bấm luôn nằm đáy popup */
            background-color: #f8fafc;
        }

        .btn-secondary {
            background-color: #e2e8f0;
            color: var(--text-main);
        }

        .btn-secondary:hover { background-color: #cbd5e1; }

        .hidden { display: none !important; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div>
            <div class="sidebar-brand">
                <i class="fa-solid fa-coffee"></i> COFFEE ADMIN
            </div>
            <ul class="sidebar-menu">
                <li class="sidebar-item">
                    <a class="sidebar-link active" id="menu-products" onclick="switchTab('products')">
                        <i class="fa-solid fa-mug-hot"></i> Quản lý Món ăn (`products`)
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" id="menu-categories" onclick="switchTab('categories')">
                        <i class="fa-solid fa-tags"></i> Danh mục (`categories`)
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- MAIN HỆ THỐNG QUẢN LÝ -->
    <div class="main-content">
        <!-- TOPBAR -->
        <div class="topbar">
            <div class="page-title">
                <h2 id="page-header-title">Quản lý Thực đơn</h2>
            </div>
            <div class="user-profile">
                <div class="user-avatar">AD</div>
                <span style="font-weight: 500;">Admin Quán</span>
            </div>
        </div>

        <!-- VÙNG HIỂN THỊ NỘI DUNG -->
        <div class="content-body">
            
            <!-- TAB QUẢN LÝ SẢN PHẨM -->
            <div id="tab-products">
                <div class="toolbar">
                    <div class="filter-group">
                        <div class="search-box">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" id="search-product" placeholder="Tìm tên món ăn, đồ uống..." oninput="filterProducts()">
                        </div>
                        <select class="select-filter" id="filter-category" onchange="filterProducts()">
                            <option value="">Tất cả danh mục</option>
                        </select>
                        <select class="select-filter" id="filter-status" onchange="filterProducts()">
                            <option value="">Tất cả trạng thái</option>
                            <option value="available">Còn hàng mở bán</option>
                            <option value="unavailable">Tạm dừng bán</option>
                        </select>
                    </div>
                    <button class="btn btn-primary" onclick="openProductModal()">
                        <i class="fa-solid fa-plus"></i> Thêm món mới
                    </button>
                </div>

                <div class="card-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Món ăn / Đồ uống</th>
                                <th>Danh mục</th>
                                <th>Giá bán</th>
                                <th>Kho nguyên liệu</th>
                                <th>Mở bán</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody id="product-table-body"></tbody>
                    </table>
                </div>
            </div>

            <!-- TAB QUẢN LÝ DANH MỤC -->
            <div id="tab-categories" class="hidden">
                <div class="toolbar" style="justify-content: flex-end;">
                    <button class="btn btn-primary" onclick="openCategoryModal()">
                        <i class="fa-solid fa-plus"></i> Thêm danh mục mới
                    </button>
                </div>
                <div class="grid-categories" id="category-grid-body"></div>
            </div>

        </div>
    </div>

    <!-- POPUP THÊM/SỬA SẢN PHẨM (ĐÃ FIX LỖI) -->
    <div class="modal-overlay" id="product-modal">
        <div class="modal-container">
            <div class="modal-header">
                <h3 id="product-modal-title">Thêm sản phẩm mới</h3>
                <button class="modal-close" onclick="closeProductModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Tên món ăn / Đồ uống (*)</label>
                    <input type="text" id="p-name" class="form-control" placeholder="Ví dụ: Bạc xỉu đá">
                </div>
                <div class="form-group">
                    <label>Danh mục (*)</label>
                    <select id="p-category" class="form-control"></select>
                </div>
                <div class="form-group">
                    <label>Giá bán (VNĐ) (*)</label>
                    <input type="number" id="p-price" class="form-control" placeholder="Ví dụ: 29000">
                </div>
                <div class="form-group">
                    <label>Số lượng tồn kho (*)</label>
                    <input type="number" id="p-stock" class="form-control" placeholder="Số ly có thể phục vụ hiện tại">
                </div>
                <div class="form-group">
                    <label>Icon / Emoji minh họa</label>
                    <input type="text" id="p-image" class="form-control" placeholder="Ví dụ: ☕, 🍹, 🍰">
                </div>
                <div class="form-group">
                    <label>Mô tả ngắn món ăn</label>
                    <textarea id="p-desc" class="form-control" rows="3" placeholder="Mô tả thành phần..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeProductModal()">Hủy</button>
                <button class="btn btn-primary" onclick="saveProduct()">Lưu thông tin</button>
            </div>
        </div>
    </div>

    <!-- POPUP THÊM DANH MỤC -->
    <div class="modal-overlay" id="category-modal">
        <div class="modal-container">
            <div class="modal-header">
                <h3>Thêm danh mục thực đơn</h3>
                <button class="modal-close" onclick="closeCategoryModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Tên danh mục (*)</label>
                    <input type="text" id="c-name" class="form-control" placeholder="Ví dụ: Cà Phê Máy, Trà Trái Cây">
                </div>
                <div class="form-group">
                    <label>Icon / Emoji đại diện</label>
                    <input type="text" id="c-image" class="form-control" placeholder="Ví dụ: ☕">
                </div>
                <div class="form-group">
                    <label>Mô tả danh mục</label>
                    <textarea id="c-desc" class="form-control" rows="3" placeholder="Mô tả nhóm sản phẩm này..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeCategoryModal()">Hủy</button>
                <button class="btn btn-primary" onclick="saveCategory()">Thêm mới</button>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script>
        let categories = [
            { id: 1, name: "Cà phê truyền thống", description: "Cà phê phin Việt Nam đậm đà, tỉnh táo nguyên ngày.", image: "☕" },
            { id: 2, name: "Trà trái cây nhiệt đới", description: "Các loại trà thanh mát, giải nhiệt mùa hè.", image: "🍹" },
            { id: 3, name: "Bánh ngọt ăn kèm", description: "Bánh tươi làm trong ngày, ngọt dịu vừa vặn.", image: "🍰" }
        ];

        let products = [
            { id: 1, category_id: 1, name: "Cà phê sữa đá phin", description: "Hạt đằm, sữa đặc thơm béo chuẩn vị gu Việt", image: "☕", price: 29000, stock: 45, is_available: true },
            { id: 2, category_id: 1, name: "Bạc xỉu ba tầng", description: "Nhiều sữa ít cà phê, bọt mịn bồng bềnh", image: "🥛", price: 32000, stock: 30, is_available: true },
            { id: 3, category_id: 2, name: "Trà đào cam sả", description: "Trà đào thơm ngát kết hợp cam tươi và sả thanh", image: "🍹", price: 45000, stock: 4, is_available: true },
            { id: 4, category_id: 2, name: "Trà vải lài đút túi", description: "Trà lài thanh mát cùng quả vải ngâm ngọt lịm", image: "🧋", price: 39000, stock: 0, is_available: false },
            { id: 5, category_id: 3, name: "Bánh Croissant Bơ Tỏi", description: "Bánh sừng bò ngập bơ, nướng giòn thơm bùi", image: "🥐", price: 35000, stock: 12, is_available: true }
        ];

        let editingProductId = null;

        window.onload = function() {
            initFilters();
            renderProducts();
            renderCategories();
        };

        function switchTab(tab) {
            document.querySelectorAll('.sidebar-link').forEach(link => link.classList.remove('active'));
            document.getElementById('tab-products').classList.add('hidden');
            document.getElementById('tab-categories').classList.add('hidden');

            if (tab === 'products') {
                document.getElementById('menu-products').classList.add('active');
                document.getElementById('tab-products').classList.remove('hidden');
                document.getElementById('page-header-title').innerText = "Quản lý Món ăn (`products`)";
                renderProducts();
            } else if (tab === 'categories') {
                document.getElementById('menu-categories').classList.add('active');
                document.getElementById('tab-categories').classList.remove('hidden');
                document.getElementById('page-header-title').innerText = "Danh mục Thực đơn (`categories`)";
                renderCategories();
            }
        }

        function initFilters() {
            const filterCateSelect = document.getElementById('filter-category');
            const formCateSelect = document.getElementById('p-category');
            let options = '<option value="">Tất cả danh mục</option>';
            let formOptions = '';

            categories.forEach(cat => {
                options += `<option value="${cat.id}">${cat.name}</option>`;
                formOptions += `<option value="${cat.id}">${cat.name}</option>`;
            });

            filterCateSelect.innerHTML = options;
            formCateSelect.innerHTML = formOptions;
        }

        function renderProducts(filteredList = null) {
            const list = filteredList || products;
            const tbody = document.getElementById('product-table-body');
            tbody.innerHTML = '';

            if (list.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" style="text-align:center; color:var(--text-muted); padding:30px;">Không tìm thấy món ăn nào phù hợp.</td></tr>`;
                return;
            }

            list.forEach(prod => {
                const category = categories.find(c => c.id == prod.category_id);
                const categoryName = category ? category.name : 'Chưa phân loại';
                
                let stockBadge = `<span class="badge badge-success">${prod.stock} ly</span>`;
                if (prod.stock === 0) {
                    stockBadge = `<span class="badge badge-danger">Hết hàng</span>`;
                } else if (prod.stock < 5) {
                    stockBadge = `<span class="badge badge-warning">Sắp hết (${prod.stock})</span>`;
                }

                tbody.innerHTML += `
                    <tr>
                        <td>
                            <div class="prod-info">
                                <div class="prod-img">${prod.image || '☕'}</div>
                                <div>
                                    <div class="prod-name">${prod.name}</div>
                                    <div class="prod-desc">${prod.description || 'Không có mô tả chi tiết.'}</div>
                                </div>
                            </div>
                        </td>
                        <td><span style="font-weight:500;">${categoryName}</span></td>
                        <td><strong style="color:var(--accent-color);">${prod.price.toLocaleString()} đ</strong></td>
                        <td>${stockBadge}</td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" ${prod.is_available ? 'checked' : ''} onchange="toggleAvailability(${prod.id}, this.checked)">
                                <span class="slider"></span>
                            </label>
                        </td>
                        <td>
                            <div class="actions-btn">
                                <button class="btn-icon edit" onclick="editProduct(${prod.id})"><i class="fa-solid fa-pen"></i></button>
                                <button class="btn-icon delete" onclick="deleteProduct(${prod.id})"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }

        function renderCategories() {
            const grid = document.getElementById('category-grid-body');
            grid.innerHTML = '';

            categories.forEach(cat => {
                const productCount = products.filter(p => p.category_id == cat.id).length;
                grid.innerHTML += `
                    <div class="card-category">
                        <div>
                            <div class="cate-header">
                                <div class="cate-icon">${cat.image || '📂'}</div>
                                <div class="cate-title">${cat.name}</div>
                            </div>
                            <div class="cate-desc">${cat.description || 'Chưa cập nhật mô tả.'}</div>
                        </div>
                        <div class="cate-footer">
                            <span class="badge" style="background-color:#e0f2fe; color:#0369a1; font-weight:600;">${productCount} món</span>
                            <div class="actions-btn">
                                <button class="btn-icon delete" onclick="deleteCategory(${cat.id})"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                `;
            });
        }

        function filterProducts() {
            const searchText = document.getElementById('search-product').value.toLowerCase().trim();
            const categoryFilter = document.getElementById('filter-category').value;
            const statusFilter = document.getElementById('filter-status').value;

            const result = products.filter(prod => {
                const matchSearch = prod.name.toLowerCase().includes(searchText) || (prod.description && prod.description.toLowerCase().includes(searchText));
                const matchCategory = categoryFilter === "" || prod.category_id == categoryFilter;
                let matchStatus = true;
                if (statusFilter === "available") matchStatus = prod.is_available === true;
                if (statusFilter === "unavailable") matchStatus = prod.is_available === false;
                return matchSearch && matchCategory && matchStatus;
            });
            renderProducts(result);
        }

        function toggleAvailability(id, isChecked) {
            const prod = products.find(p => p.id === id);
            if (prod) {
                prod.is_available = isChecked;
                if(!isChecked) prod.stock = 0; 
                renderProducts();
            }
        }

        function openProductModal() {
            editingProductId = null;
            document.getElementById('product-modal-title').innerText = "Thêm sản phẩm mới";
            document.getElementById('p-name').value = '';
            document.getElementById('p-price').value = '';
            document.getElementById('p-stock').value = '';
            document.getElementById('p-image').value = '☕';
            document.getElementById('p-desc').value = '';
            document.getElementById('product-modal').classList.add('active');
        }

        function closeProductModal() { document.getElementById('product-modal').classList.remove('active'); }

        function openCategoryModal() {
            document.getElementById('c-name').value = '';
            document.getElementById('c-image').value = '📂';
            document.getElementById('c-desc').value = '';
            document.getElementById('category-modal').classList.add('active');
        }
        
        function closeCategoryModal() { document.getElementById('category-modal').classList.remove('active'); }

        function saveProduct() {
            const name = document.getElementById('p-name').value.trim();
            const category_id = parseInt(document.getElementById('p-category').value);
            const price = parseInt(document.getElementById('p-price').value);
            const stock = parseInt(document.getElementById('p-stock').value);
            const image = document.getElementById('p-image').value.trim();
            const description = document.getElementById('p-desc').value.trim();

            if (!name || isNaN(price) || isNaN(stock)) {
                alert('Vui lòng nhập đầy đủ các thông tin bắt buộc (*)!');
                return;
            }

            if (editingProductId) {
                const prod = products.find(p => p.id === editingProductId);
                if (prod) {
                    prod.name = name;
                    prod.category_id = category_id;
                    prod.price = price;
                    prod.stock = stock;
                    prod.is_available = stock > 0;
                    prod.image = image;
                    prod.description = description;
                }
            } else {
                products.push({
                    id: Date.now(),
                    category_id, name, description, image, price, stock,
                    is_available: stock > 0
                });
            }
            closeProductModal();
            renderProducts();
        }

        function editProduct(id) {
            const prod = products.find(p => p.id === id);
            if (!prod) return;
            editingProductId = id;
            document.getElementById('product-modal-title').innerText = "Chỉnh sửa món ăn";
            document.getElementById('p-name').value = prod.name;
            document.getElementById('p-category').value = prod.category_id;
            document.getElementById('p-price').value = prod.price;
            document.getElementById('p-stock').value = prod.stock;
            document.getElementById('p-image').value = prod.image;
            document.getElementById('p-desc').value = prod.description;
            document.getElementById('product-modal').classList.add('active');
        }

        function deleteProduct(id) {
            if (confirm('Bạn muốn xóa sản phẩm này khỏi thực đơn?')) {
                products = products.filter(p => p.id !== id);
                renderProducts();
            }
        }

        function saveCategory() {
            const name = document.getElementById('c-name').value.trim();
            const image = document.getElementById('c-image').value.trim();
            const description = document.getElementById('c-desc').value.trim();

            if (!name) {
                alert('Vui lòng điền tên danh mục!');
                return;
            }

            categories.push({ id: Date.now(), name, image, description });
            initFilters();
            closeCategoryModal();
            renderCategories();
        }

        function deleteCategory(id) {
            const totalLinkedProds = products.filter(p => p.category_id == id).length;
            if (totalLinkedProds > 0) {
                alert(`Không thể xóa! Danh mục hiện có ${totalLinkedProds} món ăn.`);
                return;
            }
            if (confirm('Bạn chắc chắn muốn xóa?')) {
                categories = categories.filter(c => c.id !== id);
                initFilters();
                renderCategories();
            }
        }
    </script>
</body>
</html>