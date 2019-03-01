<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Portal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <h1>Question List</h1>
    <?php session_start();
include 'question_list.php';
?>
<hr>
<h1>Add Question</h1>
<form >
    <div class="form-group mb-2">
        <div class="form-group row">
        <label for="question" class="col-sm-2 col-form-label">Enter Question</label>
        <div class="col-sm-10">    <textarea class="form-control" id="question"rows="3"></textarea></div>

        </div>
        <div class="form-group row">
        <label for="question" class="col-sm-2 col-form-label">Enter Answers</label>
        <div class="col-sm-10">  <div class="form-group row"><label for="question" class="col-sm-1 col-form-label">1.</label> <input type="text" id="1"class="form-control col-sm-9" ></div>
        <div class="form-group row"><label for="question" class="col-sm-1 col-form-label">2.</label>  <input type="text" id="2"class="form-control col-sm-9" ></div>
        <div class="form-group row"> <label for="question" class="col-sm-1 col-form-label">3.</label>  <input type="text" id ="3"class="form-control col-sm-9" ></div>
        <div class="form-group row"><label for="question" class="col-sm-1 col-form-label">4.</label> <input type="text" id="4"class="form-control col-sm-9" ></div></div>

        </div>
        <div class="form-group row">
        <label for="question" class="col-sm-2 col-form-label">Select correct answer</label>
        <div class="col-sm-10">  <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="c1" value="1">
  <label class="form-check-label" for="c1">1</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="c2" value="2">
  <label class="form-check-label" for="c2">2</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="c3" value="3" >
  <label class="form-check-label" for="c3">3</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="c4" value="4" >
  <label class="form-check-label" for="c4">4</label>
</div>
        </div>
    </div>
    <div class="form-group row">
        <label for="question" class="col-sm-2 col-form-label">Enter Points</label>
        <div class="col-sm-10">  <input type="text" id="points" class="form-control col-sm-1" >
        </div>
    </div>
    </div>
    <button  class="btn btn-primary mb-2" id="question_add_button">Add</button>
</form>

<script>
    window.onload = function () {
            var v = <?php echo $_SESSION[admin] ?>;
                if(v!=1)
                window.location.replace('/php_backend_assignment/php/welcome.php');
            };
            $('#question_add_button').on('click', function(e) {
                e.preventDefault();
                var question_input=$('#question').val();
                var a1_input=$('#1').val();
                var a2_input=$('#2').val();
                var a3_input=$('#3').val();
                var a4_input=$('#4').val();
                var c=new Array(0,0,0,0);
                for(var i=0;i<4;i++){
                    if ($('#c'+(i+1)).is(":checked")) {
                        c[i]=i+1;
                  
                    }
          
                    }
                 var p_input=$('#points').val();
                $.ajax({
                    type:"post",
                    url: "/php_backend_assignment/php/question_add.php",
                    data:{
                        question:question_input,
                        a1:a1_input,
                        a2:a2_input,
                        a3:a3_input,
                        a4:a4_input,
                        c1:c[0],
                        c2:c[1],
                        c3:c[2],
                        c4:c[3],
                        p:p_input,                    
                    },
                    success:function(response){
                        
                        if (response == "true") {
                            alert("Added");
                            location.reload();
                        } else if (response == "false")
                            alert("Fill all fields");
                    }
                });
            });
</script>
</body>
</html>