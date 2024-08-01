document.addEventListener('DOMContentLoaded', function() {
    const citySelect = document.getElementById('city');
    const districtsContainer = document.getElementById('districts-container');
    const jobForm = document.getElementById('jobForm');
    const hourlyRateMin = document.getElementById('hourly_rate_min');
    const hourlyRateMax = document.getElementById('hourly_rate_max');

    // 獲取城市列表
    fetch('/cities')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(cities => {
            if (cities.length === 0) {
                console.log('No cities received from the server.');
                return;
            }
            cities.forEach(city => {
                const option = document.createElement('option');
                option.value = city.id;
                option.textContent = city.city;
                citySelect.appendChild(option);
            });
        })
        .catch(e => {
            console.error('獲取城市列表時出錯:', e);
            alert('無法獲取城市列表，請稍後再試。');
        });

    // 城市選擇變更時獲取地區
    citySelect.addEventListener('change', function () {
        const selectedCityId = this.value;
        if (selectedCityId) {
            fetch(`/districts/${selectedCityId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(districts => {
                    districtsContainer.innerHTML = ''; // 清空現有選項
                    districts.forEach(district => {
                        const checkboxDiv = document.createElement('div');
                        checkboxDiv.className = 'district-checkbox';

                        const checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.name = 'districts[]';
                        checkbox.value = district.id;
                        checkbox.id = `district-${district.id}`;

                        const label = document.createElement('label');
                        label.htmlFor = `district-${district.id}`;
                        label.textContent = district.district_name;

                        checkboxDiv.appendChild(checkbox);
                        checkboxDiv.appendChild(label);
                        districtsContainer.appendChild(checkboxDiv);
                    });
                })
                .catch(e => {
                    console.error('獲取地區列表時出錯:', e);
                    alert('無法獲取地區列表,請稍後再試。');
                });
        } else {
            districtsContainer.innerHTML = '';
        }
    });

    // 表單提交處理
    if (jobForm) {
        jobForm.addEventListener('submit', function (event) {
            event.preventDefault();

            // 獲取表單字段值
            let formData = new FormData(this);

            // 驗證所有必填字段
            if (!validateForm(formData)) {
                return;
            }

            // 發送 AJAX 請求
            fetch('/findteacher', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                alert(data.message);
                // 可以在這裡添加其他成功後的操作，比如重置表單或重定向
                jobForm.reset();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('提交失敗，請稍後再試。');
            });
        });
    }

    // 驗證數字輸入
    function validateNumberInput(event) {
        event.target.value = event.target.value.replace(/[^\d]/g, '');
    }

    if (hourlyRateMin) {
        hourlyRateMin.addEventListener('input', validateNumberInput);
    }
    if (hourlyRateMax) {
        hourlyRateMax.addEventListener('input', validateNumberInput);
    }

    // 表單驗證函數
    function validateForm(formData) {
        let isValid = true;

        if (!formData.get('title') || !formData.get('subject') || !formData.get('expected_date') || 
            !formData.get('hourly_rate_min') || !formData.get('hourly_rate_max') || 
            !formData.get('city') || !formData.get('details')) {
            alert('請填寫所有必填欄位');
            isValid = false;
        }

        if (formData.getAll('available_time').length === 0) {
            alert('請至少選擇一個可上課時段');
            isValid = false;
        }

        if (formData.getAll('districts[]').length === 0) {
            alert('請至少選擇一個地區');
            isValid = false;
        }

        let hourlyRateMin = parseInt(formData.get('hourly_rate_min'));
        let hourlyRateMax = parseInt(formData.get('hourly_rate_max'));
        if (hourlyRateMin > hourlyRateMax) {
            alert('最低時薪不能大於最高時薪');
            isValid = false;
        }

        return isValid;
    }
});