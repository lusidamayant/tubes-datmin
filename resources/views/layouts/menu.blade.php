<li class="side-menus {{ Request::is('') ? 'active' : '' }}">
    <a class="nav-link" href="#">
        <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
    </a>
</li>
<li class="side-menus {{ Request::is('student*') ? 'active' : '' }}">
    <a class="nav-link" href="/student">
        <i class="fas fa-user-alt"></i><span>Siswa</span>
    </a>
</li>
<li class="side-menus {{ Request::is('kmeans*') ? 'active' : '' }}">
    <a class="nav-link" href="/kmeans">
        <i class="fas fa-user-alt"></i><span>Clustering Data Siswa</span>
    </a>
</li>
<!-- <li class="dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-lock"></i><span>Siswa</span></a>
    <ul class="dropdown-menu" style="display: none;">
    <li><a class="nav-link" href="index-0.html">Role</a></li>
    <li class="active"><a class="nav-link" href="index.html">Permissions</a></li>
    </ul>
</li> -->