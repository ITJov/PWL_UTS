<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


<nav class="nav">
    <i class="uil uil-bars navOpenBtn"></i>
    <a href="#" class="logo">Morning</a>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Welcome Back, {{ auth()->user()->name }}
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="logout">Logout</a></li>
            <li><hr class="dropdown-divider"></li>
        </ul>
    </li>


</nav>
