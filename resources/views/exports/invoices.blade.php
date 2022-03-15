<table>
    <tr>
    <th>Nome</th>
    <th>Matrícula</th>
    <th>E-mail</th>
    <th>Direcionamento</th>
    <th>Protocolo</th>
    <th>Agendamento</th>
  </tr>

  @foreach ($relatorio as $item)
    <tr>
      <td>{{$item->nome}}</td>
      <td>{{$item->matricula}}</td>
      <td>{{$item->email}}</td>
      <td>{{$item->direcionamento}}</td>
      <td>{{$item->protocolo}}</td>
      <td>{{substr(date('d/m/Y H:i', strtotime($item->data_agenda)), 0, 10).' às '.$item->hora_agenda.' horas'}}</td>
    </tr>
  @endforeach
</table>