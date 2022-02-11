@extends('layouts.layout')

@section('title', 'Главная Новостройки')
{{--@section('sidebar')--}}
{{--@parent--}}
{{--<p>Это дополнение к основной боковой панели.</p>--}}
{{--@endsection--}}


@section('content')
    @includeIf('widgets.finder', ['some' => 'data'])
    <section class="popular-complex">
        <div class="popular-block">
            <div class="popular-title">
                Сданные новостройки в Одессе
            </div>
            <div class="jk-box">
                {{--@each('chunk.jk', $objects, 'req')--}}
                @foreach($objectsFind as $rec)
                    @include('chunk.jk', ['rec' => $rec])
                @endforeach

                <div class="clear"></div>
            </div>
        </div>
        <div class="pagination-block">
            {{ $objectsFind->links('chunk.pagination') }}
        </div>
    </section>



@endsection