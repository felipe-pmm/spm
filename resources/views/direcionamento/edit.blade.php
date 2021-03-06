@extends('gentelella.layouts.app')

@section('content')
<div class="x_panel modal-content">
  <div class="x_title">
    <h5 class="text-center fw-light p-1 m-0"><i class="fas fa-cogs"></i> {{ $direcionamento->nome }}</h5>
  </div>
  <div class="x_panel">
    <div class="x_content">
      <form method="post" action="{{ route('direcionamentos.update', $direcionamento->id ) }}">
        @csrf
        @method('PATCH')
        <table class="table">
          <thead>
            <th class="">Dia</th>
            <th class="text-center">Habilitar dia?</th>
            <th class="text-center">Horário Mínimo</th>
            <th class="text-center">Horário Máximo</th>
          </thead>
          <tbody>
            <tr>
              <td class="" style="width: 25%;">Domingo</td>
              <td class="text-center">
                <input type="hidden" value="0" name="dom[isOn]">
                <input id="dom-check" onchange="checkFn()" type="checkbox" @if($config[0]->isOn) checked @endif value="1" name="dom[isOn]">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[0]->inicio }}" name="dom[inicio]" class="dom-picker timepickers" type="text" placeholder="hh:mm">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[0]->fim }}" name="dom[fim]" class="dom-picker timepickers" type="text" placeholder="hh:mm">
              </td>
            </tr>
            <tr>
              <td class="" style="width: 25%;">Segunda-Feira</td>
              <td class="text-center">
                <input type="hidden" value="0" name="seg[isOn]">
                <input id="seg-check" onchange="checkFn()" type="checkbox" @if($config[1]->isOn) checked @endif value="1" name="seg[isOn]">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[1]->inicio }}" name="seg[inicio]" class="seg-picker timepickers" type="text" placeholder="hh:mm">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[1]->fim }}" name="seg[fim]" class="seg-picker timepickers" type="text" placeholder="hh:mm">
              </td>
            </tr>
            <tr>
              <td class="" style="width: 25%;">Terça-Feira</td>
              <td class="text-center">
                <input type="hidden" value="0" name="ter[isOn]">
                <input id="ter-check" onchange="checkFn()" type="checkbox" @if($config[2]->isOn) checked @endif value="1" name="ter[isOn]">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[2]->inicio }}" name="ter[inicio]" class="ter-picker timepickers" type="text" placeholder="hh:mm">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[2]->fim }}" name="ter[fim]" class="ter-picker timepickers" type="text" placeholder="hh:mm">
              </td>
            </tr>
            <tr>
              <td class="" style="width: 25%;">Quarta-Feira</td>
              <td class="text-center">
                <input type="hidden" value="0" name="qua[isOn]">
                <input id="qua-check" onchange="checkFn()" type="checkbox" @if($config[3]->isOn) checked @endif value="1" name="qua[isOn]">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[3]->inicio }}" name="qua[inicio]" class="qua-picker timepickers" type="text" placeholder="hh:mm">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[3]->fim }}" name="qua[fim]" class="qua-picker timepickers" type="text" placeholder="hh:mm">
              </td>
            </tr>
            <tr>
              <td class="" style="width: 25%;">Quinta-Feira</td>
              <td class="text-center">
                <input type="hidden" value="0" name="qui[isOn]">
                <input id="qui-check" onchange="checkFn()" type="checkbox" @if($config[4]->isOn) checked @endif value="1" name="qui[isOn]">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[4]->inicio }}" name="qui[inicio]" class="qui-picker timepickers" type="text" placeholder="hh:mm">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[4]->fim }}" name="qui[fim]" class="qui-picker timepickers" type="text" placeholder="hh:mm">
              </td>
            </tr>
            <tr>
              <td class="" style="width: 25%;">Sexta-Feira</td>
              <td class="text-center">
                <input type="hidden" value="0" name="sex[isOn]">
                <input id="sex-check" onchange="checkFn()" type="checkbox" @if($config[5]->isOn) checked @endif value="1" name="sex[isOn]">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[5]->inicio }}" name="sex[inicio]" class="sex-picker timepickers" type="text" placeholder="hh:mm">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[5]->fim }}" name="sex[fim]" class="sex-picker timepickers" type="text" placeholder="hh:mm">
              </td>
            </tr>
            <tr>
              <td class="" style="width: 25%;">Sábado</td>
              <td class="text-center">
                <input type="hidden" value="0" name="sab[isOn]">
                <input id="sab-check" onchange="checkFn()" type="checkbox" @if($config[6]->isOn) checked @endif value="1" name="sab[isOn]">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[6]->inicio }}" name="sab[inicio]" class="sab-picker timepickers" type="text" placeholder="hh:mm">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[6]->fim }}" name="sab[fim]" class="sab-picker timepickers" type="text" placeholder="hh:mm">
              </td>
            </tr>
          </tbody>
          <tfoot>
            <th>
              <a href="{{ route('direcionamentos.index') }}" id="cancelar" title="Cancelar operação." class="btn btn-primary">Cancelar</a>
              <a id="enviar" title="Salvar configurações." class="btn btn-success">Salvar Configuração</a>
            </th>
          </tfoot>
        </table>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modaleventclick" tabindex="-1" role="dialog" aria-labelledby="modaleventclickLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modaleventclickLabel">Aplicando as configurações, por favor aguarde.</h5>
        </div>
        <div class="modal-body">
            <center>
                <div class="loader"></div>
            </center>
        </div>
      </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script defer>
  const checkFn = () => {
    const domCheck = document.getElementById('dom-check');
    const domPickers = document.getElementsByClassName('dom-picker');

    const segCheck = document.getElementById('seg-check');
    const segPickers = document.getElementsByClassName('seg-picker');

    const terCheck = document.getElementById('ter-check');
    const terPickers = document.getElementsByClassName('ter-picker');

    const quaCheck = document.getElementById('qua-check');
    const quaPickers = document.getElementsByClassName('qua-picker');

    const quiCheck = document.getElementById('qui-check');
    const quiPickers = document.getElementsByClassName('qui-picker');

    const sexCheck = document.getElementById('sex-check');
    const sexPickers = document.getElementsByClassName('sex-picker');

    const sabCheck = document.getElementById('sab-check');
    const sabPickers = document.getElementsByClassName('sab-picker');

    if (domCheck.checked) {
      for (let p of domPickers) {
        p.setAttribute('required', 'required');
      }
    } else {
      for (let p of domPickers) {
        p.removeAttribute('required');
      }
    };

    if (segCheck.checked) {
      for (let p of segPickers) {
        p.setAttribute('required', 'required');
      }
    } else {
      for (let p of segPickers) {
        p.removeAttribute('required');
      }
    };

    if (terCheck.checked) {
      for (let p of terPickers) {
        p.setAttribute('required', 'required');
      }
    } else {
      for (let p of terPickers) {
        p.removeAttribute('required');
      }
    };

    if (quaCheck.checked) {
      for (let p of quaPickers) {
        p.setAttribute('required', 'required');
      }
    } else {
      for (let p of quaPickers) {
        p.removeAttribute('required');
      }
    };

    if (quiCheck.checked) {
      for (let p of quiPickers) {
        p.setAttribute('required', 'required');
      }
    } else {
      for (let p of quiPickers) {
        p.removeAttribute('required');
      }
    };

    if (sexCheck.checked) {
      for (let p of sexPickers) {
        p.setAttribute('resexred', 'resexred');
      }
    } else {
      for (let p of sexPickers) {
        p.removeAttribute('resexred');
      }
    };

    if (sabCheck.checked) {
      for (let p of sabPickers) {
        p.setAttribute('resabred', 'resabred');
      }
    } else {
      for (let p of sabPickers) {
        p.removeAttribute('resabred');
      }
    };
  }

  checkFn();
</script>
<script>
  const config = @json($config);
  
  /* timePicker */
  $('.timepickers').timepicker({
    timeFormat: 'HH:mm',
    interval: 60,
    minTime: "00:00",
    maxTime: "23:00",
    defaultTime: "",
    startTime: "",
    dynamic: false,
    dropdown: true,
    scrollbar: true
  });
</script>
<script>
  const submitBtn = document.querySelector('#enviar');
  const form = document.querySelector('form');

  submitBtn.addEventListener('click', (e) => {
    swal({
      title: "Atenção!",
      text: `Você está prestes a aplicar a configuração.`,
      icon: "warning",
      buttons: {
        cancel: {
          text: "Cancelar",
          value: "cancelar",
          visible: true,
          closeModal: true
        },
        ok: {
          text: "Confirmar",
          value: 'ok',
          visible: true,
          closeModal: true
        }
      }
    }).then(function(resultado){
    if(resultado === 'ok') {
        if(form.checkValidity()) {
          form.submit();
          $("#modaleventclick").modal("show");
        } else {
          form.reportValidity();
        }
      }
    });
  });
</script>
@endpush