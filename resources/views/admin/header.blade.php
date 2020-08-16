<div class="container portfolio_title">

    <!-- Title -->
    <div class="section-title">
        <h2>{{$title}}</h2>
    </div>
    <!--/Title -->

</div>
<!-- Container -->

<div class="portfolio">

    <div id="filters" class="sixteen columns">
        <ul style="padding:0 0 0 0">
            <li><a  href="{{route('admin.pages.index')}}">
                    <h5>Страницы</h5>
                </a>
            </li>

            <li><a  href="{{route('admin.portfolios.index')}}">
                    <h5>Порфолио</h5>
                </a>
            </li>

            <li><a href="{{route('admin.services.index')}}">
                    <h5>Сервисы</h5>
                </a>
            </li>
        </ul>
    </div>

</div>
