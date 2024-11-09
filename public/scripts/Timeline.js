document.addEventListener('DOMContentLoaded', function() {
    const timelineContainer = document.querySelector('.timeline-container');
    const filterButtons = document.querySelectorAll('.filter-btn');

    // Sample events data - 可以从localStorage或API获取
    const events = [
        {
            id: 1,
            title: "Team Building Workshop",
            date: "2024-11-05",
            time: "09:00",
            location: "Conference Room A",
            description: "Setting up teams and introducing project goals.",
            maxParticipants: 3,
            status: "past"
        },
        {
            id: 2,
            title: "Project Kickoff Meeting",
            date: "2024-11-10",
            time: "14:00",
            location: "Virtual Meeting Room",
            description: "Initial meeting to discuss distributions and timeline.",
            maxParticipants: 3,
            status: "upcoming"
        }
        // Add more events as needed
    ];

    // 渲染时间线项目
    function createTimelineItem(event) {
        const item = document.createElement('div');
        item.className = `timeline-item ${event.status}`;

        const date = new Date(`${event.date} ${event.time}`);
        const formattedDate = date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        const formattedTime = date.toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit'
        });

        item.innerHTML = `
            <div class="timeline-content">
                <div class="timeline-date">${formattedDate} at ${formattedTime}</div>
                <div class="timeline-title">${event.title}</div>
                <div class="timeline-location">📍 ${event.location}</div>
                <div class="timeline-description">${event.description}</div>
                <div class="timeline-participants">
                    👥 ${event.currentParticipants}/${event.maxParticipants} Participants
                </div>
                <span class="status-indicator status-${event.status}">
                    ${event.status.charAt(0).toUpperCase() + event.status.slice(1)}
                </span>
            </div>
        `;

        return item;
    }

    // 过滤和显示事件
    function filterEvents(filter = 'all') {
        timelineContainer.innerHTML = '';
        const filteredEvents = events.filter(event => 
            filter === 'all' || event.status === filter
        );

        filteredEvents.forEach(event => {
            timelineContainer.appendChild(createTimelineItem(event));
        });
    }

    // 设置过滤按钮点击事件
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            filterEvents(button.dataset.filter);
        });
    });

    // 初始化显示所有事件
    filterEvents();
});