@extends('layout')

@section('content')
<h1>Calendario</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Organizador</th>
      <th scope="col">Asunto</th>
      <th scope="col">Comienzo</th>
      <th scope="col">Fin</th>
    </tr>
  </thead>
  <tbody>
    @isset($events)
      @foreach($events as $event)
        <tr>
          <td>{{ $event->getOrganizer()->getEmailAddress()->getName() }}</td>
          <td>{{ $event->getSubject() }}</td>
          <td>{{ \Carbon\Carbon::parse($event->getStart()->getDateTime())->format('n/j/y g:i A') }}</td>
          <td>{{ \Carbon\Carbon::parse($event->getEnd()->getDateTime())->format('n/j/y g:i A') }}</td>
        </tr>
      @endforeach
    @endif
  </tbody>
</table>
@endsection