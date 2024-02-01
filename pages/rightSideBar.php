<?php 
declare(strict_types=1);
include_once("../helpers/AccountRepository.php");
include_once("../helpers/TweetRepository.php");
?>

        <div class="right-side-ctn">
            <div class="right-side-bar">
                <div class="sarch-bar">
                    <div><img src="./images/graySearch.svg" class="search-bar-svg" alt="search img"></div>
                    <div><input type="text" name="search" id="search" placeholder="Search"></div>
                </div>
                <div class="sub-premium-popup">
                    <div><h2 class="sub-header">Subscribe to Premium</h2></div>
                    <div><h5 class="sub-pgf">Subscribe to unlock new features and if eligible, receive a share of ads revenue.</h5></div>
                    <input type="button" class="post-btn sub-btn" value="Subscribe">
                </div>
                <div class="trends" id="trends-ctn">
                    <div><h2 class="sub-header trends-main-title">Trends For you</h2></div>
                    <div class="trendings-ctn">
                        <div class="trending-row">
                            <div class="trnd-ctg">
                                <div class="categori-trnd">Television · Trending</div>
                                <div class="three-dots-trnd"><img src="./images/threedots-gray.svg" alt="options"></div>
                            </div>
                            <div class="trnd-title-ctn">
                                <h4 class="trnd-title">Luffy</h4>
                            </div>        
                            <div class="trnd-stat-posts">
                                <div>31.4K posts</div>
                            </div>                    
                        </div>
                        <div class="trending-row">
                            <div class="trnd-ctg">
                                <div class="categori-trnd">Television · Trending</div>
                                <div class="three-dots-trnd"><img src="./images/threedots-gray.svg" alt="options"></div>
                            </div>
                            <div class="trnd-title-ctn">
                                <h4 class="trnd-title">Zoro</h4>
                            </div>        
                            <div class="trnd-stat-posts">
                                <div>31.4K posts</div>
                            </div>                    
                        </div>
                        <div class="trending-row">
                            <div class="trnd-ctg">
                                <div class="categori-trnd">Television · Trending</div>
                                <div class="three-dots-trnd"><img src="./images/threedots-gray.svg" alt="options"></div>
                            </div>
                            <div class="trnd-title-ctn">
                                <h4 class="trnd-title">Brook</h4>
                            </div>        
                            <div class="trnd-stat-posts">
                                <div>31.4K posts</div>
                            </div>                    
                        </div>
                        <div class="trending-row">
                            <div class="trnd-ctg">
                                <div class="categori-trnd">Television · Trending</div>
                                <div class="three-dots-trnd"><img src="./images/threedots-gray.svg" alt="options"></div>
                            </div>
                            <div class="trnd-title-ctn">
                                <h4 class="trnd-title">Chopper</h4>
                            </div>        
                            <div class="trnd-stat-posts">
                                <div>31.4K posts</div>
                            </div>                    
                        </div>
                    </div>
                    
                </div>
                <div class="follow-sug" id="follow-sug-ctn">
                    <div>
                        <h1 id="follow-sug-text">Who to follow</h1>
                    </div>
                    <div class="all-fll-sg-ctn">
                        <div class="fllw-sg-ctn">
                            <div class="user-img-name">
                                <div>
                                    <img src="./images/defaultProfile1.svg" class="profile-pic" alt="profile pic">
                                </div>
                                <div class="usr-name-ctn">
                                    <div>Name</div>
                                    <div class="profile-card-username">@drilon_ademaj</div>
                                </div>
                            </div>
                            <div><button type="button" class="post-btn post-btn-feed">Follow</button></div>
                        </div>
                        <div class="fllw-sg-ctn">
                            <div class="user-img-name">
                                <div>
                                    <img src="./images/defaultProfile1.svg" class="profile-pic" alt="profile pic">
                                </div>
                                <div class="usr-name-ctn">
                                    <div>Name</div>
                                    <div class="profile-card-username">@drilon_ademaj</div>
                                </div>
                            </div>
                            <div><button type="button" class="post-btn post-btn-feed">Follow</button></div>
                        </div>
                        <div class="fllw-sg-ctn">
                            <div class="user-img-name">
                                <div>
                                    <img src="./images/defaultProfile1.svg" class="profile-pic" alt="profile pic">
                                </div>
                                <div class="usr-name-ctn">
                                    <div>Name</div>
                                    <div class="profile-card-username">@Username</div>
                                </div>
                            </div>
                            <div><button type="button" class="post-btn post-btn-feed">Follow</button></div>
                        </div>
                    </div>
                </div>
                <div class="footer" id="footer-id">
                    Terms of Service  Privacy  Policy  Cookie Policy  Accessibility  Ads info  More  © 2023 dXS.
                </div>
            </div>
        </div>    