@extends('imali::master')

@section('imali::content')

    <h1>Dashboard</h1>
    <div class="date">
        <input type="date" name="date">
    </div>
    <div class="insights">
        <!------------  TOTAL VENDIDO ------------------->
        <div class="sales">
            <span class="material-icons-sharp">verified</span>
            <div class="middle">

                <div class="left">
                    <h3>Total Pagamentos</h3>
                    <h1>250.5 MT</h1>
                </div>

                <div class="progress">
                    <svg>
                        <circle r="36" cx="38" cy="38"></circle>
                    </svg>
                    <div class="number">
                        <p>81%</p>
                    </div>
                </div>
            </div>

            <small class="text-muted">
                Últimas 24 horas
            </small>
        </div>
        <!------------  FIM TOTAL VENDIDO ------------------->


        <!------------  TOTAL QRCODES ------------------->
        <div class="expenses">
            <span class="material-icons-sharp">qr_code</span>
            <div class="middle">

                <div class="left">
                    <h3>Total QRCODES</h3>
                    <h1>28</h1>
                </div>

                <div class="progress">
                    <svg>
                        <circle r="36" cx="38" cy="38"></circle>
                    </svg>
                    <div class="number">
                        <p>61%</p>
                    </div>
                </div>
            </div>

            <small class="text-muted">
                Últimas 24 horas
            </small>
        </div>
        <!------------  FIM TOTAL QRCODES ------------------->


        <!------------  TOTAL QRCODES ------------------->
        <div class="income">
            <span class="material-icons-sharp">local_mall</span>
            <div class="middle">

                <div class="left">
                    <h3>Total Reembolso</h3>
                    <h1>45%</h1>
                </div>

                <div class="progress">
                    <svg>
                        <circle r="36" cx="38" cy="38"></circle>
                    </svg>
                    <div class="number">
                        <p>31%</p>
                    </div>
                </div>
            </div>

            <small class="text-muted">
                Últimas 24 horas
            </small>
        </div>
        <!------------  FIM TOTAL QRCODES ------------------->


    </div>
    <!---------- FIM DE INSIGHTS ----------->


    <div class="recent-order">
        <h2>Pagamentos Recentes</h2>

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
            <h2 id="table-message">Teste sjsjdskd sjbsdj</h2>
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

@section('imali::right')


    <div class="recent-updates">
        <h2>Actualizações Recentes</h2>
        <div class="updates">
            <div class="update">
                <div class="profile-photo">
                    <img src="{{asset('vendor/imali/images/profile/profile-1.jpg')}}" alt="profile"/>
                </div>
                <div class="message">

                    <p><b>Miguel Macamo</b> recebeu pagamento recente deste cliente</p>
                    <small class="text-muted">Há 2 minitos atrás</small>
                </div>
            </div>
            <div class="update">
                <div class="profile-photo">
                    <img src="{{asset('vendor/imali/images/profile/profile-1.jpg')}}" alt="profile"/>
                </div>
                <div class="message">

                    <p><b>Miguel Macamo</b> recebeu pagamento recente deste cliente</p>
                    <small class="text-muted">Há 2 minitos atrás</small>
                </div>
            </div>
            <div class="update">
                <div class="profile-photo">
                    <img src="{{asset('vendor/imali/images/profile/profile-1.jpg')}}" alt="profile"/>
                </div>
                <div class="message">

                    <p><b>Miguel Macamo</b> recebeu pagamento recente deste cliente</p>
                    <small class="text-muted">Há 2 minitos atrás</small>
                </div>
            </div>
        </div>

    </div>
    <!---------- FIM DE ACTUALOXACOES RECENTES ------>

    <div class="sales-analytics">
        <h2>Análise de Vendas</h2>
        <div class="item online">

            <div class="icon">
                <span class="material-icons-sharp">shopping_cart</span>
            </div>
            <div class="right">
                <div class="info">
                    <h3>Vendas Online</h3>
                    <small>Últimas 24 horas</small>
                </div>
                <h5 class="success">+45%</h5>
                <h3>3849</h3>
            </div>

        </div>

        <div class="item offline">

            <div class="icon">
                <span class="material-icons-sharp">local_mall</span>
            </div>
            <div class="right">
                <div class="info">
                    <h3>Vendas Online</h3>
                    <small>Últimas 24 horas</small>
                </div>
                <h5 class="danger">-17%</h5>
                <h3>1100</h3>
            </div>

        </div>


        <div class="item customers">

            <div class="icon">
                <span class="material-icons-sharp">person</span>
            </div>
            <div class="right">
                <div class="info">
                    <h3>NOVOS CLIENTES</h3>
                    <small>Últimas 24 horas</small>
                </div>
                <h5 class="success">+25%</h5>
                <h3>849</h3>
            </div>

        </div>

        <div class="item add-product">

            <div>
                <span class="material-icons-sharp">add</span>
                <h3>Novo Produto</h3>
            </div>
        </div>

    </div>

@endsection
