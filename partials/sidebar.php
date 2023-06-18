<header class="header" id="header">

    <div class="header__img">
        <img src="assets/img/logo.svg" alt="logo">
    </div>

    <form action="search" method="get" class="searchFrom">
        <input type="text" name="q" placeholder="Search here" class="form-control searchInput" required>
        <button class="btn searchBtn" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>

    <div class="header__img emb">
        <img src="assets/img/emb.png" alt="">
    </div>

</header>


<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <div class="nav__logo">

                <div class="header__toggle">
                    <i class='bx bx-menu' id="header-toggle"></i>
                </div>

                <div class="panelName">
                    <span>Multi State</span>
                    <span>Cooperative</span>
                    <span> Societies</span>
                </div>
            </div>

            <div class="nav__list">
                <a href="index" class="nav__link HomePage">
                    <i class='bx bx-grid-alt nav__icon'></i>
                    <span class="nav__name">Dashboard</span>
                </a>

                <a href="data" class="nav__link dataPage">
                    <i class='bx bx-folder nav__icon'></i>
                    <span class="nav__name">Data</span>
                </a>

                <a href="analytics" class="nav__link analyticsPage">
                    <i class='bx bx-bar-chart-alt-2 nav__icon'></i>
                    <span class="nav__name">Analytics</span>
                </a>
            </div>
        </div>

        <a href="logout" class="nav__link">
            <i class='bx bx-log-out nav__icon'></i>
            <span class="nav__name">Log Out</span>
        </a>
    </nav>
</div>

<!-- responsive nav  -->

<div class="nav-sm">
    <div class=" m-0 p-0 d-flex align-items-center justify-content-between">

        <a href="index" class="nav__link HomePage">
            <i class='bx bx-grid-alt nav__icon'></i>
        </a>

        <a href="data" class="nav__link dataPage">
            <i class='bx bx-folder nav__icon'></i>
        </a>

        <a href="analytics" class="nav__link analyticsPage">
            <i class='bx bx-bar-chart-alt-2 nav__icon'></i>
        </a>
        <a href="logout" class="nav__link">
            <i class='bx bx-log-out nav__icon'></i>
        </a>

    </div>
</div>