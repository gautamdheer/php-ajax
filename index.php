<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax Insert Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
    section {
        margin: 0 50px 0 50px;
    }

    #error-message {
        padding: 40px;
        width: 400px;
        height: 90px;
        position: absolute;
        color: #000;
        left: 38%;
        top: 14%;
    }

    #success-message {
        padding: 40px;
        width: 400px;
        height: 90px;
        position: absolute;
        color: #000;
        left: 38%;
        top: 1%;
        visibility: hidden;
    }

    #modal {
        background: rgba(0, 0, 0, 0.7);
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 100;
        display: none;
    }

    #modal-form {
        background: #fff;
        position: relative;
        left: calc(50% - 15%);
        top: 20%;
        width: 30%;
        padding: 15px;
        border-radius: 4px;
    }

    .close-btn {
        position: absolute;
        top: -11px;
        right: -6px;
        font-size: 20px;
        cursor: pointer;
        background: red;
        width: 30px;
        border-radius: 100px;
        color: #fff;
    }

    label {
        font-weight: bold;
    }

    .form-group {
        margin-bottom: 20px;
        margin-top: 20px;
    }
    .top-bar{display:flex;justify-content:center;align-content: center;height:100px}
    .top-bar h1{margin-right:30px; align-items: center;display:flex;height:100px;}
    .top-bar div{display:flex;justify-content: center; align-items: center;height:100px; width:400px;}
    .top-bar input{ width:300px;}
    
    
    </style>
</head>

<body>
    <div class="text-center">
        <section class="bg-light">
            <div class="container">
                <div class="row">
                    <div class="top-bar">
                    <h1>Php Ajax Insert</h1>
                    <div><lable>Search :- <input placeholder="Search Result...." type="text" name="s" id="search" autocomplete="off"></div>
                    </div>
                </div>
        </section>

        <section style="background:#lightyellow;">
            <div class="container p-4">
                <div class="row">
                    <form id="addForm">
                        Firstname : <input id="fname" type="text" name="fname" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Lastname : <input id="lname" type="text" name="lname" />
                        <input id="save-btn" type="submit" name="save" value="save" />
                    </form>
                </div>
                <div id="error-message"></div>
                <div id="success-message"></div>


                <div id="modal">
                    <div class="modalform" id="modal-form">
                        <div class="wrapper">
                            <h2>Edit form</h2>
                        </div>
                        <div class='close-btn'>X</div>

                    </div>
                </div>
        </section>


        <section style="background:lightblue">
            <div class="container p-4">
                <div class="row">
                    <table class="table">
                        <tbody>
                        </tbody>
                    </table>
                </div>
        </section>

    </div>

    <script src="js/jquery.js"></script>
    <script>
    $(document).ready(function() {
        function loadTable() {
            $.ajax({
                url: "ajax-load.php",
                type: "POST",
                success: function(data) {
                    $("tbody").html(data);
                }
            });
        }
        loadTable();

        $("#save-btn").on("click", function(e) {
            e.preventDefault();
            let fname = $("#fname").val();
            let lname = $("#lname").val();

            if (fname == "" || lname == "") {
                $("#error-message").html("All fields required").slideDown();
                $("#success-message").slideUp();
            } else {
                $.ajax({
                    url: "ajax-insert.php",
                    type: "POST",
                    data: {
                        firstname: fname,
                        lastname: lname
                    },
                    success: function(data2) {
                        if (data2 == 1) {
                            loadTable();
                            $('#addForm').trigger("reset");
                            $("#success-message").html("Data Successfully inserted")
                                .slideDown().addCss("visibility", "visible");
                        } else {
                            $("#error-message").html("Can't Save Record").slideDown();
                            $("#success-message").slideUp();
                        }
                    }
                });
            }
        });

        $(document).on("click", '.delete-btn', function() {
            if (confirm("Do you want to delete the record ?")) {
                let employeeId = $(this).data("id");
                let element = this;

                $.ajax({
                    url: "ajax-delete.php",
                    type: "POST",
                    data: {
                        id: employeeId
                    },
                    success: function(data3) {
                        if (data3 == 1) {
                            $(element).closest("tr").fadeOut();
                            loadTable();
                        } else {
                            $("#error-message").html("Record Not Deleted").slideDown();
                            $("#success-message").slideUp();
                        }
                    }
                });
            }
        });

        // data listing edit button functionality here
        $(document).on("click", '.edit-btn', function() {
            $("#modal").show();
            let studentID = $(this).data("eid");

            $.ajax({
                url: "load-update-data.php",
                type: "POST",
                data: {
                    id: studentID
                },
                success: function(data4) {
                    $('.modalform .wrapper').html(data4);
                }
            });
        });

        $(".close-btn").on("click", function() {
            $("#modal").hide();
        });

        // modal form save button functionality
        $(document).on("click", '.editBtn', function(e) {
            e.preventDefault();
            let stuID = $("#edit-id").val();
            let fname = $("#edit-fname").val();
            let lname = $("#edit-lname").val();

            $.ajax({
                url: "ajax-update-modal-data.php",
                type: "POST",
                data: {
                    id: stuID,
                    firstname: fname,
                    lastname: lname,
                },
                success: function(data) {
                    if (data == 1) {
                        $("#modal").hide();
                        $(".wrapper").html(data);
                        loadTable();
                    }
                }

            })

        });

        $(document).on("keyup",'#search', function(){
          let search = $(this).val();
         
          $.ajax({
                url:"ajax-search.php",
                type:"POST",
                data:{s:search},
            success:function(data){
                $("tbody").html(data);
            }
            
          });

        });

    });
    </script>
</body>

</html>