</main>
        </div>
    </div>

    <nav class="bottom-nav">
        <ul class="bottom-nav-menu">
            <li class="<?php echo ($active_page == 'dashboard') ? 'active' : ''; ?>">
                <a href="index.php" title="Dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="<?php echo ($active_page == 'students') ? 'active' : ''; ?>">
                <a href="students.php" title="Data Murid">
                    <i class="fas fa-user-graduate"></i>
                    <span>Murid</span>
                </a>
            </li>
            <li class="<?php echo ($active_page == 'admins') ? 'active' : ''; ?>">
                <a href="admins.php" title="Data Admin">
                    <i class="fas fa-user-shield"></i>
                    <span>Admin</span>
                </a>
            </li>
            <li>
                <a href="logout.php" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>

</body>
</html>
