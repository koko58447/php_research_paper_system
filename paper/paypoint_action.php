<?php
include('../config.php');

$action = $_POST["action"];


if($action == 'save'){  
    $teacherid=$_SESSION['teacherid'];
    $pid=$_POST['pid'];
    $sid=$_POST['sid'];
    $topic=$_POST['topic'];
    $topiccom=$_POST['topiccom'];
    $abstract=$_POST['abstract'];
    $abstractcom=$_POST['abstractcom'];
    $introduction=$_POST['intro'];
    $introductioncom=$_POST['introcom'];
    $review=$_POST['review'];
    $reviewcom=$_POST['reviewcom'];
    $research=$_POST['research'];
    $researchcom=$_POST['researchcom'];
    $finding=$_POST['finding'];
    $findingcom=$_POST['findingcom'];
    $conclusion=$_POST['conclusion'];
    $conclusioncom=$_POST['conclusioncom'];
    $reference=$_POST['reference'];
    $referencecom=$_POST['referencecom'];

    $total=$topic+$abstract+$introduction+$review+$research+$finding+$conclusion+$reference; 
    
    $sql_check="select AID from tblresult where PaperID=$pid and TeacherID=$teacherid";   
    $result=mysqli_query($con,$sql_check) or die("SQL a Query");

    if(mysqli_num_rows($result) > 0){
        echo 'duplicate data';
    }else{
        $sql="insert into tblresult (StudentID,PaperID,TeacherID,Topic,TopicComment,Abstract,
        AbstractComment,Introduction,IntroductionComment,Literature,LiteratureComment,
        Research,ResearchComment,Finding,FindingComment,Conclusion,ConclusionComment,
        Reference,ReferenceComment,Total) values ($sid,$pid,$teacherid,'{$topic}','{$topiccom}','{$abstract}',
        '{$abstractcom}','{$introduction}','{$introductioncom}','{$review}','{$reviewcom}',
        '{$research}','{$researchcom}','{$finding}','{$findingcom}','{$conclusion}','{$conclusioncom}',
        '{$reference}','{$referencecom}','{$total}')";
       
        if(mysqli_query($con,$sql)){

            echo 1;

        }else{
            echo 0;
        }

    }


}


?>