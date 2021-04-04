@extends('layouts.app')

@section('title', 'Анализатор страниц')

@section('content')
<div class="container-lg px-5">
    <h1 class="mt-5 mb-3 px-5">{{ $url->name }}</h1>
    <div class="table-responsive px-5">
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