<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">User</li>

            <li class="nav-item">
                <a href="{{ route("userDashboard") }}" class="nav-link active">
                    <i class="icon icon-speedometer"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route("userComments") }}" class="nav-link">
                    <i class="icon icon-book-open"></i> Comments <i class=""></i>
                </a>

            </li>


            <li class="nav-title">Author</li>

            <li class="nav-item">
                <a href="{{ route("authorDashboard") }}" class="nav-link">
                    <i class="icon icon-speedometer"></i> Dashboard <i class=""></i>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route("authorPosts") }}" class="nav-link">
                    <i class="icon icon-paper-clip"></i> Posts <i class=""></i>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route("authorComments") }}" class="nav-link">
                    <i class="icon icon-book-open"></i> Comments <i class=""></i>
                </a>
            </li>

            <li class="nav-title">Admin</li>

            <li class="nav-item">
                <a href="{{ route("adminDashboard") }}" class="nav-link">
                    <i class="icon icon-speedometer"></i> Dashboard <i class=""></i>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route("adminPosts") }}" class="nav-link">
                    <i class="icon icon-paper-clip"></i> Posts <i class=""></i>
                </a>
            </li>

            <li class="nav-item ">
                <a href="{{ route("adminComments") }}" class="nav-link ">
                    <i class="icon icon-book-open"></i> Comments <i class=""></i>
                </a>
            </li>

            <li class="nav-item ">
                <a href="{{ route("adminUsers") }}" class="nav-link">
                    <i class="icon icon-user"></i> Users <i class=""></i>
                </a>
            </li>


        </ul>
    </nav>
</div>
