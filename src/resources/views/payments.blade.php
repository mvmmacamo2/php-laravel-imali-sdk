@extends('imali::master')

@section('imali::content')

    <h1>Pagamentos</h1>
    <div class="date">
        <label for="date">Data</label>
        <input type="date" name="date" id="date">
    </div>

{{--    <div class="form-details">--}}
{{--        <form action="{{route('requestPayment')}}" method="post">--}}
{{--            <div class="payment-details">--}}
{{--                <div class="input-box">--}}
{{--                    <label for="inputEmail4">Conta da Loja</label>--}}
{{--                    <input type="number" name="storeAccountNumber" class="form-control" id="inputEmail4"--}}
{{--                           placeholder="Nr Conta">--}}
{{--                </div>--}}
{{--                <div class="input-box">--}}
{{--                    <label for="inputPassword4">Conta do Clinte</label>--}}
{{--                    <input type="number" name="clientAccountNumber" class="form-control" id="inputPassword4"--}}
{{--                           placeholder="Nr de conta do Cliente">--}}
{{--                </div>--}}

{{--                <div class="input-box">--}}
{{--                    <label for="inputPassword4">Montante</label>--}}
{{--                    <input type="number" name="amount" class="form-control" id="inputPassword4"--}}
{{--                           placeholder="Dinheiro a ser pago">--}}
{{--                </div>--}}

{{--            </div>--}}
{{--            <div class="payment-details">--}}
{{--                <div class="input-box" id="description">--}}
{{--                    <label for="description">Descrição do Pagamento</label>--}}
{{--                    <input type="text" class="form-control" id="description" name="description"--}}
{{--                           placeholder="Ex: Corte do Cabelo">--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="payment-details">--}}
{{--                <div class="input-box">--}}
{{--                    <label for="inputCity">terminalID</label>--}}
{{--                    <input type="text" class="form-control" id="inputCity" name="terminalID" value="102">--}}
{{--                </div>--}}
{{--                <div class="input-box">--}}
{{--                    <label for="inputCity">terminalChannel</label>--}}
{{--                    <input type="text" class="form-control" id="inputCity" name="terminalChannel" value="Web">--}}
{{--                </div>--}}
{{--                <div class="input-box">--}}
{{--                    <label for="inputZip">terminalCompanyName</label>--}}
{{--                    <input type="text" class="form-control" id="inputZip" name="terminalCompanyName"--}}
{{--                           value="KayaEventos">--}}
{{--                </div>--}}


{{--            </div>--}}

{{--            <div class="btn">--}}
{{--                <button type="submit" class="btn btn-success">Requisitar Pedido</button>--}}
{{--            </div>--}}

{{--        </form>--}}

{{--    </div>--}}

    <div class="recent-order">
        <h2>Pagamentos</h2>

        <table>
            <thead>
            <tr>
                <th>Transaction</th>
                <th>Account Number</th>
                <th>Amount</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <h2 id="table-message"></h2>
            {{--                <tr>--}}
            {{--                    <td>JBWUHSVSLJQNSK</td>--}}
            {{--                    <td>2125452111</td>--}}
            {{--                    <td>35</td>--}}
            {{--                    <td class="warning">Pending</td>--}}
            {{--                    <td class="primary">Detalhes</td>--}}
            {{--                </tr>--}}
            {{--                <tr>--}}
            {{--                    <td>JBWUHSVSLJQNSK</td>--}}
            {{--                    <td>2125452111</td>--}}
            {{--                    <td>35</td>--}}
            {{--                    <td class="warning">Pending</td>--}}
            {{--                    <td class="primary">Detalhes</td>--}}
            {{--                </tr>--}}
            {{--                <tr>--}}
            {{--                    <td>JBWUHSVSLJQNSK</td>--}}
            {{--                    <td>2125452111</td>--}}
            {{--                    <td>35</td>--}}
            {{--                    <td class="warning">Pending</td>--}}
            {{--                    <td class="primary">Detalhes</td>--}}
            {{--                </tr>--}}
            {{--                <tr>--}}
            {{--                    <td>JBWUHSVSLJQNSK</td>--}}
            {{--                    <td>2125452111</td>--}}
            {{--                    <td>35</td>--}}
            {{--                    <td class="warning">Pending</td>--}}
            {{--                    <td class="primary">Detalhes</td>--}}
            {{--                </tr>--}}
            </tbody>
        </table>
        <a href="#">Mostrar Todos</a>
        <!--------------- FIM DO TABLE ---------------->

    </div>

@endsection
