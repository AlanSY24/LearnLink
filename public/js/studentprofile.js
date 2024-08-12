        // <!-- script(履歷表)==================================================================================================== -->



        // <!-- script(收藏)==================================================================================================== -->
        //按鈕:收藏
        function createFavoriteOverlay() {
            const favoriteOverlay = document.createElement('div');
            favoriteOverlay.classList.add('s_cases');
            favoriteOverlay.innerHTML = `
    <section class="student_container">
        <div class="student_header">
            <h1>顯示標題(國小數學)</h1>
            <i id="heart" class="far fa-heart" style="color: red ;"></i>
        </div>
        <div class="student_info-bar">
            <div>科目</div>
            <div>上課地點</div>
            <div>時間</div>
            <div>時薪</div>
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
            <!-- <div class="options">
                <button>學生</button>
                <button>家長</button>
                <button>F資表預設1</button>
                <button>F資表預設2</button>
            </div> -->
        </div>
    </section>
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




        // <!-- script(被老師連絡)==================================================================================================== -->
        //按鈕:被老師連絡
        function createContactOverlay() {
            const contactOverlay = document.createElement('div');
            contactOverlay.classList.add('contact_student');
            contactOverlay.innerHTML = `
                <div class="contact_student">
                    <div id="t_lists_title">
                        <button id="btnDisappear">下架</button>
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
            if (event.target.id === 'btnDisappear') {
                const contactOverlay = document.querySelector('.contact_student');
                if (contactOverlay) {
                    contactOverlay.remove();
                }
            }
        });

        document.addEventListener('click', function (event) {
            if (event.target.id === 'btnContactCheck') {
                document.getElementById('formConfirm').classList.remove('hidden');
            } else if (event.target.id === 'btnContactCancel') {
                // 顯示確認對話框
                var confirmRemoval = confirm('請問確定移除該學生訊息嗎？');

                // 如果用戶點擊"確定"，則移除 .student 元素
                if (confirmRemoval) {
                    var studentDiv = event.target.parentElement;
                    studentDiv.remove();
                } else {
                    document.getElementById('formConfirm').classList.add('hidden');
                }
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

        // 右上角關閉按鈕的事件監聽
        document.getElementById('btnCloseFormConfirm').addEventListener('click', function () {
            document.getElementById('formConfirm').classList.add('hidden');
        });

        document.getElementById('confirmFormData').addEventListener('submit', function (event) {
            if (isSubmitted) {
                return; // 如果已提交，直接返回
            }
            isSubmitted = true; // 設置為已提交

            event.preventDefault(); // 阻止表單默認提交行為

            const form = document.getElementById('confirmFormData');
            const formData = new FormData(form);

            // 生成要顯示的表單數據內容
            let output = '<h3>(B01)國小三年級數學</h3><div class="A03">(A03)帳號：</div>';
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

                // 检查是否已经评分
                if (!completedData.includes('評分:')) {
                    // 添加评分按钮
                    const ratingButton = document.createElement('button');
                    ratingButton.textContent = '評分';
                    ratingButton.addEventListener('click', function () {
                        const rating = prompt('請給出1-5的評分：');
                        if (rating !== null && rating !== '') {
                            const ratingNumber = parseInt(rating);
                            if (ratingNumber >= 1 && ratingNumber <= 5) {
                                // 在这里可以将评分发送到服务器或进行其他操作
                                alert(`您的評分是: ${ratingNumber}`);

                                // 将评分添加到completedData
                                completedData += `<p>評分: ${ratingNumber}</p>`;
                                areaStatus.innerHTML = completedData;

                                // 移除评分按钮
                                ratingButton.remove();

                                // 移除結束按鈕
                                removeEndButton();
                            } else {
                                alert('請輸入1-5之間的數字');
                            }
                        }
                    });
                    areaStatus.appendChild(ratingButton);
                }
            } else {
                areaStatus.innerHTML = '尚無資料';
            }

            // 移除結束按鈕
            removeEndButton();
        });

        // 創建一個移除結束按鈕的函數
        function removeEndButton() {
            const endButton = document.querySelector('#btnEnd');
            if (endButton) {
                endButton.remove();
            }
        }

