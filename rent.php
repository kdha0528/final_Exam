
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="reset.css" type="text/css" />
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
        <title>ElectroScooter</title>
    </head>
    <body>
        <?php
        session_start();
        include_once('dbconn.php');
        
        $sql = "SELECT * FROM client";
        $result = $conn->query($sql);
         // 아이디 정보 체크   
        if(isset($_SESSION['clientName'])){
            $id = $_SESSION['id'];
        }       
        $selected = "A236MM";
        ?>
        
        <nav id="navbar">
                <a href="index.php" class = "navbar_icon"> 
                    <i class="fas fa-motorcycle"></i>
                    <div style ="color: rgb(248, 248, 248); padding-left: 7px" class="logowriting"> Shin_mini</div>
                </a>
            <ul class="navbar_items">
                    <li><a class = "navbar_item" href='review.php'>REVIEW</a></li>
                <?php if(!isset($_SESSION['clientName'])){ ?>
                <li><a class="navbar_item" href="signup.php">SignUp</a></li>
                <li><a class="navbar_item" href='login.php'>LogIn</a></li>
                <?php }else{ ?>
                    <li><a class = "navbar_item" href="rent.php">RENT</a></li>
                    <li><a class="navbar_item" href='mypage.php?id=<?=$_SESSION['clientId']?>'>MyPage</a></li>
                    <li><a class="navbar_item" href='logout.php'>LogOut</a></li>
                <?php } ?>
            </ul>
        </nav>
        <section class="contain" id="rent_contain"> 
            <div class="contain_rent">
                <div class="contain_rent_box">
                    <?php $sql = "SELECT * FROM rent";
                    $result = $conn->query($sql);   // query 함수를 통해 받아온 값 result 에 저장
                    if(isset($_SESSION['b_idx'])){
                        $b_idx = $_SESSION['b_idx'];
                        $clientID = $_SESSION['clientID'];
                        $b_date = $_SESSION['b_date'];
                        $contents = $_SESSION['contents'];
                        $recommend = $_SESSION['recommend'];
                    }
                    ?>
                    <h2><?=$_SESSION['clientName']; echo"님 안녕하세요! "?></h2>

                    <?php $sql = "SELECT scooterNo, rentAble FROM electroscooter";
                    $result = $conn -> query($sql); 
                   
                    ?>
                        
                    <table class ="RentO">
                        <thead>
                            <tr>
                                <th style="width: 50%">오토바이</th>
                                <th style="width: 20%">랜트가능여부</th>
                            </tr>
                            </thead>
                            <tbody>
                        <?php while($row = $result->fetch_assoc()){ 
                            $resultRent=$row["scooterNo"];

                            ?>
                            <tr>
                                <th style="width: 50%"><a href="javascript:void(0);" onclick="select_scooter('<?= $resultRent?>');"><?= $row["scooterNo"] ?></a></th>
                                <th style="width: 20%"><?= $row["rentAble"] ?></th>
                            </tr>
                            <?php }  ?>
                        </tbody>
                    </table>
                    <form class="rent_form" action="rentproc.php" method="post" target="_self">
                        <table class="rent_info">
                            <tr>
                                <th style="width: 30%" >모델명</th>
                                <th style="width: 70%"id="scooter_type">A236MM</th>
                                <input type="hidden" name="selected" value="<?=$selected?>">
                            </tr>
                            <tr>
                                <th style="width: 30%">대여시간</th>
                                <th style="width: 70%"class="scooter_borrow"><input type="text" name="borrow"></th>
                            </tr>
                            <tr>
                                <th style="width: 30%" >반납시간</th>
                                <th style="width: 70%" class="scooter_return"><input type="text" name="return"></th>
                            </tr>
                        </table>
                        <input class="submit" type="submit" value="선택완료" style="border: none; background-color: white; color: black; margin-top: 30px" />
                    </form>
                </div>
                <img src="images/1.jpg" class="preview_scooter" id="preview_scooter">
            </div>
        </section>
                
        <footer id="footer">
            <ul class="contact">
                <li> Tel : 010-8794-3202</li>
                    <a href="https://www.instagram.com/dlwlrma/?hl=ko" target="_balnk">
                        Email : gusals121234@gmail.com
                    </a>
                </li>
                <li class="footer_git">
                    <a href="https://github.com/ShinMini" target="_balnk">
                        https://github.com/ShinMini
                    </a>
                </li>
            </ul>
            <p class="footer__description"> Web Programming final Assignment </p>
        </footer>
        <script>
            function select_scooter(scooter){
                if(scooter == "A236MM"){
                    document.getElementById('scooter_type').innerHTML = "A236MM";
                    document.getElementById('preview_scooter').src = "images/1.jpg";
                    <?php 
                    $selected = "A236MM";
                    ?>
                }else if(scooter == "A475MN"){
                    document.getElementById('scooter_type').innerHTML = "A474MN";
                    document.getElementById('preview_scooter').src = "images/2.jpg";
                    <?php 
                    $selected = "A474MN";
                    ?>
                }else if(scooter == "B663NN"){
                    document.getElementById('scooter_type').innerHTML = "B663NN";
                    document.getElementById('preview_scooter').src = "images/3.jpg";
                    <?php 
                    $selected = "B663NN";
                    ?>
                }
            }
        </script>
    </body>
</html>