<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Faktura z dnia {{ $invoice['date'] }}</title>
    <style>
        .container {
            margin: auto;
            width: 80%;
            padding: 10px;
            border: 1px solid #000000;
        }

        .client, .worker {
            position: relative;
            float: left;
            width: 40%;
            padding: 15px;
            margin: 15px;
        }

        .description {
            margin: 15px;
            padding: 15px;
        }

        .invoice-data {
            margin: 15px;
            padding: 15px;
        }

        .invoice-data table {
            width: 100%;
            border: 1px solid #000000;
            padding: 10px;
        }

        table th:first-child, table td:first-child {
            width: 80%;
        }

        table th:last-child, table td:last-child {
            width: 20%;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }
    </style>
</head>
<body>
@if($invoiceNumber = array_get($invoice, 'invoice_number'))
    <div class="invoice-number">
        {{ $invoiceNumber }}
    </div>
@endif
<div class="container">
    <div class="person">
        <div class="client">
            <h4>Dane klienta</h4>
            <ul>
                <li>{{ array_get($client, 'name') }} {{ array_get($client, 'last_name') }}</li>
                @if (!empty($client['street']))
                    <li>{{ $client['street'] . ' ' . array_get($client, 'house_number') . (!empty($client['apartment_number']) ? '/' . $client['apartment_number'] : '') }}</li>
                @endif
            </ul>
        </div>
        <div class="worker">
            <h4>Dane pracownika</h4>
            <ul>
                <li>{{ array_get($worker, 'name') }} {{ array_get($worker, 'last_name') }}</li>
                <li>{{ array_get($worker, 'phone_number') }}</li>
                <li>{{ array_get($worker, 'email') }}</li>
            </ul>
        </div>
    </div>
    <div style="clear: both;"></div>
    <div class="description">
        <h3>Opis:</h3>
        {{ array_get($notification, 'description') }}
    </div>
    <div class="invoice-data">
        <table>
            <thead>
            <tr>
                <th>Opis uslugi</th>
                <th>Cena</th>
            </tr>
            </thead>
            <tbody>
            @for ($i = 1; $i <= (count($invoice['data']) / 2); $i++)
                <tr>
                    <td>{{ $invoice['data']['service_' . $i] }}</td>
                    <td>{{ number_format($invoice['data']['price_' . $i], 2) }} zl</td>
                </tr>
            @endfor
            </tbody>
        </table>
        Cena na fakturze {{ number_format($invoice['sum'], 2) }} zl, wystawiona {{ $invoice['date'] }}
    </div>
</div>
</body>
</html>
