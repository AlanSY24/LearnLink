<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>找學生案件</title>
    <style>
    
    .student_cases_container{
        display: flex;
    }

    .s_search{
        width: 35%;
        background-color: antiquewhite;
    }

    .s_cases{
        width: 60%;
        margin-left: 20px;
    }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var heartIcon = document.getElementById('heart');
            var isFavorite = false; // 初始收藏狀態為 false

            if (heartIcon) {
                heartIcon.addEventListener('click', function() {
                    if (!isFavorite) {
                        // 切換為實心愛心，紅色填充
                        heartIcon.classList.remove('far');
                        heartIcon.classList.add('fas');
                        heartIcon.style.color = '#ed1212';
                        isFavorite = true;
                        addToFavorites();
                    } else {
                        // 切換為空心愛心，紅色框框
                        heartIcon.classList.remove('fas');
                        heartIcon.classList.add('far');
                        heartIcon.style.color = 'red';
                        isFavorite = false;
                        removeFromFavorites();
                    }
                });
            }
        });

        function addToFavorites() {
            console.log('已將愛心添加到收藏夾');
            // 在這裡可以添加將愛心圖示加入到收藏夾的相應邏輯
        }

        function removeFromFavorites() {
            console.log('已將愛心從收藏夾移除');
            // 在這裡可以添加將愛心圖示從收藏夾移除的相應邏輯
        }
    </script>
</head>
<body>
    <h1>學生案件列表</h1>

    <div class="student_cases_container">

        <div class="s_search">
        <h2>尋找學生</h2>
            <div class="s_search_subject">
                <p>請選擇教學的科目：</p>
                <select name="subject" id="subject">
                    <!-- 撈資料庫 科目 -->
                    <option value="0">請選擇</option>
                    <option value="1">國文</option>
                    <option value="2">英文</option>
                    <option value="3">數學</option>
                    <option value="4">自然</option>
                </select>
            </div>

            <div class="s_search_money"> 
            <p>請選擇上課預期薪資(時薪)：</p>
                <div class="price-input"> 

                    <div class="price-field"> 
                        <span>最低預期</span> 
                        <input type="number" class="min-input" value="100"> 
                    </div> 

                    <div class="price-field"> 
                        <span>最高預期</span> 
                        <input type="number" class="max-input" value="100000"> 
                    </div>
                    <!-- 要在加判斷，不可以低於 100 不可以高於 100000，min 不可以大於等於 max  -->
                </div>
            </div>

            <div class="s_search_place">
                <p>請選擇上課地點：</p>
                <div class="city">
                    <p>請選擇縣/市：</p>
                    <select name="city" id="city">
                        <option value="0">請選擇縣/市</option>
                        <option value="1">台北市</option>
                        <option value="2">新北市</option>
                        <option value="3">台中市</option>
                        <!-- 添加更多縣市選項 -->
                    </select>
                </div>
                <div class="district">
                    <p>請選擇 區：</p>
                    <select name="city" id="city">
                        <option value="0">請選擇 區</option>
                        <option value="1">台北市</option>
                        <option value="2">新北市</option>
                        <option value="3">台中市</option>
                        <!-- 添加更多區選項 -->
                    </select>
                </div>
            </div>

            <div class="s_search_time">
                <p>請選擇預期上課時間：</p>
                <select name="time" id="time">
                    <option value="0">請選擇上課時間</option>
                    <option value="1">上午</option>
                    <option value="2">下午</option>
                    <option value="3">晚上</option>
                    </select>
                </select>
            </div>

        </div>
        
        <div class="s_cases">

            <div class="s_cases_block">
                
                <div id="t_lists_title"><h2>國小三年級數學</h2></div>
                <i id="heart" class="far fa-heart" style="color: red;"></i>
                <div id="t_lists_subject">教學的科目：數學</div>
                <div id="t_lists_name">姓名：王XX</div>
                <div id="t_lists_gender">性別：女</div>
                <div id="t_lists_place">上課預期地點：台中北屯區</div>
                <div id="t_lists_time">上課預期時間：上午</div>
                <div id="t_lists_price">上課預期時薪：300 - 400</div><!-- 抓資料庫 min - max -->
                <div id="t_lists_describe">關於學生的詳細描述：1. 需要多點耐心 2. 主要以輔導學校數學作業為主</div>
                <div class="button-container">
                    <button class="button">聯絡我</button><!-- 點選後跳出聊天室暫定 -->
                </div>
            </div>


        </div>




    </div>
</body>
</html>