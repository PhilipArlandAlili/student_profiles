<ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
        <a class="nav-link" href="../index.php">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed"  data-bs-toggle="collapse" href="#">
            <i class="bi bi-person"></i><span>Students</span></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="/views/students_view.php">
                    <i class="bi bi-circle"></i><span>View Students</span>
                </a>
            </li>
            <li>
                <a href="/views/students_add.php">
                    <i class="bi bi-circle"></i><span>Add Students</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-truck"></i><span>Province</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="/views/province_view.php">
                    <i class="bi bi-circle"></i><span>View Province</span>
                </a>
            </li>
            <li>
                <a href="/views/province_add.php">
                    <i class="bi bi-circle"></i><span>Add Province</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#town-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-sunrise-fill"></i><span>Town City</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="town-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="/views/town_city_view.php">
                    <i class="bi bi-circle"></i><span>View Town City</span>
                </a>
            </li>
            <li>
                <a href="/views/town_city_add.php">
                    <i class="bi bi-circle"></i><span>Add Town City</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-at"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="/views/charts_1.php">
                    <i class="bi bi-circle"></i><span>Report 1</span>
                </a>
            </li>
            <li>
                <a href="/views/charts_2.php">
                    <i class="bi bi-circle"></i><span>Report 2</span>
                </a>
            </li>
            <li>
                <a href="/views/charts_3.php">
                    <i class="bi bi-circle"></i><span>Report 3</span>
                </a>
            </li>
        </ul>
    </li>
</ul>