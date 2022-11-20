<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')

    <style>
        input:not(.btn, #pro_img){
            color: black;
        }
        .img_pro{
            width: 150px;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        <div class="container-fluid page-body-wrapper">
            @include('admin.header')
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('body')
                </div>
            </div>
        </div>
    </div>
    @include('admin.scripts')
</body>

</html>
