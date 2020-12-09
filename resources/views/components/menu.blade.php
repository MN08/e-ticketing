<nav class="nav flex-column">
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
    @foreach ($listMenu as $menu)
        <a href="#" class="nav-link {{ $isActive($menu['label']) ? 'active' : '' }}">
            {{ $menu['label'] }}
        </a>
    @endforeach
</nav>
