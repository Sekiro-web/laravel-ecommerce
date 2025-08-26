document.addEventListener('DOMContentLoaded', function () {
    // Initialize DataTable
    $('#CategoryTable').DataTable({
        "pageLength": 10,
        "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
        "order": [
            [0, "asc"]
        ],
        "columnDefs": [{
            "targets": [-1], // Action column
            "orderable": false,
            "searchable": false
        },
        {
            "targets": [0], // Message column
            "orderable": false,
            "width": "250px"
        }
        ],
        "responsive": true,
        "language": {
            "search": "Search feedbacks:",
            "lengthMenu": "Show _MENU_ feedbacks per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ feedbacks",
            "infoEmpty": "No feedbacks available",
            "infoFiltered": "(filtered from _MAX_ total feedbacks)",
            "zeroRecords": "No matching feedbacks found"
        }
    });

    // Initialize all tooltips if any exist
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
});


// Function to show message in modal
function showMessageModal(id, name, Email, Subject, message) {
    document.getElementById('Name').textContent = name;
    document.getElementById('Email').textContent = Email;
    document.getElementById('Subject').textContent = Subject;
    document.getElementById('fullMessageContent').textContent = message;

    // Show the modal using Bootstrap
    const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
    messageModal.show();
}

function submitForm(actionUrl) {
    const form = document.getElementById('actionForm');
    form.action = actionUrl;
    form.submit();
}

// Reason Form Dialog Management
let RejectDialog = null;

// Initialize dialog elements when DOM is loaded
document.addEventListener('DOMContentLoaded', function () {
    RejectDialog = document.querySelector('#reject-dialog');

    // Only add event listeners if dialog exists
    if (RejectDialog) {
        // Close dialog when clicking outside of it
        RejectDialog.addEventListener('click', function (e) {
            if (e.target === RejectDialog) {
                closeRejectDialog();
            }
        });

        // Handle form submission
        const rejectForm = document.getElementById('reject-form');
        if (rejectForm) {
            rejectForm.addEventListener('submit', function (e) {
                const causeSelect = document.getElementById('cause-select');
                if (!causeSelect || !causeSelect.value) {
                    e.preventDefault();
                    alert('Please select a rejection reason.');
                    return false;
                }
            });
        }
    }
});

function ReasonForm(itemId, itemName) {
    // Check if dialog exists
    if (!RejectDialog) {
        console.error('Reject dialog not found');
        return;
    }

    // Set the item data in hidden fields and display
    const itemIdField = document.getElementById('item-id');


    if (itemIdField) itemIdField.value = itemId;


    // Show the dialog
    RejectDialog.showModal();
}

function closeRejectDialog() {
    if (!RejectDialog) {
        return;
    }

    RejectDialog.close();

    // Reset the form when closing
    const rejectForm = document.getElementById('reject-form');
    if (rejectForm) {
        rejectForm.reset();
    }
}