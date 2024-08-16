<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員中心-老師</title>
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
    <link rel="stylesheet" href="{{ asset('css/header_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/basicinfo.css') }}">
</head>

<body>
    <!-- HTML==================================================================================================== -->

    <!-- 頁首 -->
    <script src="{{asset('js/nav.js')}}"></script>
    <x-nav />
    <!-- 頁首 -->

    <div class="container clearfix">
        
        <!-- 側邊欄位 -->
        <x-center_sidebar />
        <!-- 側邊欄位 -->


        <main>
            <section class="container">
            @include('partials.teacherprofile')
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


   <!-- 被學生/家長連絡表(V)(X)-->
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


    <script>
       $(document).ready(function() {
        $('#btnFavorite').on('click', function() {
            $.ajax({
                url: '{{ route('favorites_teacher.teacherFavorite') }}',
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    
                    let html = '<h3></h3><ul>';
                    response.forEach(function(item) {
                        console.log(item);
                        if (!item.be_teacher) {
                            return; // 如果 be_teacher 為 null，則跳過
                        }
                        if (item.be_teacher.status == 'published') {
                        // 判斷收藏狀態並設置愛心圖標
                        let heartClass = item.is_favorite ? 'fas fa-heart' : 'far fa-heart';
                        
                        html += `
                    <section class="student_container">
                        <div class="student_header">
                            <h1 style="color: #004080 ;">${item.be_teacher.title}</h1>
                            <p>${item.be_teacher.name}${item.be_teacher.gender}&nbsp;&nbsp;</p>
                            <i id="heart" class="${heartClass}" data-id="${item.be_teacher.id}" style="color: red ;cursor: pointer;"></i>
                        </div>

                        <div class="student_info-bar">
                            <div>縣市&nbsp;:&nbsp;${item.be_teacher.city}</div>
                            <div>地區&nbsp;:&nbsp;${item.be_teacher.districts}</div>
                        </div>
                        <div class="student_info-bar">
                            <div>科目&nbsp;:&nbsp;${item.be_teacher.subject}</div>
                            <div>日期&nbsp;:&nbsp;${item.be_teacher.expected_date}</div>
                            <div>時段&nbsp;:&nbsp;${item.be_teacher.available_time}</div>
                            <div>時薪&nbsp;:&nbsp;${item.be_teacher.hourly_rate_min} - ${item.be_teacher.hourly_rate_max}</div>
                        </div>
                        <div class="student_profile">
                            <div class="description">
                                <h5>自我介紹：</h5>
                                <p style="text-indent: 6em;">${item.be_teacher.details}</p>
                            </div>
                        </div>
                        <div class="student_buttons">
                            <div class="student_btn">
                                <button class="btnContactTeacher" data-teacher-id="${item.be_teacher.id}">連絡學生/家長</button>
                            </div>
                        </div>
                        <hr>
                    </section>
                    `;}
                    });
                    html += '</ul>';
                    $('#areaStatus').html(html);
                    // 綁定愛心圖標的點擊事件
                    $('.student_header i').on('click', function() {
                        let teacherId = $(this).data('id');
                        let item = $(this).closest('.student_container'); // 獲取點擊圖標的父容器（整個項目）
                        let icon = $(this);
                        
                        $.ajax({
                            url: '{{ route('favorites_teacher.toggleFavorite') }}', // 你需要在後端設置一個路由來處理這個請求
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
                url: '{{ route('contact_student.contactStudent') }}', // 替換為實際的路由名稱
                type: 'POST',
                data: {
                    teacher_requests_id: beTeacherId ,
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

        // 其他按鈕功能的 AJAX 請求可根據需要進行設置
        $('#btnContact').on('click', function() {
            $.ajax({
                url: '{{ route('user.be_teacher') }}',
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    
                    let html = '<h3></h3><ul>';
                    response.beteacher.forEach(function(item) {
                        console.log(item);
                        if (!item) {
                            return; // 如果 teacherRequests 為 null，則跳過
                        }


                        html += `
                    <section class="student_container">
                        <div class="student_header">
                            <h1 style="color: #004080 ;">${item.title}</h1>
                        </div>

                        <div class="student_info-bar">
                            <div>縣市&nbsp;:&nbsp;${item.city.city}</div>
                            <div>科目&nbsp;:&nbsp;${item.subject.name}</div>
                            <div>時薪&nbsp;:&nbsp;${item.hourly_rate}</div>
                        </div>
                    </section>
                    `;
                             // 如果有contact_students資料
                        if (item.contact_teacher && item.contact_teacher.length > 0) {
                            html += '<h5>聯絡的學生:</h5><ul>';
                            
                            item.contact_teacher.forEach(function(contact) {
                                html += `

                                <div class="contactstudent_container" style="display: flex;justify-content: space-between;align-items: center;">
                                    <div class="contactstudent_info" style="flex-grow: 1;">
                                        <li>${contact.user.name} - 電子信箱 ${contact.user.email} - 手機號碼 ${contact.user.phone}</li>
                                    </div>
                                    <div class="contactstudent_buttons" style="display: flex;gap: 10px;">
                                        <button class="btn-select" data-user-id="${contact.user.id}"data-teacher-request-id="${item.id}">選擇</button>
                                        <button class="btn-cancel" data-user-id="${contact.user.id}"data-teacher-request-id="${item.id}">取消</button>
                                    </div>
                                </div>
                                <hr>
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
                        let beTeacherId = $(this).data('teacher-request-id');
                        $.ajax({
                            url: '{{ route('teacher.keepSelected') }}', // 在 routes/web.php 中定义这个路由
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}', // CSRF 保护
                                user_id: userId,
                                beTeacher_Id: beTeacherId
                            },
                            success: function(response) {
                                // 删除其他学生成功后，跳转到行事历页面
                                console.log(response);
                                const url = '{{ route("otherCalendar.show") }}' + '?user_id=' + userId + '&beTeacherId=' + beTeacherId;
                                window.open(url);
                            },
                            error: function(xhr) {
                                console.error('An error occurred:', xhr);
                                alert('Failed to keep selected student');
                            }
                        });
                    });
                
                    // 綁定取消按鈕的事件處理
                    $('.btn-cancel').on('click', function() {
                        let userId = $(this).data('user-id');
                        let teacherRequestId = $(this).data('teacher-request-id');
                        $.ajax({
                            url: '{{ route('contact_teacher.remove') }}',
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
            $.ajax({
                url: '{{ route('user.be_teacher') }}',
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    
                    let html = '<h3></h3><ul>';
                    response.beteacherIn_progress.forEach(function(item) {
                        console.log(item);
                        if (!item) {
                            return; // 如果 teacherRequests 為 null，則跳過
                        }


                        html += `
                    <section class="student_container">
                        <div class="student_header">
                            <h1 style="color: #004080 ;">${item.title}</h1>
                        </div>

                       

                        <div class="student_info-bar">
                            <div>縣市&nbsp;:&nbsp;${item.city.city}</div>
                            <div>科目&nbsp;:&nbsp;${item.subject.name}</div>
                            <div>時薪&nbsp;:&nbsp;${item.hourly_rate}</div>
                        </div>
                    </section>
                    `;
                             // 如果有contact_students資料
                        if (item.contact_teacher && item.contact_teacher.length > 0) {
                            html += '<h5>進行中的學生:</h5><ul>';
                            item.contact_teacher.forEach(function(contact) {

                                html += `
                                
                                    
                                    

                                <div class="contactstudent_container" style="display: flex;justify-content: space-between;align-items: center;">
                                    <div class="contactstudent_info" style="flex-grow: 1;">
                                        <li>${contact.user.name} - 電子信箱 ${contact.user.email} - 手機號碼 ${contact.user.phone}</li>
                                    </div>
                                    <div class="contactstudent_buttons" style="display: flex;gap: 10px;">
                                        <button class="update-status" data-id="${contact.be_teacher_id}" data-status="completed">完成</button>
                                        <button class="update-status" data-id="${contact.be_teacher_id}" data-status="cancelled">取消</button>
                                    </div>
                                </div>
                                <hr>
                                

                            `;
                            });
                            html += '</ul><br>';
                        }
                    });
                    response.teacherRequestsIn_progress.forEach(function(item) {
                        console.log(item);
                        if (!item) {
                            return; // 如果 teacherRequests 為 null，則跳過
                        }


                        html += `
                    <section class="student_container">
                        <div class="student_header">
                            <h1 style="color: #004080 ;">${item.title}</h1>
                        </div>

                       

                        <div class="student_info-bar">
                            <div>縣市&nbsp;:&nbsp;${item.city.city}</div>
                            <div>科目&nbsp;:&nbsp;${item.subject.name}</div>
                            <div>時薪&nbsp;:&nbsp;${item.hourly_rate}</div>
                        </div>
                    </section>
                    `;
                             // 如果有contact_students資料
                        if (item.contact_teacher && item.contact_teacher.length > 0) {
                            html += '<h5>進行中的學生:</h5><ul>';
                            item.contact_teacher.forEach(function(contact) {

                                html += `
                                
                                    
                                    

                                <div class="contactstudent_container" style="display: flex;justify-content: space-between;align-items: center;">
                                    <div class="contactstudent_info" style="flex-grow: 1;">
                                        <li>${contact.user.name} - 電子信箱 ${contact.user.email} - 手機號碼 ${contact.user.phone}</li>
                                    </div>
                                    <div class="contactstudent_buttons" style="display: flex;gap: 10px;">
                                        <button class="update-status" data-id="${contact.be_teacher_id}" data-status="completed">完成</button>
                                        <button class="update-status" data-id="${contact.be_teacher_id}" data-status="cancelled">取消</button>
                                    </div>
                                </div>
                                <hr>
                                

                            `;
                            });
                            html += '</ul><br>';
                        }
                    });
                    html += '</ul>';
                    $('#areaStatus').html(html);

                    $(document).on('click', '.update-status', function() {
                        let requestId = $(this).data('id');
                        let newStatus = $(this).data('status');
                        console.log(newStatus);
                        
                        $.ajax({
                            url: '{{ route('be_teacher.updateStatus') }}', // 在 routes/web.php 中定義這個路由
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}', // CSRF 保護
                                id: requestId,
                                status: newStatus
                            },
                            success: function(response) {
                                alert('Status updated successfully');
                                // 更新列表中的狀態顯示
                                $(`li[data-id="${requestId}"]`).text(`${response.title} - ${response.status}`);
                            },
                            error: function(xhr) {
                                console.error('An error occurred:', xhr);
                                alert('Failed to update status');
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

        $('#btnSchedule').on('click', function() {
            $('#areaStatus').html('<p>顯示課表的內容</p>');
        });

        $('#btnRecord').on('click', function() {
            $.ajax({
                url: '{{ route('user.be_teacher') }}',
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    
                    let html = '<h3></h3><ul>';
                    response.beteacherCompleted.forEach(function(item) {
                        console.log(item);
                        if (!item) {
                            return; // 如果 teacherRequests 為 null，則跳過
                        }


                        html += `
                    <section class="student_container">
                        <div class="student_header">
                            <h1 style="color: #004080 ;">${item.title}</h1>
                        </div>

                        <div class="student_info-bar">
                            <div>縣市&nbsp;:&nbsp;${item.city.city}</div>
                            <div>科目&nbsp;:&nbsp;${item.subject.name}</div>
                            <div>時薪&nbsp;:&nbsp;${item.hourly_rate}</div>
                        </div>
                        
                        
                    </section>
                    `;
                             // 如果有contact_students資料
                        if (item.contact_teacher && item.contact_teacher.length > 0) {
                            html += '<h5>已完成:</h5><ul>';
                            item.contact_teacher.forEach(function(contact) {
                                html += `
                                <li>${contact.user.name} - 電子信箱 ${contact.user.email} - 手機號碼 ${contact.user.phone}</li>
                                <hr>

                            `;
                            });
                            html += '</ul><br>';
                        }
                    });
                    response.teacherRequestsCompleted.forEach(function(item) {
                        console.log(item);
                        if (!item) {
                            return; // 如果 teacherRequests 為 null，則跳過
                        }


                        html += `
                    <section class="student_container">
                        <div class="student_header">
                            <h1 style="color: #004080 ;">${item.title}</h1>
                        </div>

                        <div class="student_info-bar">
                            <div>縣市&nbsp;:&nbsp;${item.city.city}</div>
                            <div>科目&nbsp;:&nbsp;${item.subject.name}</div>
                            <div>時薪&nbsp;:&nbsp;${item.hourly_rate}</div>
                        </div>
                        
                        
                    </section>
                    `;
                             // 如果有contact_students資料
                        if (item.contact_teacher && item.contact_teacher.length > 0) {
                            html += '<h5>已完成:</h5><ul>';
                            item.contact_teacher.forEach(function(contact) {
                                html += `
                                <li>${contact.user.name} - 電子信箱 ${contact.user.email} - 手機號碼 ${contact.user.phone}</li>
                                <hr>

                            `;
                            });
                            html += '</ul><br>';
                        }
                    });
                    response.beteacherCancelled.forEach(function(item) {
                        console.log(item);
                        if (!item) {
                            return; // 如果 teacherRequests 為 null，則跳過
                        }


                        html += `
                    <section class="student_container">
                        <div class="student_header">
                            <h1 style="color: #004080 ;">${item.title}</h1>
                        </div>


                        <div class="student_info-bar">
                            <div>縣市&nbsp;:&nbsp;${item.city.city}</div>
                            <div>科目&nbsp;:&nbsp;${item.subject.name}</div>
                            <div>時薪&nbsp;:&nbsp;${item.hourly_rate}</div>
                        </div>
                       
                        
                    </section>
                    `;
                             // 如果有contact_students資料
                        if (item.contact_teacher && item.contact_teacher.length > 0) {
                            html += '<h5>已取消:</h5><ul>';
                            item.contact_teacher.forEach(function(contact) {
                                html += `
                                
                                <li>${contact.user.name} - 電子信箱 ${contact.user.email} - 手機號碼 ${contact.user.phone}</li>
                                <hr>
                                
                                `;
                            });
                            html += '</ul><br>';
                        }
                    });
                    response.teacherRequestsCancelled.forEach(function(item) {
                        console.log(item);
                        if (!item) {
                            return; // 如果 teacherRequests 為 null，則跳過
                        }


                        html += `
                    <section class="student_container">
                        <div class="student_header">
                            <h1 style="color: #004080 ;">${item.title}</h1>
                        </div>


                        <div class="student_info-bar">
                            <div>縣市&nbsp;:&nbsp;${item.city.city}</div>
                            <div>科目&nbsp;:&nbsp;${item.subject.name}</div>
                            <div>時薪&nbsp;:&nbsp;${item.hourly_rate}</div>
                        </div>
                       
                        
                    </section>
                    `;
                             // 如果有contact_students資料
                        if (item.contact_teacher && item.contact_teacher.length > 0) {
                            html += '<h5>已取消:</h5><ul>';
                            item.contact_teacher.forEach(function(contact) {
                                html += `
                                
                                <li>${contact.user.name} - 電子信箱 ${contact.user.email} - 手機號碼 ${contact.user.phone}</li>
                                <hr>
                                
                                `;
                            });
                            html += '</ul><br>';
                        }
                    });
                    html += '</ul>';
                    $('#areaStatus').html(html);

                        // 綁定選擇按鈕的事件處理
                    $('').on('click', function() {
                    });
                
                    // 綁定取消按鈕的事件處理
                    $('').on('click', function() {

                    });
                    
                },
                error: function(xhr) {
                    console.error('An error occurred:', xhr);
                    $('#areaStatus').html('<p>載入收藏列表時發生錯誤aabb。</p>');
                }
            });
        });
    });
    </script>


</body>

</html>