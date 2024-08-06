const cityDistricts = {
    taipei: ['中正區', '大同區', '中山區', '松山區', '大安區', '萬華區', '信義區', '士林區', '北投區', '內湖區', '南港區', '文山區'],
    taichung: ['中區', '東區', '南區', '西區', '北區', '北屯區', '西屯區', '南屯區', '太平區', '大里區', '霧峰區', '烏日區'],
    kaohsiung: ['鹽埕區', '鼓山區', '左營區', '楠梓區', '三民區', '新興區', '前金區', '苓雅區', '前鎮區', '旗津區', '小港區', '鳳山區']
};

document.getElementById('city').addEventListener('change', function () {
    const districtsContainer = document.getElementById('districts-container');
    districtsContainer.innerHTML = ''; // 清空現有選項

    const selectedCity = this.value;
    if (selectedCity && cityDistricts[selectedCity]) {
        cityDistricts[selectedCity].forEach(district => {
            const checkboxDiv = document.createElement('div');
            checkboxDiv.className = 'district-checkbox';

            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'districts[]';
            checkbox.value = district;
            checkbox.id = `district-${district}`;

            const label = document.createElement('label');
            label.htmlFor = `district-${district}`;
            label.textContent = district;

            checkboxDiv.appendChild(checkbox);
            checkboxDiv.appendChild(label);
            districtsContainer.appendChild(checkboxDiv);
        });
    }
});
// 假設這是從資料庫獲取的用戶資訊
const userInfo = {
phone: "0912345678",
email: "user@example.com"
};

document.querySelectorAll('input[name="connection"]').forEach(radio => {
radio.addEventListener('change', function() {
const contactInfo = document.getElementById('contact_info');
const contactValue = document.getElementById('contact_value');

if (this.value === 'phone') {
    contactValue.value = userInfo.phone;
    contactValue.type = 'tel';
    contactInfo.style.display = 'block';
} else if (this.value === 'email') {
    contactValue.value = userInfo.email;
    contactValue.type = 'email';
    contactInfo.style.display = 'block';
} else {
    contactInfo.style.display = 'none';
}
});
});


// document.getElementById('jobForm').addEventListener('submit', function (event) {
//     event.preventDefault();

    // 表單驗證
    // let title = document.getElementById('title').value;
    // let subject = document.getElementById('subject').value;
    // let city = document.getElementById('city').value;
    // let districts = Array.from(document.querySelectorAll('input[name="districts[]"]:checked')).map(checkbox => checkbox.value);
    // let hourlyRateMin = document.getElementById('hourly_rate_min').value;
    // let hourlyRateMax = document.getElementById('hourly_rate_max').value;
    // let details = document.getElementById('details').value;
    // let frequency = document.querySelector('input[name="frequency"]:checked');
    // let contactMethod = document.querySelector('input[name="connection"]:checked');
    // let contactValue = document.getElementById('contact_value').value;

    // if (!title || !subject || !city || districts.length === 0 || !hourlyRateMin || !hourlyRateMax || !details || !frequency) {
    //     alert('請填寫所有必填欄位');
    //     return;
    // }

    // if (parseInt(hourlyRateMin) > parseInt(hourlyRateMax)) {
    //     alert('最低時薪不能大於最高時薪');
    //     return;
    // }
    // if (!contactMethod || !contactValue) {
    // alert('請選擇並確認聯絡方式');
    //  return;
    // }


    // this.submit();

    
// });
document.getElementById('jobForm').addEventListener('submit', function (event) {
    event.preventDefault();

    // 获取表单字段值
    let title = document.getElementById('title').value;
    let subject = document.getElementById('subject').value;
    let city = document.getElementById('city').value;
    let districts = Array.from(document.querySelectorAll('input[name="districts[]"]:checked')).map(checkbox => checkbox.value);
    let hourlyRateMin = document.getElementById('hourly_rate_min').value;
    let hourlyRateMax = document.getElementById('hourly_rate_max').value;
    let details = document.getElementById('details').value;
    let frequency = document.querySelector('input[name="frequency"]:checked');
    let contactMethod = document.querySelector('input[name="connection"]:checked');
    let contactValue = document.getElementById('contact_value').value;

    // 验证所有必填字段
    if (!title || !subject || !city || districts.length === 0 || !hourlyRateMin || !hourlyRateMax || !details || !frequency) {
        alert('請填寫所有必填欄位');
        return;
    }

    // 验证时薪范围
    if (parseInt(hourlyRateMin) > parseInt(hourlyRateMax)) {
        alert('最低時薪不能大於最高時薪');
        return;
    }

    // 验证联系方式
    if (!contactMethod || !contactValue) {
        alert('請選擇並確認聯絡方式');
        return;
    }

    // 如果所有验证都通过，准备提交表单
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let csrfInput = document.createElement('input');
    csrfInput.setAttribute('type', 'hidden');
    csrfInput.setAttribute('name', '_token');
    csrfInput.setAttribute('value', csrfToken);
    this.appendChild(csrfInput);

    // 确保使用 POST 方法
    this.method = 'POST';

    // 提交表单
    this.submit();
});


function validateNumberInput(event) {
    event.target.value = event.target.value.replace(/[^\d]/g, '');
}

document.getElementById('hourly_rate_min').addEventListener('input', validateNumberInput);
document.getElementById('hourly_rate_max').addEventListener('input', validateNumberInput);