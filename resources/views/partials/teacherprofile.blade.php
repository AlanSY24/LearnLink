<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>老師履歷表</title>
</head>
<body>
    <div class="">
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- <h1>老師履歷表</h1> -->
        <button id="btnAddResume">新增/編輯 履歷表</button>

        @if($profile)
            <div class="profile-info">
                <div >
                    <h3>{{ $profile->title }}</h3>
                </div>
                <div >
                    @if($profile->photo)
                    <img src="data:image/jpeg;base64,{{ base64_encode($profile->photo) }}" alt="大頭貼" width="100" height="100">
                    @endif
                    @if($profile->pdf)
                        <div >
                            <button id='ifrbtn'>履歷表</button><br>
                                <iframe id='ifr' src="data:application/pdf;base64,{{ base64_encode($profile->pdf) }}" width="600" height="200"></iframe>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        
          




        <!-- 履歷表單 -->
        <div id="formResume" class="container-resume hidden">
            <div class="container-form">
                <form action="{{ route('teacherprofile.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">標題</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $profile->title ?? '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="photo">大頭貼</label>
                        <input type="file" id="photo" name="photo" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="pdf">PDF 文件</label>
                        <input type="file" id="pdf" name="pdf" accept="application/pdf">
                    </div>

                    <button type="submit" class="btn">儲存</button> 
                    <button type="button" id="btnCloseResume" class="close-button">&times;</button>
                </form>
            </div>
        </div>
    
    </div>
</body>
<script>

    // 履歷表PDF(顯示/隱藏)
    document.addEventListener('DOMContentLoaded', function() {
            var button = document.getElementById('ifrbtn');
            var iframe = document.getElementById('ifr');
            
            button.addEventListener('click', function() {
                if (iframe.style.display === 'none') {
                    iframe.style.display = 'block';
                } else {
                    iframe.style.display = 'none';
                }
            });
    });

    // <!-- script(履歷表)==================================================================================================== -->
        //按鈕:新增/編輯 履歷表
        document.getElementById('btnAddResume').addEventListener('click', function () {
            document.getElementById('formResume').classList.remove('hidden');
        });
        //按鈕:右上角關閉X
        document.getElementById('btnCloseResume').addEventListener('click', function () {
            document.getElementById('formResume').classList.add('hidden');
        });

        //表單:新增(送出sumbit)
        // document.getElementById('resumeFormData').addEventListener('submit', function (e) {
        //     e.preventDefault();

        //     var formData = new FormData(this);
        //     var file = formData.get('resumeFile');
        //     var reader = new FileReader();

        //     reader.onload = function (e) {
        //         var pdfBlob = new Blob([e.target.result], { type: 'application/pdf' });
        //         var url = URL.createObjectURL(pdfBlob);

        //         var resumeTitle = formData.get('resumeTitle');
        //         var photoFile = formData.get('resumePhoto');
        //         var photoReader = new FileReader();

        //         photoReader.onload = function (e) {
        //             var photoURL = e.target.result;
        //             var photoImg = document.createElement('img');
        //             photoImg.src = photoURL;
        //             photoImg.width = 100;

        //             var dataContainer = document.createElement('div');
        //             dataContainer.innerHTML = `
        //                 <div style="display: flex">
        //                     <button class="btn-delete">刪除</button>
        //                     <div>
        //                         <div>
        //                             <h3>${resumeTitle}</h3>
        //                             <div>${photoImg.outerHTML}</div>
        //                             <embed src="${url}" type="application/pdf" width="250" height="200">   
        //                         </div>
        //                     </div>
        //                 </div>
        //             `;
        //             document.getElementById('areaResume').appendChild(dataContainer);
        //             document.getElementById('formResume').classList.add('hidden');
        //             this.reset();
        //         }.bind(this);
        //         photoReader.readAsDataURL(photoFile);
        //     }.bind(this);

        //     reader.readAsArrayBuffer(file);
        // });

        //刪除功能
        // document.getElementById('areaResume').addEventListener('click', function (e) {
        //     if (e.target.classList.contains('btn-delete')) {
        //         if (confirm('請問是否確定刪除?')) {
        //             e.target.parentElement.remove();
        //         }
        //     }
        // });
        






</script>
</html>
