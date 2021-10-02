@extends('welcome')
@section('content')
<div class="container">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <h3 class="mb-4">Crear Empleados</h3>
    @if(count($errors) > 0)
        <div class="alert alert-danger" role "alert">
            <h2>Por favor corrige los siguientes errores:</h2>
                <ul>
                    @foreach($errors-> all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
        </div>
    @endif
    
    <form id="form" action="{{route('empleado.create')}}" method="post">
        @csrf
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
                    <input class="form-check-input required" type="radio" name="sexo" id="sexo_m" value="Masculino" checked>
                    <label class="form-check-label" for="gridRadios1">
                        Masculino
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" id="sexo_f" value="Femenino">
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
            <label for="inputEmail3" class="col-sm-2 col-form-label required">Descripcion</label>
            <div class="col-sm-10">
                <textarea name="descripcion" id="descripcion" cols="100" rows="4" placeholder="Descripcion de la experiencia del empleado" required></textarea>
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
        <button type="submit" class="btn btn-primary">Guardar</button>
        <div class="mb-4" style="float: right;">
            <a href="{{ route('empleado.index') }}" class="btn btn-info justify-content-end"><i class="fas fa-user-plus"></i><span style="margin-left:10px;">Lista de Empleados</span></a>
            <div class="clearboth">&nbsp;</div>
        </div>
      </form>
      
</div>

@endsection

@section('js')
<script type="text/javascript">
     
</script>
@endsection
