
    <div class="member-bar hidden-xs">
        <ul class="drop-down-menu">
            <li class="login-t hidden-xs"> <span>登入時間： <?php echo date("Y-m-d H:i:s");?></span></li>
            <li class="col-lg-7 col-md-5 col-sm-4 col-xs-4"></li>
            <li class="member-info "><a href="#">操作手冊<span class="icon-a"></span></a>
                <ul>
                    <li> <a href="#">操作手冊</a></li>
                    <li> <a href="#">操作手冊</a></li>
                    <li> <a href="#">操作手冊</a></li>
                </ul>
            </li>
            <li class="member-info"><span class="icon-b" style="margin-right: 2px;">0<?php //echo $username+0;?></span></li>
            <li class="member-info"><a href="#"><?php echo $nick;?> 您好<span class="icon-a"></span></a>
                <ul>
                    <li> <a href="index.php">會員中心</a></li>
                    <li> <a href="<?php echo $logoutAction ?>">會員登出</a></li>
                </ul>
            </li>
        </ul>
    </div>