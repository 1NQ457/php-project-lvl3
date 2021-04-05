@extends('layouts.app')

@section('content')
<div class="container-lg">
    <h1 class="mt-5 mb-3">{{ $url->name }}</h1>
    <div class="table-responsive">
        <table class="table table-bordered text-nowrap">
        <tbody>
                <tr>
                    <td class="font-weight-bold w-25">id</td>
                    <td>{{ $url->id }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Имя</td>
                    <td>{{ $url->name }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Дата создания</td>
                    <td>{{ $url->created_at }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Дата обновления</td>
                    <td>{{ $url->updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <h2 class="mt-5 mb-3">Проверки</h2>
    {{ Form::open([
        'route' => ['urls.checks.store', $url->id],
        'class' => 'mb-2'])
    }}
        {{ Form::submit('Запустить проверку', $attributes = ['class' => 'btn btn-info']) }}
    {{ Form::close() }}
    <div class="table-responsive">
        <table class="table table-bordered text-nowrap">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Последняя проверка</th>
                </tr>
            </thead>
            <tbody>
                @foreach($urlChecks as $check)
                    <tr>
                        <th scope="row">{{ $check->id }}</th>
                        <td>{{ $check->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection