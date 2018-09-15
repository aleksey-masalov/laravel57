@if (config('locale.status') && count(config('locale.languages')) > 1)
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="locale-dropdown-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
            <i class="fa fa-language"></i> {{ trans('navigation.locale.title') }} <span class="caret"></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="locale-dropdown-menu">
            @foreach (array_keys(config('locale.languages')) as $language)
                <a href="{{ route('locale.swap', $language) }}" class="dropdown-item {{ $language === app()->getLocale() ? 'active' : '' }}">
                    {{ trans('navigation.locale.languages.' . $language) }}
                </a>
            @endforeach
        </div>
    </li>
@endif
