<!DOCTYPE html>
<html>

<head>
    <title>فاتورة العميل</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            font-family: 'El Messiri' !important;
            direction: rtl !important;
        }

        body {
            direction: ltr;
            font-size: 10px;
            font-family: 'El Messiri';
            padding: 100px;
            margin: 20px;
            color: #777;
            direction: rtl;
        }

        body {
            color: #777;
            text-align: right;
            direction: rtl;
        }

        body h1 {
            margin-bottom: 5px;
            padding-bottom: 5px;
            color: #000;
            direction: rtl;
        }

        body h3 {
            margin-top: 10px;
            margin-bottom: 20px;
            color: #555;
            direction: rtl;
        }

        body a {
            color: #06f;
            direction: rtl;
        }

        @page {
            size: a4;
            margin: 0;
            padding: 0;
            direction: rtl;
        }

        .invoice-box table {
            direction: ltr;
            width: 100%;
            text-align: right;
            border: 3px solid;
            font-family: 'El Messiri';
            direction: rtl;
        }

        .row {
            display: block;
            padding-left: 24;
            padding-right: 24;
            page-break-before: avoid;
            page-break-after: avoid;
            direction: rtl;
        }

        .column {
            display: block;
            page-break-before: avoid;
            page-break-after: avoid;
            direction: rtl;
        }

        .arabic-text {
            font-family: 'El Messiri';
            direction: rtl;
        }
    </style>
</head>

<body>

    <div class="row">
        <div class="column">
            <img src='https://special-pc.com/assets/ecommerce/img/special-pc-logo-dark.png'>
        </div>
    </div>
    <h1>فاتورة تحويل مصاريف الرحلة</h1>
    <h3>العميل: {{ $order->customer->name }}</h3>
    <h3>العنوان: {{ $order->customer->defaultAddress()->address }}</h3>
    <h3>الجوال: {{ $order->customer->phone }}</h3>




    <h3>رقم الطلب: {{ $order->id }}</h3>

    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                فاتورة تحويل مصاريف الرحلة
                            </td>

                            <td>
                                تاريخ تحويل : {{ \Carbon\Carbon::parse($order->payment->created_at)->format('Y-m-d H:i:s') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="item">
                <td><h4>المبلغ : {{ $order->payment->amount }} ريال</h4></td>
                <td><h4>مصاريف الرحلة</h4></td>
            </tr>

        </table>
        <div class="arabic-text">
            <p>

            </p>
        </div>
    </div>
</body>

</html>