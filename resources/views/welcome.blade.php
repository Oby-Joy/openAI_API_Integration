<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        *{
            margin:0;
            padding:0;
        }
        ::-webkit-scrollbar{
            width:50px;
        }
        ::-webkit-scrollbar-track{
            background: #13254c;
        }
        ::-webkit-scrollbar-thumb{
            background: #061128;
        }
    </style>
</head>
<body style="background: #05113b;">
    <div>
        <div class="container-fluid m-0 d-flex p-2">
            <div class="pl-2" style="width:40px; height:50px; font-size:180%;">
                <i class="fa fa-angle-double-left text-white mt-2"></i>
            </div>
            <div style="width: 50px; height: 50px;">
                <i class="fa fa-user" style="color:white; font-size:30px;"> </i>
            </div>
            <div class="text-white font-weight-bold ml-2 mt-2">
                OpenAI Chat Bot
            </div>
        </div>
        <div style="background: #061128; height:2px;"></div>
        <div class="container-fluid p-2" id="content-box" style="height: calc(100vh - 130px); overflow-y:scroll;">

            
        </div>
        <div class="container-fluid w-100 px-3 py-2 d-flex" style="background: #131f45; height:62px; ">
        	<div class="mr-2 pl-2" style="background:#ffffff1c; width:calc(100% - 45px); border-radius:5px; ">
                <input id="input" type="text" class="text-white" name="input" style="background:none; width:100%; height:100%; border:0; outline:none; ">
            </div>
            <div class="text-center" id="button-submit" style="background:#4acfee; height:100%; width:50px; border-radius:5px; ">
                <i class="fa fa-paper-plane text-white" aria-hidden="true" style="line-height:45px;"></i>
            </div>
        </div>
    </div>


    <script src="js/jquery.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $('#button-submit').on('click', function(){
            $value = $('#input').val();
            $('#content-box').append(`<div class="mb-2">
                            <div class="float-right px-3 py-2" style="width:270px; background: #4acfee; border-radius:10px;float:right; font-size:85%;">
                                `+$value+`
                            </div>
                            <div style="clear:both"></div>
                        </div>`);
           
               
            $.ajax({
                type: 'post',
                url: '{{url("send")}}',
                data: {
                    'input': $value
                },
                success: function(data){
                    $('#content-box').append(`<div class="d-flex mb-2">
                            <div class="mr-2" style="width:45px; height: 45px;">
                                <i class="fa fa-user" style="color:white; font-size:30px;"> </i>
                            </div>
                            <div class="text-white px-3 py-2" style="width:270px; background: #13254b; border-radius:10px; font-size:85%;">
                                `+data+`
                            </div>
                        </div>`)
                    $value = $('#input').val('');
                }
            })
        })
    </script>
    
</body>
</html>