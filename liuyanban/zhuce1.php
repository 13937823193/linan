<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    if(isset($_POST["Submit"]) && $_POST["Submit"] == "注册")  
    {  
        $user = $_POST["username"]; 
        $psw = $_POST["password"]; 
        $psw_confirm = $_POST["confirm"]; 
        if($user == "" || $psw == "" || $psw_confirm == "") 
        { 
            echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>"; 
        }  
        else 
        {  
            if($psw == $psw_confirm) 
            { 
                $coon=mysqli_connect("127.0.0.1","root","123456");   //连接数据库 
                mysqli_select_db($coon,"test");  //选择数据库 
                mysqli_query($coon,"set names utf8"); //设定字符集  
                $sql = "select name from mytable where name = '". $user. "'"; //SQL语句 
                $result = mysqli_query($coon,$sql);    //执行SQL语句 
               
                $num = mysqli_num_rows($result); //统计执行结果影响的行数 
                if($result)    //如果已经存在该用户 
                { 
                    echo "<script>alert('用户名已存在'); history.go(-1);</script>"; 
                } 
                else    //不存在当前注册用户名称 
                { 
                    $sql_insert = "insert into mytable (name,sex) values('". $user ."','" .$psw ."')"; 
                    $res_insert = mysqli_query($coon,$sql_insert);
                    if($res_insert) 
                    { 
                        echo "<script>alert('注册成功！'); history.go(-1);</script>";
                    } 
                    else 
                    { 
                        echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>"; 
                    } 
                } 
            } 
            else 
            { 
                echo "<script>alert('密码不一致！'); history.go(-1);</script>"; 
            } 
        } 
    } 
    else 
    { 
         echo "<script>alert('提交未成功！'); history.go(-1);</script>"; 
    } 
?>