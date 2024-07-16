<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>找老師履歷</title>
    <style>
        
        .teacher_lists_container{
            display: flex;
        }

        .t_search{
            width: 35%;
            background-color: antiquewhite;
        }

        .t_lists{
            width: 60%;
            margin-left: 20px;
        }

    </style>
</head>
<body>
    <h1>老師履歷列表</h1>

    <div class="teacher_lists_container">

        <div class="t_search">
        <h2>尋找老師</h2>
            <div class="t_search_subject">
                <p>請選擇想學的科目：</p>
                <select name="subject" id="subject">
                    <!-- 撈資料庫 科目 -->
                    <option value="0">請選擇</option>
                    <option value="1">國文</option>
                    <option value="2">英文</option>
                    <option value="3">數學</option>
                    <option value="4">自然</option>
                </select>
            </div>

            <div class="t_search_money"> 
            <p>請選擇上課預算(小時)：</p>
                <div class="price-input"> 

                    <div class="price-field"> 
                        <span>最低預算</span> 
                        <input type="number" class="min-input" value="100"> 
                    </div> 

                    <div class="price-field"> 
                        <span>最高預算</span> 
                        <input type="number" class="max-input" value="100000"> 
                    </div>
                    <!-- 要在加判斷，不可以低於 100 不可以高於 100000，min 不可以大於等於 max  -->
                </div>
            </div>

            <div class="t_search_place">
                <p>請選擇上課地點：</p>
                <div class="city">
                    <select name="city" id="city">
                        <option value="0">請選擇縣/市</option>
                        <option value="1">台北市</option>
                        <option value="2">新北市</option>
                        <option value="3">台中市</option>
                        <!-- 添加更多縣市選項 -->
                    </select>
                </div>
                <div class="district">
                    <select name="city" id="city">
                        <option value="0">請選擇 區</option>
                        <option value="1">台北市</option>
                        <option value="2">新北市</option>
                        <option value="3">台中市</option>
                        <!-- 添加更多區選項 -->
                    </select>
                </div>
            </div>

            <div class="t_search_time">
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
        
        <div class="t_lists">

            <div class="t_lists_block">
                
                <div id="t_lists_title"><h2>國小三年級數學</h2></div>
                <div>收藏</div><!-- 可以點選互動 -->
                <div id="t_lists_subject">教學的科目：數學</div>
                <div id="t_lists_name">姓名：王XX</div>
                <div id="t_lists_gender">性別：女</div>
                <div id="t_lists_place">上課預期地點：台中北屯區</div>
                <div id="t_lists_time">上課預期時間：上午</div>
                <div id="t_lists_price">上課預期時薪：300 - 400</div><!-- 抓資料庫 min - max -->
                <div id="t_lists_picture">大頭貼</div>
                <div id="t_lists_score">評分</div><!-- 可以點選互動 -->
                <div id="t_lists_describe">關於老師的詳細描述：1. 有耐心 2. 有5年以上家教經驗</div>
                <div class="t_lists_buttons">
                    <button class="button">老師履歷</button><!-- 點選後跳出另一分頁 顯示老師詳細履歷 -->
                    <button class="button">聯絡老師</button><!-- 點選後跳出聊天室暫定 -->
                </div>
            </div>


        </div>




    </div>
</body>
</html>