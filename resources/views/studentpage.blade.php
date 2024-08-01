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
    <link rel="stylesheet" href="./css/會員中心老師.css">
    <link rel="stylesheet" href="./css/studentCss.css">

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
                <li><a href="#">老師</a></li>
                <li><a href="#">學生</a></li>
                <li><a href="#">家長</a></li>

            </ul>
        </aside>
        <main>
            <section class="resume">
            @include('partials.studentCard')
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
    <footer>

    </footer>
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
        </div>

    </div>




    <script>
        // <!-- script(履歷表)==================================================================================================== -->



        // <!-- script(收藏)==================================================================================================== -->
        //按鈕:收藏
        function createFavoriteOverlay() {
            const favoriteOverlay = document.createElement('div');
            favoriteOverlay.classList.add('s_cases');
            favoriteOverlay.innerHTML = `
                <div class="s_cases_block">
                    <div id="t_lists_title" style="display: flex">
                        <i id="heart" class="far fa-heart" style="color: red ;"></i>
                        <h2>(B01)國小三年級數學</h2>
                        
                    </div>
                    
                    <div id="t_lists_subject">(B02)教學的科目：數學</div>
                    <div id="t_lists_name">(A01)姓名：王XX</div>
                    <div id="t_lists_gender">(A02)性別：女</div>
                    <div id="t_lists_place">(B04+B05)上課預期地點：台中北屯區</div>
                    <div id="t_lists_time">(B??)上課預期時間：上午</div>
                    <div id="t_lists_price">(B06)上課預期時薪：300 - 400</div>
                    <div id="t_lists_describe">(B07)關於學生的詳細描述：1. 需要多點耐心 2. 主要以輔導學校數學作業為主</div>
                    <div class="container-button">
                        <button id="btnContactStudent">連絡學生</button>
                    </div>
                </div>
            `;
            return favoriteOverlay;
        }

        document.getElementById('btnFavorite').addEventListener('click', function () {
            const areaStatus = document.getElementById('areaStatus');
            const favoriteOverlay = createFavoriteOverlay();
            areaStatus.innerHTML = '';
            areaStatus.appendChild(favoriteOverlay);
        });

        //按鈕:連絡學生
        document.addEventListener('DOMContentLoaded', function () {
            const areaStatus = document.getElementById('areaStatus');
            document.addEventListener('click', function (event) {
                if (event.target && event.target.id === 'btnContactStudent') {
                    const currentTime = new Date().toLocaleString();

                    alert('已成功連絡 請耐心等待回復');
                    //創建新的時間顯示元素
                    const timeDisplay = document.createElement('div');
                    timeDisplay.textContent = `已連絡: ${currentTime}`;

                    //清空 areaStatus 並添加新的時間顯示
                    areaStatus.innerHTML = '';
                    areaStatus.appendChild(timeDisplay);
                }
            });
        });


        // <!-- script(被學生/家長連絡)==================================================================================================== -->
        //按鈕:被學生/家長連絡
        function createContactOverlay() {
            const contactOverlay = document.createElement('div');
            contactOverlay.classList.add('contact_student');
            contactOverlay.innerHTML = `
                <div class="contact_student">
                    <div id="t_lists_title">
                        <h2>(B01)國小三年級數學</h2>
                        <h3 id="t_lists_subject">(B02)教學的科目：數學</h3>
                    </div>
                    <div class="student" style="display: flex;">
                        <div class="A03">(A03)帳號：</div>
                        <div class="A06">(A06)手機：</div>
                        <div class="A07">(B07)信箱：</div>
                        <div class="A08">(???)內容(需求)：</div>
                        <button id="btnContactCheck">V</button>
                        <button id="btnContactCancel">X</button>
                    </div>
                </div>
            `;
            return contactOverlay;
        }

        document.getElementById('btnContact').addEventListener('click', function () {
            const areaStatus = document.getElementById('areaStatus');
            const contactOverlay = createContactOverlay();
            areaStatus.innerHTML = '';
            areaStatus.appendChild(contactOverlay);
        });

        document.addEventListener('click', function (event) {
            if (event.target.id === 'btnContactCheck') {
                document.getElementById('formConfirm').classList.remove('hidden');
            }
            if (event.target.id === 'btnContactCancel') {
                document.getElementById('formConfirm').classList.add('hidden');
            }
        });

        // 初始化日期選擇器並設置語言為中文
        document.addEventListener('DOMContentLoaded', function () {

            flatpickr("#datePicker", {
                locale: "zh"
            });
        });

        // <!-- script(已接案(預定中))==================================================================================================== -->

        //按鈕:送出submit->已接案(預定中)
        let isSubmitted = false; // 標誌位
        let submittedData = ''; // 用於儲存提交的表單數據
        let completedData = ''; // 用於儲存已結案的數據


        document.getElementById('confirmFormData').addEventListener('submit', function (event) {
            if (isSubmitted) {
                return; // 如果已提交，直接返回
            }
            isSubmitted = true; // 設置為已提交

            event.preventDefault(); // 阻止表單默認提交行為

            const form = document.getElementById('confirmFormData');
            const formData = new FormData(form);

            // 生成要顯示的表單數據內容
            let output = '<h3>(B01)國小三年級數學</h3>';
            formData.forEach((value, key) => {
                output += `<p><strong>${key}:</strong> ${value}</p>`;
            });

            // 添加三個按鈕
            output += `
                <div id="btnEnd">
                    <button id="btnCancel" class="btn-cancel">取消</button>
                    <button id="btnEdit">修改</button>
                    <button id="btnFinish" class="btn-finish">完成</button>
                </div>
            `;

            // 儲存生成內容
            submittedData = output;

            // 隱藏表單
            document.getElementById('formConfirm').classList.add('hidden');
        });

        document.getElementById('btnProgress').addEventListener('click', function () {
            const areaStatus = document.getElementById('areaStatus');
            // 顯示已儲存的表單數據
            areaStatus.innerHTML = isSubmitted ? submittedData : '尚無預定資料';

            // 取消按鈕
            document.getElementById('btnCancel').addEventListener('click', function () {
                // 獲取當前時間
                const currentTime = new Date().toLocaleString();
                alert('課程已取消');
                completedData = `<h3>取消時間: ${currentTime}</h3>${submittedData}`;
                document.getElementById('areaStatus').innerHTML = '';
            });



            // 修改按钮
            document.getElementById('btnEdit').addEventListener('click', function () {
                // 移除已顯示的數據
                areaStatus.innerHTML = '';
                // 顯示表單
                document.getElementById('formConfirm').classList.remove('hidden');
                isSubmitted = false; // 重置提交标志
                // 顯示送出按鈕
                document.querySelector('#btnSubmitformConfirm').style.display = 'block';
            });

            // 完成按钮
            document.getElementById('btnFinish').addEventListener('click', function () {
                // 獲取當前時間
                const currentTime = new Date().toLocaleString();
                alert('課程已完成');
                completedData = `<h3>完成時間: ${currentTime}</h3>${submittedData}`;
                document.getElementById('areaStatus').innerHTML = '';
            });


        });

        //隱藏送出按鈕
        document.getElementById('confirmFormData').addEventListener('submit', function (event) {
            event.preventDefault(); //阻止表單默認提交行為

            //隱藏送出按鈕
            document.querySelector('#btnSubmitformConfirm').style.display = 'none';

            //顯示成功消息或其他行為
            alert('表單已成功提交');
        });

        // <!-- script(已接案(預定中))==================================================================================================== -->
        // 移除顯示的數據:取消 完成
        // 按鈕:取消
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('btn-cancel')) {
                const caseBlock = event.target.parentNode;
                caseBlock.remove();
                submittedData = '';
            }
        });

        // 按鈕:完成
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('btn-finish')) {
                const caseBlock = event.target.parentNode;
                caseBlock.remove();
                submittedData = '';
            }
        });

        // <!-- script(課表)==================================================================================================== -->
        //按鈕:課表
        document.getElementById('btnSchedule').addEventListener('click', function () {
            const areaStatus = document.getElementById('areaStatus');
            areaStatus.textContent = '課表';
        });
        // <!-- script(紀錄表)==================================================================================================== -->
        //按鈕:紀錄表
        document.getElementById('btnRecord').addEventListener('click', function () {
            const areaStatus = document.getElementById('areaStatus');
            if (completedData) {
                //顯示已取消的表單數據和時間
                areaStatus.innerHTML = completedData;
            } else {
                areaStatus.innerHTML = '尚無資料';
            }

            //隱藏所有按鈕
            document.querySelector('#btnEnd').style.display = 'none';
        });




    </script>


</body>

</html>