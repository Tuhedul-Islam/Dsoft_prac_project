<!DOCTYPE html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/jquery.uploader.css') }}">
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <style rel="stylesheet">
        html,* { font-family: 'Inter'; box-sizing: border-box; }
        body { background-color: #fafafa; line-height:1.6;}
        .lead { font-size: 1.5rem; font-weight: 300; }
        .container {
            max-width: 760px;
            margin: 100px auto;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        .hidden{
            display: none;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="container" style="margin:30px auto">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-title bg-primary text-white">
                <h3 class="p-2">Add Person</h3>
            </div>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">Add New</button>
        </div>
    </div>

    <div class="row my-3">
        <div class="col-md-12">
            <div class="card card-title bg-light text-dark">
                <h3 class="p-2">Person List</h3>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>
                        Check Person
                        <button class="btn btn-sm btn-danger deleteAll">Delete All</button>
                    </th>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Full Address</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="tableData">
                @foreach($allPerson as $person)
                <tr>
                    <td><input type="checkbox" name="deletePersonArr[]" value="{{ $person->id }}"></td>
                    <td>{{ $person->unique_id }}</td>
                    <td>{{ $person->full_name }}</td>
                    <td>{{ $person->full_address }}</td>
                    <td>
                        <a href="{{ asset('images/'.$person->photo) }}">
                            <img src="{{ asset('images/'.$person->photo) }}"  width="80px" alt="Person">
                        </a>
                        {{--<img src="{{ asset('images/'.$person->photo) }}" width="80px" alt="Person"> {{ $person->full_name }}</td>--}}
                    <td>
                        <button edit="{{ $person->id }}"  class="btn btn-sm btn-primary edit">Edit</button>
                        <button delete="{{ $person->id }}" class="btn btn-sm btn-danger delete">Delete</button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-5">
                <form action="{{ url('store/person') }}" method="POST" id="idForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" name="full_name" class="form-control full_name" id="full_name" required>
                        <small id="full_name_" class="form-text text-muted hidden">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="full_address">Full Address</label>
                        <textarea name="full_address" class="form-control full_address" id="full_address" required></textarea>
                        <small id="full_address_" class="form-text text-muted hidden">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" id="demo2" name="photo" value="" required>
                        <small id="photo_" class="form-text text-muted hidden">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <img id="preview-image" width="200px">
                    </div>
                    <button type="submit" class="btn btn-primary submit" id="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

</div>



<script src="{{ asset('js/jquery.js') }}" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="application/javascript">
    let ajaxConfig = {
        ajaxRequester: function (config, uploadFile, pCall, sCall, eCall) {
            let progress = 0
            let interval = setInterval(() => {
                progress += 10;
                pCall(progress)
                if (progress >= 100) {
                    clearInterval(interval)
                    const windowURL = window.URL || window.webkitURL;
                    sCall({
                        data: windowURL.createObjectURL(uploadFile.file)
                    })
                    // eCall("上传异常")
                }
            }, 300)
        }
    }
    //$("#demo2").uploader({ajaxConfig: ajaxConfig})
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-1VDDWMRSTH"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-1VDDWMRSTH');
</script>
<script>
    try {
        fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function(response) {
            return true;
        }).catch(function(e) {
            var carbonScript = document.createElement("script");
            carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
            carbonScript.id = "_carbonads_js";
            document.getElementById("carbon-block").appendChild(carbonScript);
        });
    } catch (error) {
        console.log(error);
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>



<script type="text/javascript">
    $(document).ready(function (){
        $(".fancybox").fancybox({
            helpers: {
                buttons: {
                    position: 'top'
                },
                title: {
                    type: 'float'
                }
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#demo2').change(function(){
            let reader = new FileReader();

            reader.onload = (e) => {
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });


        $('#idForm').submit(function (e){
            e.preventDefault();
            var form = $(this);
            var actionUrl = 'store/person';
            var _token = "{{ csrf_token() }}";
            let formData = new FormData(this);
            //console.log(formData);
            // var key = 1 + Math.floor(Math.random() * 6);
            // localStorage.setItem(key,$('#full_name').val());
            $.ajax({
                type:'POST',
                url: actionUrl,
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                        this.reset();
                        alert('Data has been uploaded successfully');
                    }
                    $('#preview-image').empty();
                    //$('.modal').modal().hide();
                    reloadTabledata();
                },
                error: function(response){
                    $('#image-input-error').text(response.responseJSON.message);
                }
            });
        });

        $(document).on('click', '.delete', function (){
            var edit_id = $(this).attr('delete');

            $.ajax({
                type:'GET',
                url: '/delete/person/'+edit_id,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                        alert('Data has been Deleted successfully');
                    }
                    $('#preview-image').empty();
                    reloadTabledata();
                }
            });
        });


        $(document).on('click', '.deleteAll', function (){
            var edit_ids = $("input[name='deletePersonArr[]']").map(function(){return $(this).val();}).get();
            $.ajax({
                type:'GET',
                url: '/delete-all/person/'+edit_ids,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                        alert('Data has been Deleted successfully');
                    }
                    $('#preview-image').empty();
                    reloadTabledata();
                }
            });
        });


        function reloadTabledata(){
            $.ajax({
                type:'GET',
                url: 'persons/all',
                contentType: false,
                processData: false,
                success: (data) => {
                    if(data){
                        $('.tableData').empty();
                    }
                    $.each(data, function(i, item) {
                        $('.tableData').append(`
                            <tr>
                                <td><input type="checkbox" name="deletePersonArr[]" value="${item.id}"></td>
                                <td>${item.unique_id}</td>
                                <td>${item.full_name}</td>
                                <td>${item.full_address}</td>
                                `
                                +'<td><img src="images/'+item.photo+'" width="80px" alt="Person"></td>'+

                                `<td>
                                    <button edit="${item.id}"  class="btn btn-sm btn-primary edit">Edit</button>
                                    <button delete="${item.id}" class="btn btn-sm btn-danger delete">Delete</button>
                                </td>
                            </tr>
                        `);
                    });
                }
            });
        }

    });
</script>


</body>
</html>
