<html><head>
    <title>Invoice Print</title>
    <style type="text/css">

        body{  font-size: 16px;  }
        p{  margin-top: 0;  margin-bottom: 0;  }
        p.text-right{  text-align: right;  }
        table{  width: 100%;  border-collapse: collapse;}
        .thead tr{  text-align: center;  min-height: 40px;  }
        .thead tr td p{  min-height: 40px;  }
        .main-content{  }
        tr.first td{  border:none;  text-align: center;  padding-bottom: 20px;  }

        tr.first.text-left td{  text-align: left;  }
        .main-content td, .main-content th{  border:1px solid #000;  padding: 5px;  }
        tr.extra td{  border:none;  }
        tr.tr-17 td{  color:#ffffff;  border:none;}
        tr.last{  padding-top: 50px;  }
        /* // button{  position: absolute;  left:100px;  color:red;  font-size: 25px;  cursor: pointer;  }*/
        .menu{position: absolute;top:20px;left:200px}
        .menu li{  display: inline;border: none;  outline: none;  padding: 10px 16px;  background-color: #f1f1f1;  cursor: pointer;  font-size: 18px;  }
        .menu li.active {  background-color: #666;  color: white;  }
        .menu li.active a{color:#fff}
        .menu li a{text-decoration: none;color:#000}
        button{display: inline;border: none;  outline: none;  padding: 10px 16px;  background-color: #f1f1f1;  cursor: pointer;  font-size: 18px;}
        .text-center{text-align: center}
        .left-info{float: left;text-align: left;width: 50%;font-size: 15px}
        .right-info{float: right;text-align: left;font-size: 15px}

        @media  print {
            .menu{
                display: none;
            }
        }

    </style>
    <style id="__web-inspector-hide-shortcut-style__" type="text/css">
        .__web-inspector-hide-shortcut__, .__web-inspector-hide-shortcut__ *, .__web-inspector-hidebefore-shortcut__::before, .__web-inspector-hideafter-shortcut__::after
        {
            visibility: hidden !important;
        }
    </style></head>

<body cz-shortcut-listen="true">

<table>
    <thead class="thead">
    <tr>
        <td colspan="2">
            <div class="menu">
                <button style="background-color: #5cb85c;color:#fff" onclick="window.print()">Print</button>
            </div>
        </td>
    </tr>
    </thead>


    <tbody>
    <tr><td colspan="2">
            <table class="main-content">
                <tbody>
                <tr class="first text-left">

                    <td colspan="6">
                        <div class="left-info">
                            <img height="80" src="{{ settings('site_logo',$settings) }}" alt="">
                        </div>
                        <div class="right-info">
                            <h3 style="margin:5px">{{ settings('site_title',$settings) }}</h3>
                            <br>
                            {{ settings('site_address',$settings) }}<br>
                            <strong>E-Mail:</strong>{{ settings('site_email',$settings) }}<br>
                            <strong>Mobile:</strong>{{ settings('site_phone',$settings) }}<br>
                        </div>
                    </td>



                </tr>
                <tr class="first">
                    <td colspan="6"><h3 style="text-align: center">Money Receive</h3></td>
                </tr>

                <tr class="first">
                    <td colspan="6">
                        <div class="left-info">
                            <strong>Name:</strong> {{ $payments->userinfo->name }}<br>
                            <strong>Course Name:</strong> {{ $payments->course->title }}<br>
                            <strong>Phone:</strong> {{ $payments->userinfo->phone }}
                        </div>
                        <div class="right-info">
                            <strong>Invoice no:</strong> {{ $payments->id }}<br>
                            <strong>Date:</strong> {{ date('d M, Y') }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center">SL.</th>
                    <th class="text-center">Payment Date</th>
                    <th class="text-center hides">Type</th>
                    <th class="text-center">Trx Id</th>
                    <th class="text-center hides">Payment By</th>
                    <th class="text-center hides">Amount</th>
                </tr>
                @php $total_amount=0; @endphp
                @foreach($payments_detail as $key=>$single)
                <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td>{{ date('d M, Y',strtotime($single->created_at)) }}</td>
                    <td class="text-center">{{ $single->type }}</td>
                    <td class="text-center">{{ $single->trabsaction_id }}</td>
                    <td class="text-center">{{ $single->paymentby->name or '' }}</td>
                    <td class="text-center">{{ $single->amount }}</td>
                </tr>
                @php $total_amount += $single->amount @endphp
                @endforeach

                <tr>
                    <td rowspan="4" colspan="4">
                        @php $f = new NumberFormatter("en", NumberFormatter::SPELLOUT); @endphp
                        <p>Payment In Word: <b>{{ucwords($f->format($total_amount))}}  </b>Taka Only</p>
                    </td>
                    <td><p class="text-right">Sub Total:</p></td>
                    <td>{{ $total_amount }}</td>
                </tr>
                <tr>
                    <td><p class="text-right">Course Fee</p></td>
                    <td>{{ $payments->course->course_fee }}</td>
                </tr>
                <tr>
                    <td><p class="text-right">Paidable Fee</p></td>
                    <td>{{ $paidable_fee = $payments->course->course_fee - $payments->course->discount }}</td>
                </tr>

                <tr>
                    <td><p class="text-right">Due: </p></td>
                    <td>{{ $paidable_fee-$total_amount }}</td>
                </tr>

                <tr class="extra">
                    <td colspan="5">
                        <br>
                        <p>Thanking You</p>

                        <p></p>
                        <br>
                        <br>

                        ______________
                        <br>
                        For<br>
                        {{ settings('site_title',$settings) }}
                    </td>
                    <td colspan="1">

                        <p></p>

                        <p></p>
                        <br>
                        <br>
                        <p>
                            ______________
                            <br>
                            Received By
                        </p>

                    </td>
                </tr>


                </tbody>

            </table>
        </td>
    </tr></tbody>

</table>






<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    //window.print()
</script>



</body></html>