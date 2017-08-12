<!DOCTYPE html>
<html lang="en">


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Messages / Compose
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> Messages
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <h2 class="page-header">
        New Messages
    </h2>
    <div class="row" style="max-height: 500px; overflow-y: auto;">
        <div class="col-sm-8 col-sm-offset-2 ">

            <?php
                $size = sizeof($data['allMessages']);
                   foreach ($data['allMessages'] as $message) {

                       echo" <div class=\"panel panel-default\" >
                                <div class=\"panel-heading\" id=\"". $message['messageID']."\" onclick=\"expand(this)\" >
                                    <div class=\"row\">
                                        <div class=\"col-xs-4\">
                                            <img src=\"../public/images/user-icon.png\" height=\"30\">
                                            <span id=\"user".$message['messageID']."\">". $message['userEmail'] ."</span>
                                        </div>
                                        <div class=\"col-xs-4\" style=\"margin-top:5px;\">
                                            <b>Subject: </b><span id=\"subject".$message['messageID']."\">". $message['subjectName'] ."</span>
                                        </div>
                                        <div class=\"col-xs-4 text-right\" style=\"margin-top:5px;\">
                                            <b>Date sent:</b><span style=\"margin-left:5px;\">". $message['date'] ."</span>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"panel-group\" style=\"display:none;\" id=\"expand".$message['messageID']."\">
                                    <div class=\"panel-body\">
                                        <span>
                                           ".$message['content']."
                                        </span>
                                    </div>
                                    <div class=\"panel-body\">
                                        <!--form class=\"form-group\" -->
                                            <label for=\"Reply\">Reply<i class=\"fa fa-reply\" style=\"margin-left:5px;\"></i></label>
                                            <pre><textarea class=\"form-control\" rows=\"5\" id=\"replyMessage".$message['messageID']."\" ></textarea></pre>
                                            <button id=\"click".$message['messageID']."\" class=\"btn  btn-success\" style=\"margin-top:2%;\" >Reply</button>
                                        <!--/form-->
                                    </div>
                                </div>
                            </div>";
                    }
             ?>
            <style>
                .panel-heading{
                    cursor: pointer;
                }
            </style>

        </div>
    </div>
    <h2 class="page-header">
        Compose
    </h2>
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12" style="margin-top:3%">

                <div id="subject" style="display: block;" class="col-sm-5">
                    <label style="float: left;">Subject:</label>
                    <div class="col-sm-12">
                        <input class="form-control" style="margin-left: 10px;" id="spanSubject">
                    </div>
                </div>
                <div id="messageTO" style="display: block;margin-right: 10%;" class="col-sm-5">
                    <label style="float: left;">To:</label>
                    <div class="col-sm-12">
                        <select class="form-control" style="margin-left: 10px;" id="toSubject">
                            <option>Every Customer</option>
                            <?php
                                foreach($data['allUsers'] as $user){

                                    echo "<option>$user->email</option>";

                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-12" style="margin-top: 2%;margin-bottom: 5%;">
                <pre><textarea rows="10" class="form-control" id="sendMsg"></textarea></pre>
                <br>
                <button type="submit" class="btn btn-default" id="trigger">Send</button>
            </div>
            <script>
                $("#trigger").click(function () {

                    if( $("#spanSubject").val() != "" && $("#sendMsg").val() != ""){

                        $subject  = $("#spanSubject").val();
                        $content  = $("#sendMsg").val();
                        $to  = $("#toSubject").find(":selected").text();

                        $.post
                        (
                            'Inbox/compose',
                            {
                                subject:$subject,
                                content:$content,
                                to:$to
                            }
                        ).done(function () {

                            $("#dialog").attr("title","Success");
                            $("#dialog p").html("Message successfully sent!");
                            $("#dialog").css("display","block");
                            $( function() {
                                $( "#dialog" ).dialog({
                                    buttons:{
                                        "OK":function(){
                                            $("#spanSubject").val("");
                                            $("#sendMsg").val("");
                                            $(this).dialog("close")
                                        }
                                    }
                                });
                            });
                        })
                    }
                    else{

                        $("#dialog").attr("title","Error");
                        $("#dialog p").html("Please enter a subject and/or a text in the corresponding area for the message!");
                        $("#dialog").css("display","block");
                        $( function() {
                            $( "#dialog" ).dialog({
                                buttons:{
                                    "OK":function(){
                                        $(this).dialog("close")
                                    }
                                }
                            });
                        });
                    }
                });

            </script>

            <script>

            </script>


        </div>
    </div>

    <!-- /.row -->

</div>
<!-- /.container-fluid -->

</html>
