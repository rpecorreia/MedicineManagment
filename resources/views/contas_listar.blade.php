@extends('layouts.backendadmin')
@section('content')

<h3>Listar Contas
    <br><br>
    <small class="text-muted">{{__('|  Lista de Farmacêuticos:') }}</small>
</h3>

<div class="container">
    <div class="card text-center">
            <div class="card-header">
            </div>

        <div class="card-body">

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

            <h5 class = "card-title">Exibindo {{$farmaceuticos->count()}} farmacêuticos de {{$farmaceuticos->total()}}
                ({{$farmaceuticos->firstItem()}} a {{$farmaceuticos->lastItem()}})</h5>

            <table class = "table table-hover table-vcenter">
                <thead>
                <th scope = "col">Nome</th>
                <th scope = "col">Email</th>
                <th scope = "col">Estado</th>
                <th scope = "col">Data</th>

                </thead>
                <tbody>
                @foreach($farmaceuticos as $f)
                    <tr>
                        <td>{{$f->name}}</td>
                        <td>{{$f->email}}</td>
                        @foreach($estado as $e)
                            @if($e->id === $f->estado_id)
                                <td class="d-none d-sm-table-cell">
                                    @if($f->estado_id === 1)
                                        <span class="badge badge-success">{{$e->estado}}</span>
                                    @endif
                                    @if ($f->estado_id === 2)
                                        <span class="badge badge-primary">{{$e->estado}}</span>
                                    @endif
                                    @if ($f->estado_id === 3)
                                        <span class="badge badge-warning">{{$e->estado}}</span>
                                    @endif
                                    @if ($f->estado_id === 4)
                                        <span class="badge badge-danger">{{$e->estado}}</span>
                                    @endif

                                </td>
                            @endif
                        @endforeach
                        <td>{{$f->updated_at}}</td>

                        <td>
                             <div class="btn-group">
                                 <button class="btn btn-sm btn-light js-tooltip-enabled" onclick="location.href='/admin/alterarconta/{{$f->id}}' ;" type="button" data-toggle="tooltip" title="Editar">
                                     <i class = "fa fa-fw fa-pencil-alt">
                                     </i>
                                 </button>


                             </div>
                         </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class = "card-footer">
            {{$farmaceuticos->links()}}
        </div>
    </div>
</div>


<script src= "{{ asset('js/app.js') }}" type = "text/javascript"></script>





@endsection


