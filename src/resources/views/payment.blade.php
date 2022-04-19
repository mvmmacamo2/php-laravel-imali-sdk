<html lang="en">
<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#"/>
    <title>MiguelMacamo Api</title>


    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--font awesome con CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

</head>

<body>

<div class="container">

    <div class="row">

        <div class="col-md-10">
            <div class="card mt-5">

                <div class="card-header">
                    <div class="card-title">
                        <h3>Meu Pagamento</h3>
                    </div>
                </div>

                <div class="card-body">

                    {{--                    <form action="{{route('requestPayment')}}" method="post">--}}
                    {{--                        @csrf--}}
                    {{--                        <div class="mb-3">--}}
                    {{--                            <label for="exampleInputEmail1" class="form-label">Conta da Loja</label>--}}
                    {{--                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"--}}
                    {{--                                   name="name">--}}
                    {{--                            <div id="emailHelp" class="form-text">Deve ser indicado o nr de loja do parceiro integrador.</div>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="mb-3">--}}
                    {{--                            <label for="exampleInputPassword1" class="form-label">Password</label>--}}
                    {{--                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">--}}
                    {{--                        </div>--}}

                    {{--                        <button type="submit" class="btn btn-primary">Submit</button>--}}
                    {{--                    </form>--}}

                    <form action="{{route('requestPayment')}}" method="post">
                        <div class="form-row row">
                            <div class="form-group col-md-5">
                                <label for="inputEmail4">Conta da Loja</label>
                                <input type="number" name="storeAccountNumber" class="form-control" id="inputEmail4"
                                       placeholder="Nr Conta">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="inputPassword4">Conta do Clinte</label>
                                <input type="number" name="clientAccountNumber" class="form-control" id="inputPassword4"
                                       placeholder="Nr de conta do Cliente">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputPassword4">Montante</label>
                                <input type="number" name="amount" class="form-control" id="inputPassword4"
                                       placeholder="Dinheiro a ser pago">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Descrição do Pagamento</label>
                            <input type="text" class="form-control" id="inputAddress" name="description"
                                   placeholder="Corte do Cabelo">
                        </div>

                        <div class="form-row row">
                            <div class="form-group col-md-4">
                                <label for="inputCity">terminalID</label>
                                <input type="text" class="form-control" id="inputCity" name="terminalID" value="102" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputCity">terminalChannel</label>
                                <input type="text" class="form-control" id="inputCity" name="terminalChannel" value="Web" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputZip">terminalCompanyName</label>
                                <input type="text" class="form-control" id="inputZip" name="terminalCompanyName" value="KayaEventos" >
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Requisitar Pedido</button>

                    </form>

                </div>
            </div>


        </div>
    </div>
</div>
</body>
</html>
