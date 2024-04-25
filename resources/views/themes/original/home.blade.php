@extends($theme.'layouts.app')
@section('title',trans('Home'))

@section('content')
    @include($theme.'partials.heroBanner')
{{--    @include($theme.'sections.about-us')--}}
    @include($theme.'sections.feature')

    @include($theme.'sections.property')
    @include($theme.'sections.statistics')

{{--    @include($theme.'sections.testimonial')--}}
    @include($theme.'sections.latest-property')
    @include($theme.'sections.blog')
@endsection
