document.addEventListener('DOMContentLoaded', function() {
    // DOM Element Selections
    const openAddTaskBtn = document.getElementById('openAddTask');
    const addTaskModal = document.getElementById('addTaskModal');
    const editTaskModal = document.getElementById('editTaskModal');
    const closeAddTaskBtn = addTaskModal.querySelector('.close-btn');
    const closeEditTaskBtn = editTaskModal.querySelector('.close-btn');
    const addTaskForm = document.getElementById('addTaskForm');
    const editTaskForm = document.getElementById('editTaskForm');
    const taskList = document.getElementById('taskList');
    const applyFiltersBtn = document.getElementById('applyFilters');
    const sortTasksBtn = document.getElementById('sortTasks');

    // Modal Functionality
    function openModal(modal) {
        modal.style.display = 'block';
    }

    function closeModal(modal) {
        modal.style.display = 'none';
    }

    // Event Listeners for Modal Open/Close
    openAddTaskBtn.addEventListener('click', () => openModal(addTaskModal));
    closeAddTaskBtn.addEventListener('click', () => closeModal(addTaskModal));
    closeEditTaskBtn.addEventListener('click', () => closeModal(editTaskModal));

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === addTaskModal) closeModal(addTaskModal);
        if (event.target === editTaskModal) closeModal(editTaskModal);
    });

    // Helper function to convert priority to symbols
    function getPrioritySymbol(priority) {
        switch(priority) {
            case 'high': return '!!! (High)';
            case 'medium': return '!! (Medium)';
            case 'low': return '! (Low)';
            default: return '';
        }
    }

    // Edit Task Functionality
    function setupRowActions(row) {
        const editBtn = row.querySelector('.edit-btn');
        const deleteBtn = row.querySelector('.delete-btn');
        const markDoneBtn = row.querySelector('.mark-done-btn');

        // Edit Button
        editBtn.addEventListener('click', function() {
            const cells = row.getElementsByTagName('td');
            const taskId = row.getAttribute('id');
            const priority = {
                '!!! (High)': 'high',
                '!! (Medium)': 'medium',
                '! (Low)': 'low'
            };
            
            document.getElementById('editTaskId').value = taskId;
            document.getElementById('editTaskTitle').value = cells[0].textContent;
            document.getElementById('editTaskDueDate').value = cells[1].textContent;
            document.getElementById('editTaskPriority').value = priority[cells[2].textContent.trim()];
            document.getElementById('editTaskStatus').value = cells[3].textContent.toLowerCase();
            
            openModal(editTaskModal);
        });

        // Delete Button
        deleteBtn.addEventListener('click', function() {
            taskList.removeChild(row);
        });

        // Mark Done Button
        markDoneBtn.addEventListener('click', function() {
            const statusCell = row.querySelector('td:nth-child(4)');
            statusCell.textContent = 'Completed';
        });
    }

    // Initial setup for existing rows
    taskList.querySelectorAll('tr').forEach(setupRowActions);

    // Filtering Functionality
    applyFiltersBtn.addEventListener('click', function() {
        const statusFilter = document.getElementById('filterStatus').value;
        const priorityFilter = document.getElementById('filterPriority').value;
        const dueDateFilter = document.getElementById('filterDueDate').value;

        const rows = taskList.getElementsByTagName('tr');

        for (let row of rows) {
            const statusCell = row.cells[3];
            const priorityCell = row.cells[2];
            const dueDateCell = row.cells[1];

            const showRow = 
                (statusFilter === 'all' || statusCell.textContent.toLowerCase() === statusFilter) &&
                (priorityFilter === 'all' || 
                    priorityCell.textContent.toLowerCase().includes(priorityFilter)) &&
                (dueDateFilter === '' || dueDateCell.textContent === dueDateFilter);

            row.style.display = showRow ? '' : 'none';
        }
    });

    // Sorting Functionality
    sortTasksBtn.addEventListener('click', function() {
        const sortBy = document.getElementById('sortBy').value;
        const rowsArray = Array.from(taskList.getElementsByTagName('tr'));

        rowsArray.sort((a, b) => {
            switch(sortBy) {
                case 'newest':
                    return new Date(b.cells[1].textContent) - new Date(a.cells[1].textContent);
                case 'oldest':
                    return new Date(a.cells[1].textContent) - new Date(b.cells[1].textContent);
                case 'urgent':
                    const priorityOrder = {'!!! (High)': 1, '!! (Medium)': 2, '! (Low)': 3};
                    return priorityOrder[a.cells[2].textContent] - priorityOrder[b.cells[2].textContent];
            }
        });

        // Clear and re-add sorted rows
        taskList.innerHTML = '';
        rowsArray.forEach(row => taskList.appendChild(row));
    });
});