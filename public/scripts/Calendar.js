document.addEventListener('DOMContentLoaded', function() {
    const calendarDays = document.getElementById('calendar-days');
    const modal = document.getElementById('eventModal');
    const closeBtn = document.querySelector('.close');
    const eventForm = document.getElementById('eventForm');
    const eventDateInput = document.getElementById('eventDate');
    const currentMonthSpan = document.getElementById('currentMonth');
    const currentYearSpan = document.getElementById('currentYear');
    const prevMonthBtn = document.getElementById('prevMonth');
    const nextMonthBtn = document.getElementById('nextMonth');
    
    // Store events data
    let events = {};
    
    // Current date tracking
    let currentDate = new Date();
    const months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    function updateDateDisplay() {
        currentMonthSpan.textContent = months[currentDate.getMonth()];
        currentYearSpan.textContent = currentDate.getFullYear();
    }

    function getDaysInMonth(year, month) {
        return new Date(year, month + 1, 0).getDate();
    }

    function getFirstDayOfMonth(year, month) {
        return new Date(year, month, 1).getDay();
    }

    function createDayCell(day) {
        const dayCell = document.createElement('div');
        dayCell.className = 'day';
        
        const dayContent = document.createElement('div');
        dayContent.className = 'day-content';
        
        const dayNumber = document.createElement('span');
        dayNumber.className = 'day-number';
        dayNumber.textContent = day;
        
        const addButton = document.createElement('span');
        addButton.className = 'add-event';
        addButton.innerHTML = '+';
        addButton.onclick = (e) => {
            e.stopPropagation();
            openModal(day);
        };
        
        // Add event indicator if events exist for this date
        const eventKey = `${currentDate.getFullYear()}-${currentDate.getMonth() + 1}-${day}`;
        if (events[eventKey]) {
            const eventDot = document.createElement('div');
            eventDot.className = 'event-dot';
            dayContent.appendChild(eventDot);
        }
        
        dayContent.appendChild(dayNumber);
        dayContent.appendChild(addButton);
        dayCell.appendChild(dayContent);
        
        return dayCell;
    }

    function renderCalendar() {
        calendarDays.innerHTML = '';
        updateDateDisplay();

        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        const daysInMonth = getDaysInMonth(year, month);
        const firstDay = getFirstDayOfMonth(year, month);

        // Add empty cells for days before the start
        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.className = 'day empty';
            calendarDays.appendChild(emptyCell);
        }

        // Add days of the month
        for (let day = 1; day <= daysInMonth; day++) {
            const dayCell = createDayCell(day);
            calendarDays.appendChild(dayCell);
        }
    }

    function openModal(day) {
        modal.style.display = 'block';
        const formattedDate = `${currentDate.getFullYear()}-${(currentDate.getMonth() + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
        eventDateInput.value = formattedDate;
    }

    function closeModal() {
        modal.style.display = 'none';
        eventForm.reset();
    }

    // Event Handlers
    prevMonthBtn.onclick = () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    };

    nextMonthBtn.onclick = () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    };

    closeBtn.onclick = closeModal;

    window.onclick = (event) => {
        if (event.target == modal) {
            closeModal();
        }
    };

    eventForm.onsubmit = (e) => {
        e.preventDefault();
        const selectedDate = eventDateInput.value;
        
        // Store event data
        events[selectedDate] = {
            name: document.getElementById('eventName').value,
            time: document.getElementById('eventTime').value,
            description: document.getElementById('eventDescription').value,
            location: document.getElementById('eventLocation').value,
            maxParticipants: document.getElementById('maxParticipants').value
        };

        renderCalendar();
        closeModal();
    };

    // Initial render
    renderCalendar();
});