@extends('gentelella.layouts.app')

@section('content')
<div class="x_panel modal-content">
  <div class="x_title">
    <h5 class="text-center fw-light p-1 m-0"><i class="fas fa-file-contract"></i> Avaliação de Requerimento</h5>
  </div>
    <div class="x_panel">
        <div class="x_content">
            <form method="post" action="{{ route('requerimento_pericias.update', $requerimento->id ) }}">
                @csrf
                @method('PATCH')
                <div class="avaliacao">
                    <div>
                        <label for="direcionamento">Direcionamento:</label>
                        <select required onchange="datasFixas()" name="direcionamento" id="direcionamento">
                            <option value="" selected>-- Direcionamento --</option>
                            <option value="Atendimento Pericial">Atendimento Pericial</option>
                            <option value="Avaliação Psiquiátrica">Avaliação Psiquiátrica</option>
                            <option value="Junta Médica">Junta Médica</option>
                            <option value="Recusado">Recusado</option>
                        </select>
                    </div>
                    <div class="datahora">
                        <label class="labelDate">Data do Agendamento:</label>
                        <input autocomplete="off" type="text" id="daterecusado" disabled placeholder="dd/mm/aaaa" style="display: inline-block;">
                        <input autocomplete="off" type="text" id="datejunta" placeholder="dd/mm/aaaa" style="display: none;">
                        <input autocomplete="off" type="text" id="datepsic" placeholder="dd/mm/aaaa" style="display: none;">
                        <input onchange="timePericia()" autocomplete="off" type="text" id="datepericia" placeholder="dd/mm/aaaa" style="display: none;">
                    </div>
                    <div class="datahora">
                        <label class="labelTime">Horário do Agendamento:</label>
                        <input autocomplete="off" id="timerecusado" type="text" disabled placeholder="hh:mm" style="display: inline-block;">
                        <input autocomplete="off" id="timejunta" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timepsic" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timepericiaqui" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timepericiater" type="text" placeholder="hh:mm" style="display: none;">
                    </div>
                    <div class="motivo" style="display: none;">
                        <label>Motivo de Recusa:</label>
                        <select name="motivo_recusa" id="motivo_recusa" onchange="outroMotivo()">
                            <option value="">-- Motivo --</option>
                            <option value="Documento Ilegível">Documento Ilegível</option>
                            <option value="Prazo Expirado">Prazo Expirado</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
                    <div id="outro-div" style="display: none;">
                        <textarea name="" id="outro-motivo" cols="30" rows="1" placeholder="Descreva o motivo." style="width: 100%;" maxlength="100"></textarea>
                    </div>
                    <button id="enviar" type="submit" class="btn btn-success">Avaliar Requerimento</button>
                </div>
            </form>
        </div>
    </div>
    <div class="x_panel">
        <div class="x_title">
            <div>Protocolo: <strong>{{$requerimento->protocolo}}</strong></div>
        </div>
        <div class="x_content">
            <div>
                <div>
                    <div>Nome Completo: <strong>{{$requerimento->nome}}</strong></div>
                    <div>Matrícula: <strong>{{$requerimento->matricula}}</strong></div>
                    <div>Data Inicial do Atestado: <strong>{{$requerimento->dt_inicio_atestado}}</strong></div>
                    <div>Local de Lotação: <strong>{{$requerimento->local_lotacao}}</strong></div>
                    <div>Horário de Trabalho: <strong>{{$requerimento->horario_trabalho}}</strong></div>
                    <div>E-mail: <strong>{{$requerimento->email}}</strong></div>
                    <br>
                    <div>O servidor acumula matrícula? <strong>{{$requerimento->vinculo}}</strong></div>
                </div>
            </div>
        </div>
    </div>
    <div class="x-panel">
        <div class="x-title">
            <h5 class="text-center fw-light p-1 m-0">Imagem/Documento do Atestado</h5>
        </div>
        <div class="x-content">
            <div style="display: flex; justify-content: space-evenly; align-items: center;">
                @foreach ($doc_atestados as $atestado)
                @if ($atestado->extensao === 'png' || $atestado->extensao === 'jpg' || $atestado->extensao === 'jpeg' || $atestado->extensao === 'bmp' || $atestado->extensao === 'gif' || $atestado->extensao === 'jfif')
                    <figure>
                        <figcaption style="text-align: center; padding-bottom: 0.7rem;"><a class="btn btn-sm btn-info" href="{{ asset('storage/atestados/'.$atestado->filename) }}" target="_blank" rel="noopener noreferrer">Visualizar Imagem</a></figcaption>
                        <img style="max-width: 25vw;" src="{{ asset('storage/atestados/'.$atestado->filename) }}" alt="Atestado">
                    </figure>
                    @else
                        <a class="btn btn-sm btn-info" href="{{ asset('storage/atestados/'.$atestado->filename) }}" target="_blank" rel="noopener noreferrer">Visualizar Documento</a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @if (!$doc_afastamentos->isEmpty())
    <hr>
    <div class="x-panel">
        <div class="x-title">
            <h5 class="text-center fw-light p-1 m-0">Comprovante de Afastamento</h5>
        </div>
        <div class="x-content">
            <div style="display: flex; justify-content: space-evenly; align-items: center;">
                @foreach ($doc_afastamentos as $afastamento)
                @if ($afastamento->extensao === 'png' || $afastamento->extensao === 'jpg' || $afastamento->extensao === 'jpeg' || $afastamento->extensao === 'bmp' || $afastamento->extensao === 'gif' || $afastamento->extensao === 'jfif')
                    <figure>
                        <figcaption style="text-align: center; padding-bottom: 0.7rem;"><a class="btn btn-sm btn-info" href="{{ asset('storage/afastamentos/'.$afastamento->filename) }}" target="_blank" rel="noopener noreferrer">Visualizar Imagem</a></figcaption>
                        <img style="max-width: 25vw;" src="{{ asset('storage/afastamentos/'.$afastamento->filename) }}" alt="Comprovante de Afastamento">
                    </figure>
                    @else
                        <a class="btn btn-sm btn-info" href="{{ asset('storage/afastamentos/'.$afastamento->filename) }}" target="_blank" rel="noopener noreferrer">Visualizar Documento</a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
<div class="modal fade" id="modaleventclick" tabindex="-1" role="dialog" aria-labelledby="modaleventclickLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modaleventclickLabel">Enviando análise, por favor aguarde.</h5>
        </div>
         
        <div class="modal-body">
            <center>
                <div class="loader"></div>
            </center>
        </div>
      </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script>
    $('#timejunta').timepicker({
        timeFormat: 'HH:mm',
        interval: 60,
        minTime: '9',
        maxTime: '09:00',
        defaultTime: '9',
        startTime: '09:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });

    $('#timepsic').timepicker({
        timeFormat: 'HH:mm',
        interval: 60,
        minTime: '10',
        maxTime: '10:00',
        defaultTime: '10',
        startTime: '10:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });

    $('#timepericiater').timepicker({
        timeFormat: 'HH:mm',
        interval: 60,
        minTime: '14',
        maxTime: '14:00',
        defaultTime: '14',
        startTime: '14:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });

    $('#timepericiaqui').timepicker({
        timeFormat: 'HH:mm',
        interval: 60,
        minTime: '13',
        maxTime: '13:00',
        defaultTime: '13',
        startTime: '13:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });

    $('#timerecusado').timepicker({
        timeFormat: 'HH:mm',
        interval: 60,
        minTime: '9',
        maxTime: '22:00',
        defaultTime: '0',
        startTime: '8:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
    
    $('#datejunta').datepicker({
        beforeShowDay: function (a){a=a.getDay();return[a==1,""]},
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Proximo',
        prevText: 'Anterior',
        minDate: '1'
    });

    $('#datepsic').datepicker({ beforeShowDay: function (a){a=a.getDay();return[a==1,""]},
        beforeShowDay: function (a){a=a.getDay();return[a==1,""]},
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Proximo',
        prevText: 'Anterior',
        minDate: '1'
    });

    $('#datepericia').datepicker({
        beforeShowDay: function(date) {
            var day = date.getDay();
            return [(day != 1 && day != 3 && day != 5 && day != 6 && day)];
        },
        dateFormat: 'dd/mm/yy D',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Proximo',
        prevText: 'Anterior',
        minDate: '1'
    });

    $('#daterecusado').datepicker('option', 'disabled', true);

    const datasFixas = () => {
        
        let direcionamento = document.querySelector('#direcionamento');
        let dateJunta = document.querySelector('#datejunta');
        let dateRecusado = document.querySelector('#daterecusado');
        let datePsic = document.querySelector('#datepsic');
        let datePericia = document.querySelector('#datepericia');

        let datahora = document.querySelectorAll('.datahora');
        let motivo = document.querySelector('.motivo')
        let motivoRecusa = document.querySelector('#motivo_recusa')
        let outroDiv = document.querySelector('#outro-div');
        let outroMotivo = document.querySelector('#outro-motivo');

        let timeJunta = document.querySelector('#timejunta');
        let timeRecusado = document.querySelector('#timerecusado');
        let timePsic = document.querySelector('#timepsic');
        let timePericiaQui = document.querySelector('#timepericiaqui');
        let timePericiaTer = document.querySelector('#timepericiater');

        if(direcionamento.value == "Junta Médica") {
            datahora[0].style.display = "inline-block";
            datahora[1].style.display = "inline-block";
            motivo.style.display = "none";
            motivoRecusa.removeAttribute('required');
            motivoRecusa.value = "";
            outroDiv.style.display = "none";
            outroMotivo.name = "";
            outroMotivo.removeAttribute('required');
        
            dateJunta.name = "data_agenda"
            dateRecusado.name = ""
            datePsic.name = ""
            datePericia.name = ""

            dateJunta.style.display = "inline-block"
            dateRecusado.style.display = "none"
            datePsic.style.display = "none"
            datePericia.style.display = "none"

            timeJunta.name = "hora_agenda"
            timeRecusado.name = ""
            timePsic.name = ""
            timePericiaQui.name = ""
            timePericiaTer.name = ""

            timeJunta.style.display = "inline-block"
            timeRecusado.style.display = "none"
            timePsic.style.display = "none"
            timePericiaTer.style.display = "none"
            timePericiaQui.style.display = "none"

            dateRecusado.value = ""
            dateJunta.value = ""
            datePsic.value = ""
            datePericia.value = ""

            timeRecusado.value = ""
            timeJunta.value = ""
            timePsic.value = ""
            timePericiaTer.value = ""
            timePericiaQui.value = ""

            dateJunta.setAttribute('required', 'required')
            dateRecusado.removeAttribute('required')
            datePsic.removeAttribute('required')
            datePericia.removeAttribute('required')

            timeJunta.setAttribute('required', 'required')
            timeRecusado.removeAttribute('required')
            timePsic.removeAttribute('required')
            timePericiaQui.removeAttribute('required')
            timePericiaTer.removeAttribute('required')

        } else if (direcionamento.value == "Avaliação Psiquiátrica") {
            datahora[0].style.display = "inline-block"
            datahora[1].style.display = "inline-block"
            motivo.style.display = "none"
            motivoRecusa.removeAttribute('required')
            motivoRecusa.value = ""
            outroDiv.style.display = "none";
            outroMotivo.name = "";
            outroMotivo.removeAttribute('required');

            datePsic.name = "data_agenda"
            dateRecusado.name = ""
            dateJunta.name = ""
            datePericia.name = ""

            datePsic.style.display = "inline-block"
            dateRecusado.style.display = "none"
            dateJunta.style.display = "none"
            datePericia.style.display = "none"

            timePsic.name = "hora_agenda"
            timeRecusado.name = ""
            timeJunta.name = ""
            timePericiaTer.name = ""
            timePericiaQui.name = ""

            timePsic.style.display = "inline-block"
            timeRecusado.style.display = "none"
            timeJunta.style.display = "none"
            timePericiaTer.style.display = "none"
            timePericiaQui.style.display = "none"

            dateRecusado.value = ""
            dateJunta.value = ""
            datePsic.value = ""
            datePericia.value = ""

            timeRecusado.value = ""
            timeJunta.value = ""
            timePsic.value = ""
            timePericiaTer.value = ""
            timePericiaQui.value = ""

            datePsic.setAttribute('required', 'required')
            dateRecusado.removeAttribute('required')
            dateJunta.removeAttribute('required')
            datePericia.removeAttribute('required')

            timePsic.setAttribute('required', 'required')
            timeRecusado.removeAttribute('required')
            timeJunta.removeAttribute('required')
            timePericiaQui.removeAttribute('required')
            timePericiaTer.removeAttribute('required')

        } else if (direcionamento.value == "Atendimento Pericial") {
            datahora[0].style.display = "inline-block"
            datahora[1].style.display = "inline-block"
            motivo.style.display = "none"
            motivoRecusa.removeAttribute('required')
            motivoRecusa.value = ""
            outroDiv.style.display = "none";
            outroMotivo.name = "";
            outroMotivo.removeAttribute('required');

            datePericia.name = "data_agenda"
            dateRecusado.name = ""
            dateJunta.name = ""
            datePsic.name = ""
            
            datePericia.style.display = "inline-block"
            dateRecusado.style.display = "none"
            dateJunta.style.display = "none"
            datePsic.style.display = "none"

            timeRecusado.name = "hora_agenda"
            timeJunta.name = ""
            timePsic.name = ""
            
            timeRecusado.style.display = "inline-block"
            timeJunta.style.display = "none"
            timePsic.style.display = "none"
            
            dateRecusado.value = ""
            dateJunta.value = ""
            datePsic.value = ""
            datePericia.value = ""

            timeRecusado.value = ""
            timeJunta.value = ""
            timePsic.value = ""
            timePericiaTer.value = ""
            timePericiaQui.value = ""

            datePericia.setAttribute('required', 'required')
            dateRecusado.removeAttribute('required')
            datePsic.removeAttribute('required')

            timeRecusado.removeAttribute('required')
            timePsic.removeAttribute('required')
            timePericiaQui.removeAttribute('required')
            timePericiaTer.removeAttribute('required')

        } else {
            datahora[0].style.display = "inline-block"
            datahora[1].style.display = "inline-block"
            motivo.style.display = "none"
            motivoRecusa.removeAttribute('required')
            motivoRecusa.value = ""
            outroDiv.style.display = "none";
            outroMotivo.name = "";
            outroMotivo.removeAttribute('required');

            dateRecusado.name = "data_agenda"
            dateJunta.name = ""
            datePsic.name = ""
            datePericia.name = ""

            dateRecusado.style.display = "inline-block"
            dateJunta.style.display = "none"
            datePsic.style.display = "none"
            datePericia.style.display = "none"

            timeRecusado.name = "hora_agenda"
            timeJunta.name = ""
            timePsic.name = ""
            timePericiaTer.name = ""
            timePericiaQui.name = ""

            timeRecusado.style.display = "inline-block"
            timeJunta.style.display = "none"
            timePsic.style.display = "none"
            timePericiaTer.style.display = "none"
            timePericiaQui.style.display = "none"

            dateRecusado.value = ""
            dateJunta.value = ""
            datePsic.value = ""
            datePericia.value = ""

            timeRecusado.value = ""
            timeJunta.value = ""
            timePsic.value = ""
            timePericiaTer.value = ""
            timePericiaQui.value = ""

            dateJunta.removeAttribute('required')
            dateRecusado.removeAttribute('required')
            datePsic.removeAttribute('required')
            datePericia.removeAttribute('required')

            timeJunta.removeAttribute('required')
            timeRecusado.removeAttribute('required')
            timePsic.removeAttribute('required')
            timePericiaQui.removeAttribute('required')
            timePericiaTer.removeAttribute('required')

            if (direcionamento.value == "Recusado") {
                datahora[0].style.display = "none"
                datahora[1].style.display = "none"
                motivo.style.display = "inline-block"
                motivoRecusa.setAttribute('required', 'required')
            }
        }
    }

    const timePericia = () => {
        let diaSemana = document.querySelector('#datepericia').value;
        let timeJunta = document.querySelector('#timejunta');
        let timeRecusado = document.querySelector('#timerecusado');
        let timePsic = document.querySelector('#timepsic');
        let timePericiaQui = document.querySelector('#timepericiaqui');
        let timePericiaTer = document.querySelector('#timepericiater');

        if (diaSemana.includes('Ter')) {
            timePericiaTer.name = "hora_agenda"
            timePericiaQui.name = ""
            timeRecusado.name = ""
            timeJunta.name = ""
            timePsic.name = ""
            
            timePericiaTer.style.display = "inline-block"
            timePericiaQui.style.display = "none"
            timeRecusado.style.display = "none"
            timeJunta.style.display = "none"
            timePsic.style.display = "none"

            timeRecusado.value = ""
            timeJunta.value = ""
            timePsic.value = ""
            timePericiaQui.value = ""

            timePericiaTer.setAttribute('required', 'required')
            timePericiaQui.removeAttribute('required')

        } else if (diaSemana.includes('Qui')) {
            timePericiaQui.name = "hora_agenda"
            timePericiaTer.name = ""
            timeRecusado.name = ""
            timeJunta.name = ""
            timePsic.name = ""
            
            timePericiaQui.style.display = "inline-block"
            timePericiaTer.style.display = "none"
            timeRecusado.style.display = "none"
            timeJunta.style.display = "none"
            timePsic.style.display = "none"
            
            timeRecusado.value = ""
            timeJunta.value = ""
            timePsic.value = ""
            timePericiaTer.value = ""

            timePericiaQui.setAttribute('required', 'required')
            timePericiaTer.removeAttribute('required')
        }
    }

    const outroMotivo = () => {
        let motivo = document.querySelector('#motivo_recusa');
        let outroDiv = document.querySelector('#outro-div');
        let outroMotivo = document.querySelector('#outro-motivo');
        if (motivo.value === "Outro") {
            outroDiv.style.display = "block";
            outroMotivo.setAttribute('required', 'required')
            outroMotivo.name = "motivo_recusa";
            motivo.name = "";
            motivo.removeAttribute('required')
        } else {
            motivo.name = "motivo_recusa";
            motivo.setAttribute('required', 'required')
            outroDiv.style.display = "none";
            outroMotivo.name = "";
            outroMotivo.removeAttribute('required')
        }
    }
</script>

<script>
    document.querySelector('.ui-timepicker').style.height = 'auto';
    document.querySelector('.ui-timepicker-viewport').style.height = 'auto';
    document.querySelector('.ui-timepicker-container').style.height = 'auto';
</script>
<script>
    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        $("#modaleventclick").modal("show");
    });
</script>
@endsection