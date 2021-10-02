@extends('welcome')
@section('content')
<div class="container">
    @isset($success)
        <div class="alert alert-success mensaje" role "alert">
            <h2 class="done">{{$success}}</h2>
        </div>
    @endisset
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h3>Lista de Empleados</h3>
    <div style="float: right;">
        <a href="{{ route('empleado.new') }}" class="btn btn-info justify-content-end"><i class="fas fa-user-plus"></i><span style="margin-left:10px;">Nuevo Empleado</span></a>
        <div class="clearboth">&nbsp;</div>
    </div>
    <div class="modal fade" id="base" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form id="form" method="post">
                            @csrf
                            <input id="id" name="id" type="hidden">
                            <div class="row mb-3">
                                <label for="input" class="col-sm-2 col-form-label ">Nombre Completo</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label ">Correo Electronico</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label required">Sexo</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input required" type="radio" name="sexo" id="sexo" value="Masculino" checked>
                                        <label class="form-check-label" for="gridRadios1">
                                            Masculino
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo" id="sexo" value="Femenino">
                                        <label class="form-check-label" for="gridRadios2">
                                            Femenino
                                        </label>
                                    </div>
                              </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label required">Area</label>
                                <div class="col-sm-10">
                                    <select name="area_id" class="form-control form-select-lg mb-3" aria-label="Default select example">
                                        @foreach($areas as $a)
                                            <option value="{{$a->id}}">{{$a->nombre}}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-3 col-form-label required">Descripcion</label>
                                <div class="col-sm-9">
                                    <textarea name="descripcion" id="descripcion" cols="20" rows="4" placeholder="Descripcion de la experiencia del empleado" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Roles</legend>
                                <div class="col-sm-10">
                                    @foreach($roles as $r)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{$r->id}}" id="roles" name="rol[]" >
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{$r->nombre}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary update">Actualizar</button>
                          </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <table 
        id="empleado" 
        class="table"
        data-toggle="table"
        data-height="460"
        data-ajax="ajaxRequest"
        data-pagination="true"
        data-side-pagination="server"
        data-page-list="[5, 10, 20, 50, 100, 200]"
        #data-search="true"
        #data-detail-formatter="detailFormatter"
        data-detail-view="true"
        #data-click-to-select="true"
        data-id-field="id"
        #data-response-handler="responseHandler"
    >
        <thead>
          <tr>
            <th data-field="nombre" data-sortable="true" data-filter-control="select" scope="col"><i class="far fa-user"></i> Nombre</th>
            <th data-field="email" data-sortable="true" data-filter-control="select" scope="col"><i class="fas fa-at"></i> Email</th>
            <th data-field="sexo" data-sortable="true" data-filter-control="select" scope="col"><i class="fab fa-gratipay"></i> Sexo</th>
            <th data-field="area.nombre" data-sortable="true" data-filter-control="select" scope="col"><i class="fas fa-briefcase"></i> Area</th>
            <th data-formatter="verificar" data-field="boletin" data-sortable="true" data-filter-control="select" scope="col"><i class="fas fa-envelope"></i></i> Boletin</th>
            <th data-formatter="acciones" data-events="window.operateEvents" >Acciones</th>
          </tr>
        </thead>
      </table>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $table = $("#empleado");
    var $remove = $('#remove')
    var selections = []

    function ajaxRequest(params){
        var url = "{{route('empleado.ajaxEmpleado')}}"
        $.get(url + '?' + $.param(params.data)).then(function (res) {
            console.log(res);
            params.success(res)
        })
    }

    function verificar(value, row, index) {
        if(value == 1){
            return '<p>SI</p>'
        }else{
            return '<p>NO</p>'
        }
        console.log(value)
        /*return [
            '<a class="edit" href="javascript:void(0)" title="Like" data-bs-toggle="modal" data-bs-target="#base" >',
            '<i class="bi bi-pencil-square"></i>',
            '</a>'
        ].join('')*/
    }

    function acciones(value, row, index) {
        return [
            '<a class="edit" href="javascript:void(0)" title="Like" data-bs-toggle="modal" data-bs-target="#base" >',
            '<i class="fas fa-pen-square"></i>',
            '</a>'
        ].join('')
    }

    window.operateEvents = {
        'click .edit': function(e, value,row, index){
            var modal = $("#base")
            $(".modal-title").text('Actualizar Empleado')
            $("#id").val(row.id)
            $("#nombre").val(row.nombre)
            $("#email").val(row.email)
            $("#sexo").val(row.sexo)
            $("#descripcion").val(row.descripcion)
            $(".update").one('click', function(e){
                e.preventDefault()
               $.post('{{route('empleado.update')}}',$("#form").serialize(), function (res){
                    alert('datos actualizados con exito!')
                   cargarOn('update')
                   modal.modal('hide');
               })
            })
        }
    }

    var cargarOn = function(op){
        let offset = 0;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });
        $.ajax({
            type: "GET",
            data: {offset: offset , limit:10},
            url: "{{route('empleado.ajaxEmpleado')}}",
            success: function(data)
            {
                $table.bootstrapTable('load', data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                alert('Error : ' + errorThrown);
            }
        });
    }
    $(document).ready( () => {
        let done = $('.done').text()
        if (typeof done !== 'undefined') {
            $('.mensaje').hide(3000);
          }
        console.log(done)
        return;
        setTimeout(function () {
            window.location.href = "https://www.encodedna.com/javascript/operators/default.htm";
            window.clearTimeout(tID);		// clear time out.
        }, 5000);
            
       
    });
    

</script>
@endsection
