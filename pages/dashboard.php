<?php
include '../controllers/protected.php'
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/dashboard.css">
    <title>Document</title>

</head>

<body>
    <div class="menu-nav-bar">
        <img id="comments-icon-dashboard" src="../pages/images/dXsLogo.svg" alt="comments-dashboard" width="60px">

        <div class="menu-nav-links">
            <div class="nav-link"> <img src="../pages/images/user-large-dashboard.svg" alt="user-large" width='25px'>
                <span class='nav-link-span'> Dashboard</span>
            </div>
            <div class="nav-link">
                <img src="../pages/images/diagram-project-dashboard.svg" alt="diagram" width="25px">
                <span class='nav-link-span'>Tweet tracker</span>
            </div>
            <div class="nav-link">
                <img src="../pages/images/followers-dashboard.svg" alt="followers icon" width="25px">
                <span class='nav-link-span'>Followers</span>
            </div>
            <div class="nav-link">
                <img src="../pages/images/calendar-day-dashboard.svg" alt="calendar icon" width="25px">
                <span class='nav-link-span'>Tweets schedule</span>
            </div>
            <div class="nav-link">
                <img src="../pages/images/chart-line-dashboard.svg" alt="chartline icon" width='25px'>
                <span class='nav-link-span'>Tweet analytics</span>
            </div>
        </div>
    </div>
    <section class="body-section">
        <div class="body-part">
            <div class="top-menu">
                <h1 class="dashboard-header">Dashboard</h1>
                <div class="top-links">
                    <img src="../pages/images/bell-dashboard.svg" alt="bell" width="30px">
                    <img src="../pages/images/comment-dots-dashboard.svg" alt="comments icon" width="30px">
                    <img src="../pages/images/profile-default-dashboard.png" alt="profile img" width="50px"
                        style='border-radius:50%;'>
                    <img src="../pages/images/angle-down-dashboard.svg" alt="dropdown icon" width="25px">
                </div>
            </div>

            <div class="first-ctns">
                <div>
                    <div class="two-left" style="display: flex;">
                        <div class="engagement-rate-ctn">
                            <div class="black-part-ctn">
                                <div class="inner-small-ctn">
                                    <img src="../pages/images/followers-dashboard.svg" alt="check" width="70px">
                                </div>
                                <span class="engagment-header">Total users</span>
                                <span id="totalUsersCount" class="engagment-header" style="font-size:1.5rem">23</span>
                            </div>
                        </div>
                        <div class="tweets-count-ctn">
                            <div class="black-part-ctn">
                                <div class="inner-small-ctn">
                                    <img src="../pages/images/icons8-twitter-dashboard.svg" alt="check" width="70px">
                                </div>
                                <span class="engagment-header">Total tweets</span>
                                <span id="totalTweetsCount" class="engagment-header" style="font-size:1.5rem">312</span>
                            </div>
                        </div>
                    </div>
                    <div class="chart-ctn">
                        <?php include_once("chart.php"); ?>
                    </div>
                </div>
                <div class="anonuncements-ctn"></div>
            </div>
        </div>
    </section>
</body>

<script>
    fetch("../controllers/totalUsersCount.php")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('totalUsersCount').textContent = data.total_users;
                console.log(data);
            } else {
                console.error('Failed to fetch total users count');
            }
        })
        .catch(error => {
            console.error('Error fetching total users count:', error);
        });
</script>
<script>
    fetch("../controllers/totalTweetsCount.php")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('totalTweetsCount').textContent = data.total_tweets;
                console.log(data);
            } else {
                console.error('Failed to fetch total tweets count');
            }
        })
        .catch(error => {
            console.error('Error fetching total users count:', error);
        });
</script>

</html>