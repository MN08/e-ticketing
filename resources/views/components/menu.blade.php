<nav class="nav flex-column">
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
    @foreach ($listMenu as $menu)
        <a href="{{ route($menu['route']) }}"
            class="nav-link {{ $isActive($menu['label']) ? 'active' : '' }}">
            <i class="{{ $menu['icon'] }}"></i> {{ $menu['label'] }}
        </a>
    @endforeach
</nav>
