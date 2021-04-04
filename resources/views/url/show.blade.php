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
</div>
@endsection