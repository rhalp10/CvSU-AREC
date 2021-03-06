﻿<?php 
    include('../session.php');
    include('dash-global-function.php');

   
    $pagename = "Biogas Mapper";
    $username = $_SESSION['user_Name'];
    $script_for_specific_page = "";
    $user_img = "../assets/images/user.png";
    $user_email = "mail@gmail.com";
    if(isset($_SESSION['login_level']) )
    {      
        $login_level = $_SESSION['login_level'];
        if ($login_level != 2) {
         
          header('location: error404.php');
        }
         
    }

    if (empty($_REQUEST['page'])) {
        $page = "";
    }
    else{
        $page = $_REQUEST['page'];
    }
?>

<!DOCTYPE html>
<html>

 <?php
    include("dash-head.php");
    ?>

<body class="theme-green ">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <?php 
        include('dash-topnav.php');
    ?>
    <section>
        <?php 
        include("dash-sidenav-left.php");
        ?>

    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Biogas Data Mapper
                </h2>
            </div>

            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="index"><i class="material-icons">home</i> Home</a></li>
                <li  class="active"><a href="javascript:void(0);"><i class="material-icons ">map</i> Biogas Mapper</a></li>
            </ol>
            <div class="row clearfix">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="card">
                               <div class="header">
                                   <h2>LIST OF BIOGAS</h2>
                                   <div class="btn-group pull-right">
                                   <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#largeModal">BIOGAS MAPPER</button>
                                   <button type="button" class="btn btn-info waves-effect reload_table">RELOAD TABLE</button>
                                      <button type="button" class="btn btn-primary" id="proj_print">PRINT</button>
                                  
                                    </div>
                                  <input type="hidden" name="filter_Search" id="filter_Search" value="">
                                   <br>
                               </div>
                               <div class="body">
                                   <div class="table-responsive" style="overflow-x: hidden;">
                                       <table id="biogas_data" class="table table-bordered table-striped">
                                           <thead>
                                               <tr>
                                                   <th width="10%">ID</th>
                                                   <th width="35%">Title</th>
                                                   <th width="35%">Mark Visibility</th>
                                                   <th width="10%">Action</th>
                                               </tr>
                                           </thead>
                                       </table>
                                       
                                   </div>
                               </div>
                           </div>
                    </div>
            </div>   
          <!--    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <iframe src="map/user-map.php" style=" display:block; width:100%; height: 800px;"></iframe>
                    </div>
                </div> -->
          
        </div>

    </section>

<!-- Large Size -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-cyan">
                <h4 class="modal-title" id="largeModalLabel">MAP</h4>
            </div>
            <div class="modal-body">
                <i>Note: Right Click For Mark and Left Click For Remove </i> 
               <iframe src="map/user-map.php" style=" display:block; width:100%; height: 800px;"></iframe>
            </div>
            <div class="modal-footer " style="background-color: #e4e4e4;">
                <button type="button" class="btn btn-link btn-danger waves-effect" data-dismiss="modal" style=" color: white;">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<div id="biogas_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="biogas_form" enctype="multipart/form-data" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title list_biogas">Modal title</h4>
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="loc_title">Title</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                 <input type="text" name="loc_title" id="loc_title" class="form-control" />
                            </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="loc_descr">Description</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <textarea name="loc_descr" id="loc_descr" class="form-control"></textarea>
                                </div>
                            </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="loc_stat">Active</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                     <select class="form-control" name="loc_stat" id="loc_stat" >
                                      <option value="null">~~SELECT~~</option>
                                        <option value="1">Show</option>
                                        <option value="0">Hide</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="location_id" id="location_id" />
                    <input type="hidden" name="operation" id="operation" />
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Edit" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Large Size -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-cyan">
                <h4 class="modal-title" id="largeModalLabel">MAP</h4>
            </div>
            <div class="modal-body">
                <i>Note: Right Click For Mark and Left Click For Remove </i> 
               <iframe src="map/user-map.php" style=" display:block; width:100%; height: 800px;" id="iframe_map_cont"></iframe>
            </div>
            <div class="modal-footer " style="background-color: #e4e4e4;">
                <button type="button" class="btn btn-link btn-danger waves-effect" data-dismiss="modal" style=" color: white;">CLOSE</button>
            </div>
        </div>
    </div>
</div>

    <!-- Jquery Core Js -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../assets/plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="../assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="../assets/js/admin.js"></script>
    <script src="../assets/js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="../assets/js/demo.js"></script>
    <script type="text/javascript" language="javascript" >
$(document).ready(function(){


$(document).on('click', '#proj_print', function(){
          var filter_Search = $('#filter_Search').val();
        
          window.open('../assets/fpdf181/print?report=Biogas&filter='+filter_Search);
      });
    var dataTable = $('#biogas_data').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url:"datatable/biogas/fetch.php",
            type:"POST"
        },
        "columnDefs":[
            {
                "targets":[0],
                "orderable":false,
            },
        ],
    //    dom: 'Bfrtip',
    //      "buttons": [
    //     {
    //         extend: 'print',
    //         text: 'Print',
    //         autoPrint: true,
    //         exportOptions: {
    //             columns: ':visible',
    //         },
    //         customize: function (win) {
    //             $(win.document.body).find('table').addClass('display').css('font-size', '9px');
    //             $(win.document.body).find('tr:nth-child(odd) td').each(function(index){
    //                 $(this).css('background-color','#D0D0D0');
    //             });
    //             $(win.document.body).find('h1').css('text-align','center');
    //             $(win.document.body).find( 'table' ).find('td:last-child, th:last-child').remove();
    //         }
    //     }
    // ],

    });
    $(document).on('submit', '#biogas_form', function(event){
        event.preventDefault();
        var loc_title = $('#loc_title').val();
        var loc_descr = $('#loc_descr').val();
        
        if(loc_title != '' && loc_descr != '')
        {
            $.ajax({
                url:"datatable/biogas/insert.php",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    alert(data);
                    $('#biogas_form')[0].reset();
                    $('#biogas_modal').modal('hide');
                    dataTable.ajax.reload();
                }
            });
        }
        else
        {
            alert("Both Fields are Required");
        }
    });

    

    $(document).on('click', '.update', function(){
        var location_id = $(this).attr("id");
        $.ajax({
            url:"datatable/biogas/fetch_single.php",
            method:"POST",
            data:{location_id:location_id},
            dataType:"json",
            success:function(data)
            {
                $('#biogas_modal').modal('show');
                $('#loc_title').val(data.loc_title);
                $('#loc_descr').val(data.loc_descr);
                $('.list_biogas').text("Edit Biogas Info");
                $('#location_id').val(location_id);
                $('#action').val("Edit");
                $('#operation').val("Edit");
            }
        })
    });
    
    $(document).on('click', '.delete', function(){
        var location_id = $(this).attr("id");
        if(confirm("Are you sure you want to delete this?"))
        {
            $.ajax({
                url:"datatable/biogas/delete.php",
                method:"POST",
                data:{location_id:location_id},
                success:function(data)
                {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        }
        else
        {
            return false;   
        }
    });
    
    $(document).on('click', '.reload_table', function(){
        dataTable.ajax.reload();
        document.getElementById('iframe_map_cont').contentWindow.location.reload();
    });
    
    
});
 $('#biogas_data').on('search.dt', function() {
              var value = $('.dataTables_filter input').val();
              console.log(value);
              $('#filter_Search').val(value);
          });
       $(document).on('click', '#notif_seen', function(){
   
       
        $.ajax({
          url:"notif_seen.php",
          method:"POST",
          success:function(data)
          {
            $('#label_count').html('0');
          }
        });
    
  
  });
       

 $(document).on('click', '#cl_acc', function(){
      
     $.ajax({
        url:"notif_seen1.php",
        type:"POST",
        data:{account:1},
        success:function(data)
        {
      
        }
      });
  });
   
$(document).on('click', '#cl_news', function(){
    
    $.ajax({
        url:"notif_seen1.php",
        type:"POST",
        data:{news:1},
        success:function(data)
        {
      
        }
      });
    

  });
$(document).on('click', '#cl_sugg', function(){
    
    $.ajax({
        url:"notif_seen1.php",
        type:"POST",
        data:{suggest:1},
        success:function(data)
        {
      
        }
      });
  });
$(document).on('click', '#cl_res', function(){
    
    $.ajax({
        url:"notif_seen1.php",
        type:"POST",
        data:{research:1},
        success:function(data)
        {
      
        }
      });
  });
$(document).on('click', '#cl_proj', function(){
    $.ajax({
        url:"notif_seen1.php",
        type:"POST",
        data:{project:1},
        success:function(data)
        {
      
        }
      });
  });
$(document).on('click', '#cl_bio', function(){
      $.ajax({
        url:"notif_seen1.php",
        type:"POST",
        data:{biogas:1},
        success:function(data)
        {
      
        }
      });
  });




</script>
</body>

</html>
