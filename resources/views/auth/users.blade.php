<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=11" />

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <style>
            @import url('http://fonts.googleapis.com/earlyaccess/droidarabickufi.css');
            .arabic {
                font-family: 'Droid Arabic Kufi', serif;
              }
            .english {
                font-family: 'Poppins', serif;
              }
        </style>
        <script>
            function editUser(id)
            {
                var name = "name"+id;
                var username = "username"+id;
                var type =  document.getElementById("type"+id).innerHTML;

                var drop = document.getElementById("types");

                document.getElementById("user_id").value = id;
                document.getElementById("name").value = document.getElementById(name).innerHTML;
                document.getElementById("username").value = document.getElementById(username).innerHTML;

                for(let k =0; k < drop.length; k++)
                {
                    if(drop[k].value == type) {drop[k].selected = true;}
                    else {drop[k].selected = false;}
                }
                $("#edit").modal('show');
            }

            function destroy(id)
            {
                Swal.fire({
                    title: "تحذير",
                    text:  "هل أنت متأكد من الحذف؟",
                    icon: "error",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "نعم",
                    cancelButtonText: "لا",
                    customClass: "arabic",
                }).then((result) => {
                    if (result.value)
                    {
                        window.location = "users/"+id;
                    }
                });
            }
        </script>

        <link rel="stylesheet" href="/kitchen-laravel/public/js/sweetalert2/sweetalert2.min.css">



    </head>

    <br><br>
    <body class="container" dir="rtl">

        @if (Session::has('message'))
            <script src="/kitchen-laravel/public/js/sweetalert2/sweetalert2.min.js"></script>
            <script>
                Swal.fire({
                    title: 'نجاح',
                    html: "{!! Session::get('message') !!}",
                    icon: "success",
                    customClass: "arabic",
                    timer: 3000,
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                })
            </script>
        @endif

        <div class="modal fade" id="edit"  tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered arabic" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title text-center font-weight-bold">
                            تعديل المستخدم
                        </h3>
                    </div>

                    <form method="POST" action="updateUser">
                        @csrf
                        <input type="hidden" id="user_id" name="user_id">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class='text-danger'>*</i> الإسم
                                 </label>
                                <input type="text" class="form-control" name="name" id='name' required>
                                @error('name')
                                قيمة الحقل غير صحيحة
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label"><i class='text-danger'>*</i> إسم المستخدم </label>
                                <input type="text" class="form-control" name="username" id='username' required>
                                @error('name')
                                قيمة الحقل غير صحيحة - لابد ان تتكون من 6 حروف على الأقل
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label"><i class='text-danger'>*</i> نوع المستخدم </label>
                                <select name="user_type" class="form-control english" id='types'>
                                    <option value="admin">admin</option>
                                    <option value="staff">staff</option>
                                </select>
                                @error('name')
                                الرجاء الإختيار من القائمة فقط
                                @enderror
                            </div>
                            {{--  <div class="form-group">
                                <label class="form-label"> كلمة المرور </label>
                                <input type="password" class="form-control" name="password">
                                @error('name')
                                قيمة الحقل غير صحيحة - لابد ان تتكون من 6 حروف على الأقل أو أرقام
                                @enderror
                            </div>  --}}

                        </div>
                        <div class="modal-footer justify-content-between" style="display: flex; justify-content:space-between;">
                            <button type="button" class="btn btn-primary float-start" data-dismiss="modal">إلغاء</button>
                            <input type="submit" value="تعديل" class="btn btn-warning float-end">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header text-right arabic bg-secondary">
                المستخدمين
            </div>

            <div class="card-body row">
                <div class="col-lg-8">
                    <table class="table text-center" dir="rtl" align="center">
                        <thead>
                            <tr class="arabic">
                                <th>#</th>
                                <th>الإسم </th>
                                <th>إسم المستخدم</th>
                                <th>نوع المستخدم</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="english">
                                <td>{{ $loop->iteration }}</td>
                                <td id="name{{ $user->id }}">{{ $user->name }}</td>
                                <td id="username{{ $user->id }}">{{ $user->username }}</td>
                                <td id="type{{ $user->id }}">{{ $user->user_type }}</td>
                                <td class="arabic">
                                    <button type="button" class="btn btn-warning text-white" onclick="editUser({{ $user->id }})">تعديل</button>
                                    <button type="button" class="btn btn-danger text-white"  onclick="destroy({{ $user->id }})">حذف</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-lg-4 arabic">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="createUSer">
                        @csrf
                        <div class="form-group">
                            <label class="form-label"><i class='text-danger'>*</i> الإسم </label>
                            <input type="text" class="form-control" name="name" required>
                            @error('name')
                            {{ $message }}                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class='text-danger'>*</i> إسم المستخدم </label>
                            <input type="text" class="form-control" name="username" required>
                            @error('name')
                            قيمة الحقل غير صحيحة - لابد ان تتكون من 6 حروف على الأقل
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class='text-danger'>*</i> نوع المستخدم </label>
                            <select name="user_type" class="form-control english">
                                <option value="admin">admin</option>
                                <option value="staff">staff</option>
                            </select>
                            @error('name')
                            الرجاء الإختيار من القائمة فقط
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class='text-danger'>*</i> كلمة المرور </label>
                            <input type="password" class="form-control" name="password" required>
                            @error('name')
                            قيمة الحقل غير صحيحة - لابد ان تتكون من 6 حروف على الأقل أو أرقام
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class='text-danger'>*</i> تأكيد كلمة المرور </label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <div class="form-group" align="center">
                            <input type="submit" class="btn btn-primary btn-lg btn-block" value="حفظ">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

    <script src="/kitchen-laravel/public/js/sweetalert2/sweetalert2.min.js"></script>
    <script src="/kitchen-laravel/public/js/sweetalert2/sweet-alerts.js"></script>

</html>
