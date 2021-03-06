<p>Olá {{ substr($requerimento->nome, 0, strpos($requerimento->nome, ' ')) }}, o seu requerimento foi aprovado e não necessita de atendimento presencial para a comprovação da incapacidade laborativa.</p>

<h3 style="margin-bottom: 5px;">Requerimento Finalizado</h3>
<ul style="margin-top: 0;">
    <li><b>Protocolo do seu requerimento:</b> {{ $requerimento->protocolo }}</li>
    @if($requerimento->observacao)
    <li><b>Observação do avaliador:</b> {{ $requerimento->observacao }}
    @elseif($requerimento->observacao_reagenda)
    <li><b>Observação do avaliador: </b> {{ $requerimento->observacao_reagenda }}
    @endif
    <li><b>Direcionamento:</b> {{ $requerimento->direcionamento }}</li>
</ul>