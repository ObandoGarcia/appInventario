<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="bi bi-list"></i>
        </button>
        <div class="sidebar-logo">
            <a href="{{ route('dashboard') }}">Jireh Libreria</a>
        </div>
    </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="{{ route('authors') }}" class="sidebar-link">
                    <i class="bi bi-person-lines-fill"></i>
                    <span>Autores</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('categories') }}" class="sidebar-link">
                    <i class="bi bi-bookmarks"></i>
                    <span>Categorias</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('editorials') }}" class="sidebar-link">
                    <i class="bi bi-journal-text"></i>
                    <span>Editoriales</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('books') }}" class="sidebar-link">
                    <i class="bi bi-book"></i>
                    <span>Libros</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a href="{{ route('close_session') }}" class="sidebar-link">
                <i class="bi bi-box-arrow-in-left"></i>
                <span>Cerrar sesion</span>
            </a>
        </div>
    </aside>
