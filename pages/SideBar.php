<?php

declare(strict_types=1);
include_once("../helpers/AccountRepository.php");

$activeSessionUser = $_SESSION["user_id"];
$acRepo = new AccountRepository();

$activeUserId = 4;
?>
<div class="sidebar-ctn">
    <div class="fixed">
        <div class="sidebar-flex-container">
            <div class="side-nav-bar-ctn">
                <div class="home-logo">
                    <a href="./home.html"><img class="home-icon" src="./images/dXsLogo.svg" width="150px" alt="LOGO" style="object-fit: contain;"></a>
                </div>
                <div class="nav-sidebar-ctn">
                    <nav class="nav-sidebar">
                        <div class="nav-elem-ctn">
                            <a href="./home.html" class="side-nav-row"><img src="images/home.svg" alt="home"><span class="home-nav nav-text">Home</span></a>
                        </div>
                        <div class="nav-elem-ctn">
                            <a href="" class="side-nav-row"><img src="images/search.svg" alt="explore">
                                <div class="nav-text">Explore</div>
                            </a>
                        </div>
                        <div class="nav-elem-ctn">
                            <a href="" class="side-nav-row"><img src="images/notifications.svg" alt="notifications"><span class="nav-text">Notifications</span></a>
                        </div>
                        <div class="nav-elem-ctn">
                            <a href="" class="side-nav-row"><img src="images/messages.svg" alt="messages"><span class="nav-text">Messages</span></a>
                        </div>
                        <div class="nav-elem-ctn">
                            <a href="" class="side-nav-row"><img src="images/litsts.svg" alt="lists"><span class="nav-text">Lists</span></a>
                        </div>
                        <div class="nav-elem-ctn">
                            <a href="" class="side-nav-row"><img src="images/bookmarks.svg" alt="bookmarks"><span class="nav-text">Bookmarks</span></a>
                        </div>
                        <div class="nav-elem-ctn">
                            <a href="./profile.html" class="side-nav-row"><img src="images/profile.svg" alt="profile"><span class="nav-text">Profile</span></a>
                        </div>
                        <div class="nav-elem-ctn">
                            <input class="post-btn" id="sidebar-post-btn" type="button" value="Post">
                        </div>
                    </nav>
                </div>

            </div>
            <div class="profile-card-sidebar">
                <div class="profile-card-left-side">
                    <div>
                        <img class="profile-pic" src="images/defaultProfile1.svg" alt="default profile pic">
                    </div>
                    <div class="name-usrn-ctn">
                        <span class="profile-card-nickname"><?php echo ($acRepo->getAccountFieldById($activeSessionUser, "emri")) ?></span>
                        <div class="profile-card-username"><?php echo ("@" . $acRepo->getAccountFieldById($activeSessionUser, "pseudonimi")) ?></div>
                    </div>
                </div>
                <div class="profile-card-options">
                    <img src="images/threedots.svg" alt="options">
                </div>
            </div>
        </div>

    </div>
</div>