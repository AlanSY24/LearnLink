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
    <link rel="stylesheet" href="./css/header_footer.css">
    <!-- <link rel="stylesheet" href="./css/studentCss.css"> -->


</head>

<body>
    <!-- HTML==================================================================================================== -->

    <!-- 頁首 -->
    <script src="{{asset('js/nav.js')}}"></script>
    <x-nav />
    <!-- 頁首 -->

    <div class="container clearfix">
        <aside class="sidebar">
            <h2>會員中心-學生</h2>
            <x-aside />
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

                    let html = '<h3></h3><ul>';
                    response.forEach(function(item) {
                        console.log(item);
                        if (!item.be_teacher) {
                            return; // 如果 be_teacher 為 null，則跳過
                        }

                        // 判斷收藏狀態並設置愛心圖標
                        let heartClass = item.is_favorite ? 'fas fa-heart' : 'far fa-heart';

                        html += `
                    <section class="student_container">
                        <div class="student_header">
                            <h1>${item.be_teacher.title}</h1>
                            <i id="heart" class="${heartClass}" data-id="${item.be_teacher.id}" style="color: red ;cursor: pointer;"></i>
                        </div>

                        <div class="student_info-bar">
                            <div>縣市:${item.be_teacher.city}</div>
                            <div>地區:${item.be_teacher.districts}</div>
                        </div>

                        <div class="student_info-bar">
                            <div>科目:<br>${item.be_teacher.subject}</div>
                            <div>時段:<br>${item.be_teacher.available_time}</div>
                            <div>時薪:<br>${item.be_teacher.hourly_rate}</div>
                        </div>
                        <div class="student_profile">
                            <div class="avatar">大頭貼</div>
                            <div class="description">
                                <h3 style="color: #004080 ;">自我介紹(學經歷)：</h3>
                                <p style="text-indent: 6em;">${item.be_teacher.details}</p>
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
                                <button class="btnDetailsResume">詳細履歷</button>
                                <button class="btnContactTeacher" data-teacher-id="${item.be_teacher.id}">聯絡老師</button>
                            </div>
                        </div>
                    </section>
                    `;
                    });
                    html += '</ul>';
                    $('#areaStatus').html(html);
                    // 綁定愛心圖標的點擊事件
                    $('.student_header i').on('click', function() {
                        let teacherId = $(this).data('id');
                        let item = $(this).closest('.student_container'); // 獲取點擊圖標的父容器（整個項目）
                        let icon = $(this);
                        $.ajax({
                            url: '{{ route('favorites_student.toggleFavorite') }}', // 你需要在後端設置一個路由來處理這個請求
                            type: 'POST',
                            data: {
                                teacher_id: teacherId,
                                _token: '{{ csrf_token() }}' // Laravel 的 CSRF 保護
                            },
                            success: function(response) {
                                if (response.is_favorite) {
                                    icon.removeClass('far fa-heart').addClass('fas fa-heart');
                                } else {
                                    item.addClass('hidden'); // 如果取消收藏，則從 DOM 中移除該項目
                                    icon.removeClass('fas fa-heart').addClass('far fa-heart');
                                }
                            },
                            error: function(xhr) {
                                console.error('An error occurred:', xhr);
                                alert('操作失敗，請稍後重試。');
                            }
                        });
                    });
                },
                error: function(xhr) {
                    console.error('An error occurred:', xhr);
                    $('#areaStatus').html('<p>載入收藏列表時發生錯誤aa。</p>');
                }
            });
        });
         // 綁定點擊事件處理器到所有聯絡老師的按鈕
        $(document).on('click', '.btnContactTeacher', function() {
            // 獲取教師 ID
            var beTeacherId  = $(this).data('teacher-id');
            
            // 發送 AJAX 請求
            $.ajax({
                url: '{{ route('contact_teacher.contactTeacher') }}', // 替換為實際的路由名稱
                type: 'POST',
                data: {
                    be_teacher_id: beTeacherId ,
                    _token: '{{ csrf_token() }}' // CSRF Token
                },
                success: function(response) {
                    alert('聯絡成功');
                    // 可以在這裡處理成功後的 UI 更新，例如隱藏按鈕
                    $(this).hide();
                    $(this).after('<p>聯絡成功！</p>');
                },
                error: function(xhr) {
                    console.error('發生錯誤:', xhr);
                    alert(xhr.responseJSON.message);
                }
            });
        });
        // $('.btnContactTeacher').each(function() {
        //     var beTeacherId = $(this).data('teacher-id');
        //     var button = $(this);


        //     $.ajax({
        //         url: '{{ route('contact_teacher.check') }}',
        //         type: 'GET',
        //         data: {
        //             be_teacher_id: beTeacherId,
        //             _token: '{{ csrf_token() }}'
        //         },
        //         success: function(response) {
        //             if (response.exists) {
        //                 button.hide(); // 隱藏按鈕
        //                 button.after('<p>您已經聯絡過這位老師了。</p>'); // 顯示已聯絡訊息
        //             }
        //         },
        //         error: function(xhr) {
        //             console.error('檢查聯絡狀態時發生錯誤:', xhr);
        //         }
        //     });
        // });

        // 其他按鈕功能的 AJAX 請求可根據需要進行設置
        $('#btnContact').on('click', function() {
            $.ajax({
                url: '{{ route('user.teacher_requests') }}',
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    
                    let html = '<h3></h3><ul>';
                    response.teacherRequests.forEach(function(item) {
                        console.log(item);
                        if (!item) {
                            return; // 如果 teacherRequests 為 null，則跳過
                        }


                        html += `
                    <section class="student_container">
                        <div class="student_header">
                            <h1>${item.title}</h1>
                        </div>

                        <div class="student_info-bar">
                            <div>縣市:${item.city.city}</div>
                            <div>地區:${item.districts}</div>
                        </div>

                        <div class="student_info-bar">
                            <div>科目:<br>${item.subject.name}</div>
                            <div>時段:<br>${item.available_time}</div>
                            <div>時薪:<br>${item.hourly_rate_min}-${item.hourly_rate_max}</div>
                        </div>
                        <div class="student_profile">
                            <div class="avatar">大頭貼</div>
                            <div class="description">
                                <h3 style="color: #004080 ;">自我介紹(學經歷)：</h3>
                                <p style="text-indent: 6em;">${item.details}</p>
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
                            </div>
                        </div>
                    </section>
                    `;
                             // 如果有contact_students資料
                        if (item.contact_students && item.contact_students.length > 0) {
                            html += '<h4>聯絡的學生:</h4><ul>';
                            item.contact_students.forEach(function(contact) {
                                html += `<li>${contact.user.name} - ${contact.user.email} - ${contact.user.phone}</li>
                                 <button class="btn-select" data-user-id="${contact.user.id}" data-teacher-request-id="${item.id}">選擇</button>
                                    <button class="btn-cancel" data-user-id="${contact.user.id}" data-teacher-request-id="${item.id}">取消</button>
                            `;
                            });
                            html += '</ul><br>';
                        }
                    });
                    html += '</ul>';
                    $('#areaStatus').html(html);

                        // 綁定選擇按鈕的事件處理
                    $('.btn-select').on('click', function() {
                        let userId = $(this).data('user-id');
                        let teacherRequestId = $(this).data('teacher-request-id');
                        window.open(`/LearnLink/public/calendarShow?user_id=${userId}&teacher_request_id=${teacherRequestId}`, '_blank');
                    });
                
                    // 綁定取消按鈕的事件處理
                    $('.btn-cancel').on('click', function() {
                        let userId = $(this).data('user-id');
                        let teacherRequestId = $(this).data('teacher-request-id');
                        $.ajax({
                            url: '{{ route('contact_student.remove') }}',
                            type: 'POST',
                            data: {
                                user_id: userId,
                                teacher_request_id: teacherRequestId,
                                _token: '{{ csrf_token() }}' // CSRF Token
                            },
                            success: function(response) {
                                alert('學生已被取消');
                                location.reload(); // 重新載入頁面以更新顯示
                            },
                            error: function(xhr) {
                                console.error('An error occurred:', xhr);
                                alert('操作失敗，請稍後重試。');
                            }
                        });
                    });
                    
                },
                error: function(xhr) {
                    console.error('An error occurred:', xhr);
                    $('#areaStatus').html('<p>載入收藏列表時發生錯誤aabb。</p>');
                }
            });
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

    // <!-- 抓取大頭照==================================================================================================== -->

    $(document).ready(function() {
        $.ajax({
            url: "{{ route('get.teacher.photo', ['studentId' => Auth::id()]) }}",
            type: 'GET',
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data) {
                var img = document.createElement('img');
                img.src = URL.createObjectURL(data);
                $('.avatar').html(img);
            },
            error: function() {
                $('.avatar').html('No photo available');
            }
        });
    });








    </script>


</body>

</html>