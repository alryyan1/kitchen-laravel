<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=11" />

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <style>
            @import url('http://fonts.googleapis.com/earlyaccess/droidarabickufi.css');
            * {
                font-family: 'Droid Arabic Kufi', serif;
              }
        </style>

        <link rel="stylesheet" href="/kitchen-laravel/public/js/sweetalert2/sweetalert2.min.css">
        <script src="/kitchen-laravel/public/js/sweetalert2/sweetalert2.min.js"></script>

        <script>
            let number = 1;
            let counter = {!! count($items) !!};
            function addItem()
            {
                if(number >= counter){
                    Swal.fire({
                        title: 'عُذرا',
                        html: "تم إستخدام جميع الأصناف",
                        icon: "warning",
                        timer: 3000,
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('I was closed by the timer')
                        }
                    })
                }
                else{

                    number++;
                    var myDiv = document.createElement("div");
                    myDiv.classList.add("col-lg-12");
                    myDiv.classList.add("row");
                    myDiv.innerHTML += '<div class="form-group col-lg-2">'+
                        '<button type="button" class="btn btn-sm btn-danger text-white" onclick="removeItem(this)">'+
                        '<i class="mdi mdi-delete"></i></button></div>'+
                        '<div class="form-group col-lg-2">'+
                        '<input type="number" readonly class="form-control" name="full_price[]"  id="full_price'+number+'" step=".01" required>'+
                        '</div><div class="form-group col-lg-2">'+
                        '<input type="number" class="form-control" name="price[]" id="price'+number+'" step=".01" required onblur="computeFullPrice('+number+')">'+
                        '</div><div class="form-group col-lg-2">'+
                        '<input type="number" class="form-control" name="quantity[]"  id="quantity'+number+'" required onblur="computeFullPrice('+number+')">'+
                        '</div><div class="form-group col-lg-4">'+
                        '<select name="item[]" class="form-control">'+
                        '@foreach ($items as $item)'+
                        '<option value="{{ $item->id }}">{{ $item->ar_name }}</option>'+
                        '@endforeach</select></div></div>';

                    var div = document.getElementById("items");

                    div.append(myDiv);
                }
            }
            function removeItem(row)
            {
                var d = row.parentNode.parentNode.remove();
                number--;
            }

            function computeFullPrice(num)
            {
                let quantity = parseInt(document.getElementById('quantity'+num).value);
                let price = parseFloat(document.getElementById('price'+num).value);

                document.getElementById('full_price'+num).value =quantity * price;
            }
        </script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.4.47/css/materialdesignicons.min.css" integrity="sha512-/k658G6UsCvbkGRB3vPXpsPHgWeduJwiWGPCGS14IQw3xpr63AEMdA8nMYG2gmYkXitQxDTn6iiK/2fD4T87qA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <br><br>
    <body class="container" dir="rtl">
        <div class="card">
            <div class="card-header text-right arabic bg-secondary">
                إضافة مصروف
            </div><br>

            <div class="card-body">
                @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                <form method="post" action="../costs">
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="form-label">  المورد </label>
                            <select name="supplier_id" class="form-control">
                                <option value="">...</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="form-label"> وصف المصروف </label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="form-label"><i class='text-danger'>*</i>المبلغ</label>
                            <input type="number" class="form-control" name="amount" step=".01" required>
                        </div>

                        <div class="form-group col-lg-6">
                            <label class="form-label"> قسم المصروف </label>
                            <select name="cost_category_id" class="form-control">
                                <option value="">...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br><br><br><br><br><br><br><br><br><br>

                        <div class="alert alert-info col-12">
                            <button type="button" class="btn btn-sm btn-info" onclick="addItem()">
                                <i class="mdi mdi-plus"></i>
                            </button>
                            الأصناف
                        </div>

                        <div class="items" id="items">

                            <div class="col-lg-12 row">
                                <div class="form-group col-lg-2">
                                    <label class="form-label">  حذف </label><br>
                                    <button type="button" class="btn btn-sm btn-danger text-white" onclick="removeItem(this)">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </div>

                                <div class="form-group col-lg-2">
                                    <label class="form-label">  الإجمالي </label>
                                    <input type="number" readonly class="form-control" name="full_price[]" id="full_price1" step=".01" required>
                                </div>

                                <div class="form-group col-lg-2">
                                    <label class="form-label"> سعر الوحدة </label>
                                    <input type="number" class="form-control" name="price[]" id="price1" step=".01" required onblur="computeFullPrice(1)">
                                </div>

                                <div class="form-group col-lg-2">
                                    <label class="form-label"> الكمية </label>
                                    <input type="number" class="form-control" name="quantity[]" id="quantity1" required onblur="computeFullPrice(1)">
                                </div>

                                <div class="form-group col-lg-4">
                                    <label class="form-label"> الصنف </label>
                                    <select name="item[]" class="form-control">
                                        @foreach ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->ar_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
            </div>
            <div class="card-footer justify-content-center" align="center">
                <button type="submit" class="btn btn-lg btn-primary text-white">حفظ</button>
            </div>

        </form>
        </div>
    </body>
</html>
