<!DOCTYPE html>
<<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/octicons/3.1.0/octicons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
      <div class="container">
      <hr />
      <a href="index.php">Начало </a> |
      <a href="profile.php">Профил</a> |
      <a href="add_entrance.php">Добави Вход</a> |
      <a href="add_apartment.php">Добави Апартамент</a> |  Дата: <b>
      <script>
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth()+1;
      var yyyy = today.getFullYear();
      if(dd<10) {
          dd='0'+dd
      }

      if(mm<10) {
        mm='0'+mm
      }
      var today = mm+'/'+dd+'/'+yyyy;
      document.write(today);
      </script>
      </b>
      <hr />
      <a href="entrance.php">Обратно</a>
      <hr />
      <div class="container">
          <div class="row col-md-12 custyle">
              <h2><a href="">сем. Иванови </a></h2>
              <div class="col-md-12">
              <div class = "panel panel-primary">
                <div class = "panel-heading">
                  <a data-toggle="collapse" style="color:#fff;">
                  <h3 class="panel-title">
                      <i class="fa fa-home fa-lg" aria-hidden="true"></i>
                      <div class="pull-right"><p class="text-right">
                          <a href="#" data-toggle="modal" data-target="#editApp" style="color:#fff;">Редактирай</a>
                      </div>
                  </h3>
                </div>
                <divclass="panel">

                  <div class = "panel-body">
                      <h2>Състояние: <font style="color:green;">Платено за този месец</font></h2>
                      <hr />
                      <p style="font-size:24px;"><b>Такси за {Този месец}</b></p>
                      <div class="form-group">
                          <table class="table table-condensed table-bordered">
                            <thead>
                              <tr>
                                  <th class="hidden-xs">Такси</th>
                                  <th class="hidden-xs">Пари</th>
                                  <th class="hidden-xs"></th>
                              </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                      <td>
                                        Асансьор
                                      </td>
                                      <td>
                                        2лв.
                                      </td>
                                      <td>
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        Вход
                                      </td>
                                      <td>
                                        2лв.
                                      </td>
                                      <td>
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        Дом.люб.
                                      </td>
                                      <td>
                                        2лв.
                                      </td>
                                      <td>
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        Чистачка
                                      </td>
                                      <td>
                                        2лв.
                                      </td>
                                      <td>
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                      </td>

                                    </tr>
                                    <tr>
                                      <td>
                                        Електричество
                                      </td>
                                      <td>
                                        2лв.
                                      </td>
                                      <td>
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        Допълнителни
                                      </td>
                                      <td>
                                        2лв.
                                      </td>
                                      <td>
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                      </td>
                                    </tr>
                                    <tr>
                                        <td><b>Общо</b></td>
                                        <td><b>12лв.</b></td>
                                        <td></td>
                                    </tr>
                                  </tbody>
                          </table>
                          <hr>
                          <p><b>Отчети</b></p>
                          <table class="table table-condensed table-bordered">
                              <tr>
                                <td style="background-color:green;color:#fff">
                                  <h6>ян.</h6>
                                </td>
                                <td style="background-color:green;color:#fff">
                                  <h6>февр.</h6>
                                </td>
                                <td style="background-color:green;color:#fff">
                                  <h6>март</h6>
                                </td>
                                <td style="background-color:green;color:#fff">
                                  <h6>апр.</h6>
                                </td>
                                <td style="background-color:green;color:#fff">
                                  <h6>май</h6>
                                </td>
                                <td style="background-color:green;color:#fff">
                                  <h6>юни</h6>
                                </td>
                                <td style="background-color:green;color:#fff">
                                  <h6>юли</h6>
                                </td>
                                <td style="background-color:green;color:#fff">
                                  <h6>авг.</h6>
                                </td>
                                <td style="background-color:green;color:#fff">
                                  <h6>септ.</h6>
                                </td>
                                <td style="background-color:white;color:#000">
                                  <h6>окт.</h6>
                                </td>
                                <td style="background-color:white;color:#000">
                                  <h6>ноем.</h6>
                                </td>
                                <td style="background-color:white;color:#000">
                                  <h6>дек.</h6>
                                 </td>
                              </tr>

                          </table>
                          <hr>
                          <p><b>Допълнителна информация:</b></p>
                          <div class="well">
                              <i>няма</i>
                          </div>
                          <hr>
                          <table class="table table-condensed table-bordered">
                            <thead>
                              <tr>
                                  <th class="hidden-xs">Инфо</th>
                              </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                      <td>
                                        Име
                                      </td>
                                      <td>
                                        <i class="fa fa-phone" aria-hidden="true"></i> <b>Иван Стоянов</b>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        Телефон за връзка
                                      </td>
                                      <td>
                                        <i class="fa fa-phone" aria-hidden="true"></i> <b>08896831</b>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                         Уникален код
                                      </td>
                                      <td>
                                        <i class="fa fa-barcode" aria-hidden="true"></i> <b>1EB328 </b>
                                      </td>
                                    </tr>
                                </tbody>
                            </table>
                      </div>
                  </div>

                  <div class="panel-footer">
                      <div class="pull-right">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Отчети</button>
                      </div>
                      <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>
              <hr />
          </div>
      </div>

    <script src="https://cdn.jsdelivr.net/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
