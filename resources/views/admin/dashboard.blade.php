@extends("admin.login")

@section("content")
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed">

        <a href="../../index3.html" class="brand-link">

            <span class="brand-text font-weight-light">Адмін Панель</span>
        </a>

        <div class="sidebar">


            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{asset("dashboard/category")}}" class="nav-link active">

                            <p>
                                Категорії
                            </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{asset("dashboard/products")}}" class="nav-link active">

                            <p>
                               Товари
                            </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{asset("dashboard/manufactures")}}" class="nav-link active">

                            <p>
                                Виробники
                            </p>
                        </a>
                    </li>
                    </ul>
            </nav>

        </div>

    </aside>


    <div class="content" style="margin-left: 300px">

        @yield("dash-content")

    </div>


@endsection
