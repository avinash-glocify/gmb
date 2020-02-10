<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

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
      <div class="container">
<div class="row styling">
    <h3><strong>Bootstrap Datepicker</strong></h3><br>
    <div class='col-sm-offset-4 col-sm-4'>
      <div class="form-group">
        <div class='input-group date' id='datetimepicker1'>
          <input type='text' class="form-control input-lg" />
          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
      </div>
      <p class="help-block"><strong>Date format:</strong> yyyy-mm-dd</p>
    </div>
  </div><br>

  <div class="row">
    <pre>
      <ul>
        <h4><strong>Add External CSS</strong></h4>
        <li>//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css</li>
        <li>https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css</li>
        <li>//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css</li>
      </ul>
    </pre>
  </div><br>

  <div class="row">
    <pre>
      <ul>
        <h4><strong>Add External JavaScript</strong></h4>
        <li>//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js</li>
        <li>//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js</li>
        <li>//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js</li>
        <li>//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js</li>
      </ul>
    </pre>
  </div>

</div>
    </body>
</html>
