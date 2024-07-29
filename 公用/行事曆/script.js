let currentDate = new Date();
let events = [];
let cityData = {};

// 固定的事件類型
const EVENT_TYPE = "數學課";

// 獲取今天的日期字符串（格式：YYYY-MM-DD）
function getTodayString() {
    const today = new Date();
    return `${today.getFullYear()}-${(today.getMonth() + 1).toString().padStart(2, '0')}-${today.getDate().toString().padStart(2, '0')}`;
}

// 獲取當前時間加2小時後的時間字符串（格式：HH:mm）
function getMinTimeString() {
    const now = new Date();
    now.setHours(now.getHours() + 2);
    return `${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}`;
}

// 模擬從資料庫獲取事件類型
function fetchEventType() {
    return new Promise((resolve) => {
        setTimeout(() => {
            resolve(EVENT_TYPE);
        }, 100); // 模擬網絡延遲
    });
}

// 初始化事件類型顯示
async function initializeEventTypeDisplay() {
    const eventTypeElement = document.getElementById('eventType');
    const type = await fetchEventType();
    eventTypeElement.textContent = ` ${type}`;
}

// 獲取縣市和地區數據
async function fetchCityData() {
    try {
        const response = await fetch('./city.json');
        const data = await response.json();
        cityData = {};
        data.forEach(item => {
            cityData[item.name] = item.districts.map(district => district.name);
        });
        populateCitySelect();
    } catch (error) {
        console.error('Error fetching city data:', error);
    }
}

function populateCitySelect() {
    const citySelect = document.getElementById('citySelect');
    citySelect.innerHTML = '<option value="">選擇縣市</option>';
    Object.keys(cityData).forEach(city => {
        const option = document.createElement('option');
        option.value = city;
        option.textContent = city;
        citySelect.appendChild(option);
    });
}

function populateDistrictSelect(city) {
    const districtSelect = document.getElementById('districtSelect');
    districtSelect.innerHTML = '<option value="">選擇地區</option>';
    if (city && cityData[city]) {
        cityData[city].forEach(district => {
            const option = document.createElement('option');
            option.value = district;
            option.textContent = district;
            districtSelect.appendChild(option);
        });
    }
}

function renderCalendar() {
    const monthYear = document.getElementById('monthYear');
    const daysContainer = document.getElementById('days');
    
    const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
    const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
    
    monthYear.textContent = `${currentDate.getFullYear()}年${currentDate.getMonth() + 1}月`;
    
    daysContainer.innerHTML = '';
    
    for (let i = 0; i < firstDay.getDay(); i++) {
        const emptyDay = document.createElement('div');
        daysContainer.appendChild(emptyDay);
    }
    
    const today = new Date();
    
    for (let i = 1; i <= lastDay.getDate(); i++) {
        const dayElement = document.createElement('div');
        dayElement.textContent = i;
        
        const dateString = `${currentDate.getFullYear()}-${(currentDate.getMonth() + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`;
        const currentDateObj = new Date(dateString);
        
        if (currentDateObj < today) {
            dayElement.style.color = '#ccc'; // 過去的日期顯示為灰色
            dayElement.style.cursor = 'not-allowed';
        } else {
            dayElement.addEventListener('click', () => openEventModal(i));
            
            if (events.some(event => event.date === dateString)) {
                dayElement.style.backgroundColor = '#FFCCCB'; // 淺紅色
            } else if (i === today.getDate() && currentDate.getMonth() === today.getMonth() && currentDate.getFullYear() === today.getFullYear()) {
                dayElement.style.backgroundColor = '#4CAF50';
                dayElement.style.color = 'white';
            }
        }
        
        daysContainer.appendChild(dayElement);
    }
}

function openEventModal(day) {
    const modal = document.getElementById('eventModal');
    const eventDate = document.getElementById('eventDate');
    const eventTime = document.getElementById('eventTime');
    
    const dateString = `${currentDate.getFullYear()}-${(currentDate.getMonth() + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
    eventDate.value = dateString;
    eventDate.min = getTodayString(); // 設置最小日期為今天
    
    // 如果選擇的是今天，設置最小時間為當前時間加2小時
    if (dateString === getTodayString()) {
        eventTime.min = getMinTimeString();
    } else {
        eventTime.min = "00:00";
    }
    
    eventTime.value = '';
    
    // 重置其他輸入欄位
    document.getElementById('citySelect').value = '';
    document.getElementById('districtSelect').innerHTML = '<option value="">選擇地區</option>';
    document.getElementById('detailAddress').value = '';
    document.getElementById('hourlyRate').value = '';
    
    modal.style.display = 'block';
}

function addEvent() {
    const eventDate = document.getElementById('eventDate').value;
    const eventTime = document.getElementById('eventTime').value;
    const city = document.getElementById('citySelect').value;
    const district = document.getElementById('districtSelect').value;
    const detailAddress = document.getElementById('detailAddress').value;
    const hourlyRate = document.getElementById('hourlyRate').value;
    
    const selectedDateTime = new Date(`${eventDate}T${eventTime}`);
    const minDateTime = new Date();
    minDateTime.setHours(minDateTime.getHours() + 2);
    
    if (selectedDateTime < minDateTime) {
        alert('請選擇至少2小時後的時間');
        return;
    }
    
    if (!city || !district || !detailAddress || !hourlyRate) {
        alert('請填寫所有必要的信息');
        return;
    }
    
    events.push({
        date: eventDate,
        time: eventTime,
        text: EVENT_TYPE,
        city: city,
        district: district,
        detailAddress: detailAddress,
        hourlyRate: hourlyRate
    });
    
    document.getElementById('eventModal').style.display = 'none';
    renderCalendar();
    renderEventList();
}

function renderEventList() {
    const eventList = document.getElementById('events');
    eventList.innerHTML = '';
    
    events.forEach((event, index) => {
        const li = document.createElement('li');
        li.innerHTML = `
    <div>${event.date} ${event.time}: ${event.text}</div>
    <div>${event.city}${event.district}</div>
    <div>${event.detailAddress}</div>
    <div>時薪: ${event.hourlyRate}</div>
`;
        eventList.appendChild(li);
    });
}

function submitEvents() {
    console.log('Submitting events to database:', events);
    alert('事件已提交到資料庫！');
    
    events = [];
    renderEventList();
    renderCalendar();
}

document.getElementById('prevMonth').addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
});

document.getElementById('nextMonth').addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
});

document.getElementById('closeModal').addEventListener('click', () => {
    document.getElementById('eventModal').style.display = 'none';
});

document.getElementById('addEvent').addEventListener('click', addEvent);
document.getElementById('submitEvents').addEventListener('click', submitEvents);

// 動態更新時間限制
document.getElementById('eventDate').addEventListener('change', function() {
    const eventDate = this.value;
    const eventTime = document.getElementById('eventTime');
    if (eventDate === getTodayString()) {
        eventTime.min = getMinTimeString();
    } else {
        eventTime.min = "00:00";
    }
});

// 縣市選擇變更時更新地區選項
document.getElementById('citySelect').addEventListener('change', function() {
    populateDistrictSelect(this.value);
});

// 初始化
(async function() {
    await fetchCityData();
    await initializeEventTypeDisplay();
    renderCalendar();
    renderEventList();
})();