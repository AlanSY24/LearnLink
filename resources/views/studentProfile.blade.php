<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員中心-學生</title>
    <!-- 引入 jQuery  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- 引入 Font Awesome 字體圖標庫  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- 引入Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- 引入Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- 引入Flatpickr 中文语言包 -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/zh.js"></script>


    <!-- 導入CSS(會員中心老師.css) -->
    <link rel="stylesheet" href="./css/member.css">
    <!-- <link rel="stylesheet" href="./css/studentCss.css"> -->


</head>

<body>
    <!-- HTML==================================================================================================== -->

    <!-- 頁首 -->
    <header>

    </header>
    <!-- 頁首 -->

    <div class="container clearfix">
        <aside class="sidebar">
            <h2>會員中心-學生</h2>
            <ul>
                <li><a href="#">基本資料</a></li>

                <li><a href="#">老師</a>
                    <a href="#" style="font-size: x-small;">評分</a> 
                </li>
                <li>
                    <a href="#">學生</a>
                    <a href="#" style="font-size: x-small;">家長</a>
                </li>
            </ul>
        </aside>
        <main>
            <section class="container">
            @include('partials.studentprofile')
            </section>



            <section class="case-management">
                <h2>接案管理</h2>
                <button id="btnFavorite">收藏</button>
                <button id="btnContact">被學生/家長連絡</button>
                <button id="btnProgress">已接案(預定中)</button>
                <button id="btnSchedule">課表</button>
                <button id="btnRecord">紀錄表</button>


                <!-- 顯示數據的區域 -->
                <div id="areaStatus"></div>
                <!-- 顯示數據的區域 -->
            </section>




        </main>
    </div>


    <!-- 頁尾 -->
    <x-footer_alpha />
    <!-- 頁尾 -->




    <!-- 上傳隱藏表單==================================================================================================== -->


    <!-- 被老師連絡表(V)(X)-->
    <div id="formConfirm" class="container-confirm hidden">
        <div class="container-form">
            <form id="confirmFormData">
                <h2>(B01)國小三年級數學</h2>
                <div class="input-group">
                    <label for="datePicker">日期</label>
                    <input type="text" id="datePicker" name="date">
                </div>
                <div class="input-group">
                    <label for="time">時間</label>
                    <select id="time" name="time">
                        <option value="00:00">00:00</option>
                        <option value="01:00">01:00</option>
                        <option value="02:00">02:00</option>
                        <option value="03:00">03:00</option>
                        <option value="04:00">04:00</option>
                        <option value="05:00">05:00</option>
                        <option value="06:00">06:00</option>
                        <option value="07:00">07:00</option>
                        <option value="08:00">08:00</option>
                        <option value="09:00">09:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="12:00">12:00</option>
                        <option value="13:00">13:00</option>
                        <option value="14:00">14:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                        <option value="17:00">17:00</option>
                        <option value="18:00">18:00</option>
                        <option value="19:00">19:00</option>
                        <option value="20:00">20:00</option>
                        <option value="21:00">21:00</option>
                        <option value="22:00">22:00</option>
                        <option value="23:00">23:00</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="location">詳細地點</label>
                    <br>
                    <input type="text" id="location" name="location">
                </div>

                <div>
                    <button id="btnSubmitformConfirm" type="submit">送出</button>
                </div>
            </form>
            <!-- 右上角的關閉按鈕 -->
            <button id="btnCloseFormConfirm" class="close-button">&times;</button>

        </div>

    </div>





    <!-- <script src="./js/studentprofile.js"></script> -->
    <script>
    $(document).ready(function() {
        $('#btnFavorite').on('click', function() {
        $.ajax({
            url: '{{ route('favorites_student.studentFavorite') }}',
            type: 'GET',
            success: function(response) {
                
                let html = '<h3>我的收藏</h3><ul>';
                response.forEach(function(item) {
                    console.log(item);
                    if (!item.be_teacher) {
                        return; // 如果 be_teacher 為 null，則跳過
                    }

                    // 生成 districts 列表

                    html += `
                <section class="student_container">
                    <div class="student_header">
                        <h1>${item.be_teacher.title}</h1>
                        <i id="heart" class="far fa-heart" style="color: red ;"></i>
                    </div>
                    <div class="student_info-bar">
                        <div>${item.be_teacher.subject}</div>
                        <div>${item.be_teacher.city}</div>
                        <div>${item.be_teacher.available_time}</div>
                        <div>${item.be_teacher.hourly_rate}</div>
                        <div>${item.be_teacher.districts}</div>
                    </div>
                    <div class="student_profile">
                        <div class="avatar">大頭貼</div>
                        <div class="description">
                            <p>自我介紹(學經歷)</p>
                        </div>
                    </div>
                    <div class="student_buttons">
                        <div class="rating">
                            <span>★</span>
                            <span>★</span>
                            <span>★</span>
                            <span>★</span>
                            <span>★</span>
                        </div>
                        <div class="student_btn">
                            <button id="btnDetailsResume">詳細履歷</button>
                            <button id="btnContactTeacher">聯絡老師</button>
                        </div>
                    </div>
                </section>
                `;
                });
                html += '</ul>';
                $('#areaStatus').html(html);
            },
            error: function(xhr) {
                console.error('An error occurred:', xhr);
                $('#areaStatus').html('<p>載入收藏列表時發生錯誤aa。</p>');
            }
        });
    });


        // 其他按鈕功能的 AJAX 請求可根據需要進行設置
        $('#btnContact').on('click', function() {
            $('#areaStatus').html('<p>顯示被學生/家長連絡的內容</p>');
        });

        $('#btnProgress').on('click', function() {
            $('#areaStatus').html('<p>顯示已接案(預定中)的內容</p>');
        });

        $('#btnSchedule').on('click', function() {
            $('#areaStatus').html('<p>顯示課表的內容</p>');
        });

        $('#btnRecord').on('click', function() {
            $('#areaStatus').html('<p>顯示紀錄表的內容</p>');
        });
    });

    </script>


</body>

</html>