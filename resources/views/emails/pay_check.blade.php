
<style type="text/css">

        #demoShop table {
            white-space: nowrap;
            width: 100%;
            border-spacing: 5pt;
        }

        #demoShop table.shop {
            text-align: right;
        }

        #demoShop table.forms {
            text-align: left;
        }

        #demoShop table.forms tr {
            vertical-align: top;
        }

        #demoShop table.forms div {
            font-family: monospace;
            width: 100%;
            margin: 0.5em 0 1.5em 0;
            background-color: #fffff0;
            border: solid 1px #e1e1e1;
            padding: 0.4em;
        }
        #codeLanguage ul {
            list-style: none;
            position: relative;
            float: left;
            width: auto;
            margin: 0;
            padding: 0;
        }

            #codeLanguage ul li {
            position: relative;
            float: left;
            margin: 0;
        }

        #codeLanguage ul li a {
            text-decoration: none;
            white-space: nowrap;
            display: block;
            padding: 0.3em 0.5em;
        }

        #codeLanguage ul li a.selected {
            background-color: #38B6FF;
            color: White;
                }
    </style>
<?php
// регистрационная информация (Идентификатор магазина, пароль #1)
// registration info (Merchant ID, password #1)
$mrh_login = "stomarenda.ru";
$mrh_pass1 = "KQ6kYKO73Hu04kOxtOUu";
// номер заказа
// number of order
$inv_id = $data['id'];

// описание заказа
// order description
$inv_desc = 'Заказ оборудований/пакета.';

// сумма заказа
// sum of order
$out_summ = $data['total_amount'];

// тип товара
// code of goods
$shp_item = $data['id'];

// предлагаемая валюта платежа
// default payment e-currency
$in_curr = "BANKOCEAN2R";

// язык
// language
$culture = "ru";

// кодировка
// encoding
$encoding = "utf-8";

// Адрес электронной почты покупателя
// E-mail
$Email = $data['email'];

// Срок действия счёта
// Expiration Date
$adaylater = date('Y-m-d H:i:s', strtotime('+1 day', time()));
$ExpirationDate = $adaylater;

// Валюта счёта
// OutSum Currency
$OutSumCurrency = "RUR";

// формирование подписи
// generate signature
$crc  = md5("$mrh_login:$out_summ:$inv_id:$OutSumCurrency:$mrh_pass1:Shp_item=$shp_item");


// форма оплаты товара
// payment form


?>




<table class="shop">
        <tr>
            <td colspan="4" style="text-align: center; padding-bottom: 5pt;">
                <span class="tit1">
                    Ваш заказ</span>
            </td>
        </tr>

        <tr style="font-weight: bold;">
            <td style="text-align: left;">
                </td>
            <td style="width: 10%; ">
                Кол-во (шт.)</td>

            <td style="width: 10%;">
                За день.</td>
                @if($data['days']>1)
            <td style="width: 10%; ">
                За весь период ({{$data['days']}}дн.)</td>
                @endif
        </tr>
        <tr>
            <td colspan="4">
                <hr style="height: 1pt; margin: 1pt auto;" />
            </td>
        </tr>

        <tr>
            <td style="text-align: left;">
                {{$data['product_name']}}
            </td>
            <td>
                1
            </td>
            <td>
                {{$data['one_product_price']}}р.
            </td>
              @if($data['days']>1)
            <td>
                {{$data['product_price']}}р.
            </td>
            @endif
        </tr>
       
        @if(count($data['related_product']))
            @foreach($data['related_product'] as $related)
                @if($related->related_count != 0)
                <tr>
                    <td style="text-align: left;">
                        {{$related->name.' '.$related->model}}
                    </td>
                    <td>
                        {{$related->related_count}}
                    </td>
                    <td>
                        {{$related->price*$related->related_count}}р.
                    </td>
                    @if($data['days']>1)
                    <td>
                        {{$related->price*$related->related_count}}р.
                    </td>
                    @endif
                </tr>
                @endif
            @endforeach
        @endif
        @if($data['delivery_fee']!= 0)
        <tr>
            <td style="text-align: left;">
                Доставка
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
                {{$data['delivery_fee']}}р.
            </td>
        </tr>
        @endif
        <tr>
            <td colspan="4">
                <hr style="height: 1pt; margin: 1pt auto;" />
            </td>
        </tr>
        <tr style="font-weight: bold;">
            <td style="text-align: left;" colspan="3">
                </td>
            <td>{{$data['total_amount']}}р.</td>
        </tr>



        <tr>
            <td colspan="4" style="text-align: center; padding-top: 5pt;">

               <form action='https://auth.robokassa.ru/Merchant/Index.aspx' method=POST>
    <input type='hidden' name='MrchLogin' value="<?=$mrh_login?>">
    <input type='hidden' name='OutSum' value="<?=$out_summ?>">
    <input type='hidden' name='InvId' value="<?=$inv_id?>">
    <input type='hidden' name='Desc' value="<?=$inv_desc?>">
    <input type='hidden' name='SignatureValue' value="<?=$crc?>">
    <input type='hidden' name='Shp_item' value="<?=$shp_item?>">
    <input type='hidden' name='IncCurrLabel' value="<?=$in_curr?>">
    <input type='hidden' name='Culture' value="<?=$culture?>">
    <input type='hidden' name='Email' value="<?=$Email?>">
    <input type='hidden' name='ExpirationDate' value="<?=$ExpirationDate?>">
    <input type='hidden' name='OutSumCurrency' value="<?=$OutSumCurrency?>">
    <button type="submit"  target="_top" style="width: 126px;height: 38px;background: url('https://auth.robokassa.ru/Merchant/PaymentForm/FormMS.js');line-height: 37px;" type='submit' >Оплатить</button>
    </form>
            </td>
        </tr>
    </table>
