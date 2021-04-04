@extends('layouts.app')

@section('page_sites', 'active')

@section('content')
<div class="container-lg">
    <h1 class="mt-5 mb-3">Сайты</h1>
    <div class="table-responsive">
        <table class="table table-bordered text-nowrap">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Имя</th>
                <th scope="col">Последняя проверка</th>
                <th scope="col">Код ответа</th>
                </tr>
            </thead>
            <tbody>
                @foreach($urls as $url)
                    <tr>
                        <th scope="row">{{ $url->id }}</th>
                        <td><a href="{{ route('urls.show', $url->id) }}">{{ $url->name }}</a></td>
                        <td>{{ $url->updated_at }}</td>
                        <td>###</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $urls->links() }}
        </div>
    </div>
</div>
@endsection