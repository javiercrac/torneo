        @extends('admin.masterAdmin')

        @section('title')
        <h1> Gestion De Arbitros <small ></small></h1>
        @endsection

        @section('breadcrumb')
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        @endsection

        @section('content')
         @if(Session::has('mensajeOk'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{Session::get('mensajeOk')}}
                        </div>
                    </div>
                </div>
                </hr>
                @endif
        @if(Session::has('mensajeError'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       {{Session::get('mensajeError')}}
                </div>
            </div>
        </div>
        </hr>
        @endif
        <div class="row">
            <div class=" col-md-12">
               <div class=" panel panel-default">
                    <div class=" panel-heading">Arbitros <a href="" id="btnNuevoArbitro" title="Nuevo Arbitro" class=" btn-xs btn btn-success" data-toggle="modal" data-target="#modalArbitroAgregar"><i class=" fa fa-plus"></i></a>
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="multiselect dropdown-toggle btn btn-xs btn-warning" data-toggle="dropdown" title="Ayuda">
                                    <i class="fa fa-question-circle"></i><b class="caret"></b>
                                </button>
                                <ul class="multiselect-container dropdown-menu pull-right">
                                    <li>Desde Aqui Puede Agregar (Click en "+"), editar o eliminar un arbitro</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class=" panel-body">
                        <table id="editar"  class=" table table-bordered table-condensed table-hover">
                            <tr>
                                <th>Nombre</th>
                            </tr>
                            @foreach($listArbitros as $arbitro)
                                <tr >
                                    <td>{{$arbitro->nombre}}</td>
                                    <td><a href="#"  class="btn btn-xs btn-info editar" data-idarbitro="{{$arbitro->idarbitro}}"  title="Editar"> <i class=" fa fa-edit"></i></a></td>
                                    <td><a href="" class="btn btn-xs btn-danger eliminar" data-idarbitro="{{$arbitro->idarbitro}}"  title="Eliminar"> <i class=" fa fa-close"></i></a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
               </div>
            </div>
        </div>

        <div class="modal fade" id="modalArbitroAgregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                    <div class="modal-content">
                          {!!Form::open(['route'=>'admin.arbitros.store','method'=>'POST'])!!}
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  <h4 class="modal-title" id="myModalLabel">Agregando Arbitro</h4>
                              </div>
                              <div class="modal-body"><div class=" panel panel-info">
                              <div class=" panel-heading">Arbitro</div>
                                 <div class=" panel-body">
                                  <div clas="row">
                                      <div class="col-md-12">
                                              {!!Form::label('nombre','Nombre')!!}
                                              {!!Form::Text('nombre',null,['class'=>' form-control'])!!}
                                      </div>
                                   </div>
                              </div>
                         </div></div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                  {!!Form::submit('Aceptar', array('class' => 'btn btn-success'))!!}
                              </div>
                          {!! Form::close() !!}
                    </div>
                  <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="modalArbitroModificar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                   <div class="modal-content">
                      {!!Form::open(['route'=>'admin.arbitros.update','method'=>'PUT'])!!}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Modificando Arbitro</h4>
                        </div>
                        <div class="modal-body">
                                <div class=" panel panel-default">
                                <div class=" panel-heading">Arbitro</div>
                                     <div class=" panel-body">
                                         <div class="row">
                                              <div class="col-md-12">
                                                    {!!Form::Text('idarbitro',null,['class'=>' hidden form-control','id'=>'idarbitroU'])!!}
                                                    {!!Form::label('nombre','Nombre')!!}
                                                    {!!Form::Text('nombre',null,['class'=>' form-control','id'=>'nombreU'])!!}
                                              </div>
                                         </div>
                                     </div>
                                </div>
                        <div class="modal-footer">
                            <div class="row ">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    {!!Form::submit('Modificar', array('class' => 'btn btn-success'))!!}
                                </div>
                            </div>
                        </div>
                      {!! Form::close() !!}
                   </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
          </div>
        </div>
        <div class="modal fade" id="modalArbitroEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              {!!Form::open(['route'=>['admin.arbitros.destroy'],'method'=>'DELETE'])!!}
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Eliminando Arbitro</h4>
                                </div>
                                <div class="modal-body">
                                       <div class="row">
                                            <div class="col-md-12">
                                                {!!Form::Text('idarbitro',null,['class'=>'hidden','id'=>'idarbitroD'])!!}
                                                <h3>¿Desea Eliminar el Arbitro?</h3>
                                                <div id="caca"></div>
                                            </div>
                                       </div>
                                <div class="modal-footer">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            {!!Form::submit('Eliminar', array('class' => 'btn btn-success'))!!}
                                        </div>
                                    </div>
                                </div>
                              {!! Form::close() !!}
                           </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                  </div>
                </div>

        @endsection
        @section('script')
        <script>
        $(function () {
            $('body').on('click', '.editar', function (event) {
                event.preventDefault();
                var id_articulo=$(this).attr('data-idarbitro');
                $.ajax({
                     url:"arbitros/buscar",
                     type: "POST",
                     dataType: "json",
                    data:{'idarbitro': id_articulo}
                    })
                .done(function(response){
                        //alert(response.datos.titulo);
                        $('#nombreU').val(response.datos.nombre);
                        $('#idarbitroU').val(response.datos.idarbitro);
                        $("#modalArbitroModificar").modal("show");
                    })
                    .fail(function(){
                        alert(id_articulo);
                    });
            });
            $('body').on('click', '.eliminar', function (event) {
                event.preventDefault();
                var id_arbitro=$(this).attr('data-idarbitro');
                $("#idarbitroD").val(id_arbitro);
                $("#modalArbitroEliminar").modal("show");
            });

        });

        </script>
        @endsection
