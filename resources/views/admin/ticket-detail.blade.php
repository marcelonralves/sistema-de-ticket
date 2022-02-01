@extends('admin.layout')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tickets</h1>
    </div>
    <form method="post" action="{{ url("/admin/ticket/{$ticketMessages[0]->ticket_id}/see") }}">
        @csrf
        <label for="content">Mensagem
            <textarea class="form-control" id="content" name="content"></textarea>
        </label>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Histórico</h1>
    </div>

    @foreach($ticketMessages as $message)

        <h4>{{ $message->user_id }}</h4>
        <p>{{ $message->content }}</p>
        <p>{{ $message->created_at }}</p>
    @endforeach

    <hr>

</main>

@endsection
