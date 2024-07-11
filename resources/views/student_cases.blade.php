<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="a1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>找學生案件</title>
</head>
<body>
    <h1>找學生案件</h1>
    <div class="students_case">
        <div class="search_list">

            <div class="c_subject">
                <p>請選擇教學的科目</p>
                <select name="subject" id="subject">
                    <!-- 撈資料庫 科目 -->
                    <option value="0">請選擇</option>
                    <option value="1">國文</option>
                    <option value="2">英文</option>
                    <option value="3">數學</option>
                    <option value="4">自然</option>
                </select>
            </div>

            <div class="c_money"> 
                <p>請選擇上課預算區間</p>
                <div class="price-input-container"> 
                    <div class="price-input"> 
                        <div class="price-field"> 
                            <span>最低預算</span> 
                            <input type="number" class="min-input" value="100"> 
                        </div> 
                        <div class="price-field"> 
                            <span>最高預算</span> 
                            <input type="number" class="max-input" value="10000"> 
                        </div> 
                    </div> 
                    <div class="slider-container"> 
                        <div class="price-slider"></div> 
                    </div> 
                </div> 
              
                <!-- 範圍輸入框 -->
                <div class="range-input"> 
                    <input type="range" class="min-range" min="100" max="10000" value="100" step="50"> 
                    <input type="range" class="max-range" min="100" max="10000" value="10000" step="50"> 
                </div> 
            </div> 
        
            <!-- JavaScript 代碼 -->
            <script>
                // 獲取範圍輸入框及滑動條元素
                const rangevalue = document.querySelector(".slider-container .price-slider"); 
                const rangeInputvalue = document.querySelectorAll(".range-input input"); 
        
                // 設置價格差距
                let priceGap = 50; 
        
                // 添加事件監聽器到價格輸入框元素
                const priceInputvalue = document.querySelectorAll(".price-input input"); 
                for (let i = 0; i < priceInputvalue.length; i++) { 
                    priceInputvalue[i].addEventListener("input", e => { 
        
                        // 解析範圍輸入框的最小和最大值
                        let minp = parseInt(priceInputvalue[0].value); 
                        let maxp = parseInt(priceInputvalue[1].value); 
                        let diff = maxp - minp 
        
                        // 驗證輸入值
                        if (minp < 0) { 
                            alert("最低價格不能小於 0"); 
                            priceInputvalue[0].value = 0; 
                            minp = 0; 
                        } 
        
                        if (maxp > 10000) { 
                            alert("最高價格不能大於 10000"); 
                            priceInputvalue[1].value = 10000; 
                            maxp = 10000; 
                        } 
        
                        if (minp > maxp - priceGap) { 
                            priceInputvalue[0].value = maxp - priceGap; 
                            minp = maxp - priceGap; 
        
                            if (minp < 0) { 
                                priceInputvalue[0].value = 0; 
                                minp = 0; 
                            } 
                        } 
        
                        // 檢查價格差距是否滿足，並且最高價格在範圍內
                        if (diff >= priceGap && maxp <= rangeInputvalue[1].max) { 
                            if (e.target.className === "min-input") { 
                                rangeInputvalue[0].value = minp; 
                                let value1 = rangeInputvalue[0].max; 
                                rangevalue.style.left = `${(minp / value1) * 100}%`; 
                            } else { 
                                rangeInputvalue[1].value = maxp; 
                                let value2 = rangeInputvalue[1].max; 
                                rangevalue.style.right = 
                                    `${100 - (maxp / value2) * 100}%`; 
                            } 
                        } 
                    }); 
        
                    // 添加事件監聽器到範圍輸入框元素
                    for (let i = 0; i < rangeInputvalue.length; i++) { 
                        rangeInputvalue[i].addEventListener("input", e => { 
                            let minVal = parseInt(rangeInputvalue[0].value); 
                            let maxVal = parseInt(rangeInputvalue[1].value); 
                            let diff = maxVal - minVal 
        
                            // 檢查是否超過價格差距
                            if (diff < priceGap) { 
                                if (e.target.className === "min-range") { 
                                    rangeInputvalue[0].value = maxVal - priceGap; 
                                } else { 
                                    rangeInputvalue[1].value = minVal + priceGap; 
                                } 
                            } else { 
                                // 更新價格輸入框和範圍進度
                                priceInputvalue[0].value = minVal; 
                                priceInputvalue[1].value = maxVal; 
                                rangevalue.style.left = 
                                    `${(minVal / rangeInputvalue[0].max) * 100}%`; 
                                rangevalue.style.right = 
                                    `${100 - (maxVal / rangeInputvalue[1].max) * 100}%`; 
                            } 
                        }); 
                    } 
                }
            </script>


            <div class="c_place">
                <p>請選擇上課地點</p>
                <select name="city" id="city">
                    <option value="0">請選擇縣/市</option>
                    <option value="1">台北市</option>
                    <option value="2">新北市</option>
                    <option value="3">台中市</option>
                    <!-- 添加更多縣市選項 -->
                </select>

                <select name="district" id="district">
                    <option value="0">請選擇區</option>
                </select>
            </div>

            
            <script>
                $(document).ready(function() {
                    $('#city').change(function() {
                        const cityId = $(this).val();
                        
                        if (cityId == 0) {
                            $('#district').html('<option value="0">請選擇區</option>');
                            return;
                        }
                        
                        $.ajax({
                            url: 'get_districts.php', // 你的 PHP 文件路径
                            type: 'POST',
                            data: { cityId: cityId },
                            success: function(response) {
                                const districts = JSON.parse(response);
                                let options = '<option value="0">請選擇區</option>';
                                
                                for (let i = 0; i < districts.length; i++) {
                                    options += `<option value="${districts[i].id}">${districts[i].name}</option>`;
                                }
                                
                                $('#district').html(options);
                            },
                            error: function() {
                                alert('無法加載區選項');
                            }
                        });
                    });
                });
            </script>
            
            <div class="search_time">
                <p>請選擇上課時間</p>
                <select name="time" id="time">
                    <option value="0">請選擇上課時間</option>
                    <option value="1">上午</option>
                    <option value="2">下午</option>
                    <option value="3">晚上</option>
                    </select>
                </select>
            </div>


        </div>

        <div class="students_list">
            



            <div class="students_list_block">
                <p>收藏</p><!-- 使用icon 可以點選互動 -->
                <div id="students_list_title">標題(科目)</div>
                <div id="students_list_contact">聯絡人</div>
                <div id="students_list_phone">電話</div>
                <div id="students_list_place">上課地點</div>
                <div id="students_list_price">上課預算</div><!-- 抓資料庫 min - max -->
                <div id="students_list_condition">條件</div>
                <div id="students_list_describe">描述</div>
                <button>聯絡我</button><!-- 點選後跳出聊天室暫定 -->
            </div>
            

            <div class="students_list_block">
                <p>收藏</p><!-- 使用icon 可以點選互動 -->
                <div id="students_list_title">標題(科目)</div>
                <div id="students_list_contact">聯絡人</div>
                <div id="students_list_phone">電話</div>
                <div id="students_list_place">上課地點</div>
                <div id="students_list_price">上課預算</div><!-- 抓資料庫 min - max -->
                <div id="students_list_condition">條件</div>
                <div id="students_list_describe">描述</div>
                <button>聯絡我</button><!-- 點選後跳出聊天室暫定 -->
            </div>

        </div>

        

        

    </div>
</body>
</html>