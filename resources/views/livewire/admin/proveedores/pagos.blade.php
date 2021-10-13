<div>
    
    <div class="card">
    
        <div class="card-header">
            <input wire:model="search" type="text" class="form-control" placeholder="Buscador de pagos por fecha o totales con comisión">
        </div>
    
        @if($pagos->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vendedor</th>                           
                            <th>Dirección de pago PAYPAL</th>                          
                            <th>Teléfono de contacto</th>                          
                            <th>Comisión</th>
                            <th>Total con comisión</th>
                            <th>Servicio</th>
                            <th>Vencimiento de pago</th>
                            <th>Total a pagar</th>
                            <th>Operación</th>
                        </tr>
                    </thead>
    
                    <tbody>
                        @foreach($pagos as $pago)
                            <tr>
                                
                                <td>{{ $pago->id }}</td>
                                {{-- App\Models\Order::searchUser creamos esta funcion para obtener los usuarios con el id --}}
                                <td>{{ App\Models\Order::searchUser($pago->vendedor_user_id)->name }}</td>
                                
                                <td>
                                    {{ App\Models\Order::searchUser($pago->vendedor_user_id)->validate->cobroPaypal }}
                                </td>
                                
                                <td>{{ App\Models\Order::searchUser($pago->vendedor_user_id)->validate->celular }}</td>
                                <td>{{ $pago->commission }} %</td>
                                <td>USD {{ $pago->totalConComision }}</td>
                                <td>
                                    {{ App\Models\Order::searchUser($pago->vendedor_user_id)->posts[0]['name']}}
                                </td>
                                <td>
                                    {{-- A la fecha de creación de la orden le sumamos los días de entrega asi obtenemos la fecha de vencimiento de pago --}}
                                    {{ $pago->created_at->addDays(App\Models\Order::searchUser($pago->vendedor_user_id)->posts[0]['tiempo_entrega'])->diffForHumans() }}
                                </td>
                                <td class="text-danger font-weight-bold">USD {{ $pago->total }}</td>
                                <td>
                                    @if($pago->status == 6)
                                    <span class="badge badge-danger">DEBE PAGAR</span>
                                    @else
                                    <span class="badge badge-success">AÚN NO SE CERRÓ</span>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>    
            </div>
    
            <div class="card-footer">
                {{ $pagos->links() }}
            </div>
        
        @else
            <div class="card-body">
                <strong>No hay ningún registro coincidente</strong>
            </div>
        @endif
    </div>

</div>
