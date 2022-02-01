@extends('admin.layout')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tickets</h1>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Cliente</th>
            <th scope="col">Titulo</th>
            <th scope="col">Prioridade</th>
            <th scope="col">Status</th>
            <th scope="col">Departamento</th>
            <th scope="col">Ação</th>

        </tr>
        </thead>
        <tbody>
        @foreach($tickets as $ticket)
        <tr>
            <th scope="row">{{ $ticket->id }}</th>
            <td>{{ $ticket->customer_id }}</td>
            <td>{{ $ticket->title }}</td>
            <td>{{ $ticket->priority }}</td>
            <td>{{ $ticket->status }}</td>
            <td>{{ $ticket->departament_id }}</td>
            <td><a class="btn btn-primary" href="{{ url("admin/ticket/{$ticket->id}/accept") }}">Resolver</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
</main>

@endsection
