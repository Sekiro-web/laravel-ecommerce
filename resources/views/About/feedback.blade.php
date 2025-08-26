<x-dash_layout>
    @push('custom-css')
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="{{ asset('panel_assets/css/dialog.css') }}">
        <link rel="stylesheet" href="{{ asset('panel_assets/css/feedback-table.css') }}">
    @endpush

    <x-slot:title>Feedback</x-slot:title>


    @if (Route::is('ReviewFeedback') && request('status') == null)
        <x-Feedback-tables.all :feedbacks="$Feedback" :reasons="$Reasons" :approavedstat="$ApproavedStat" />
    @elseif(Route::is('ReviewFeedback') && request('status') == 'Approaved')
        <x-Feedback-tables.approaved :feedbacks="$Feedback" :reasons="$Reasons" />
    @elseif(Route::is('ReviewFeedback') && request('status') == 'Rejected')
        <x-Feedback-tables.rejected :feedbacks="$Feedback" :approavedstat="$ApproavedStat" />
    @endif

    <!-- Modal for displaying full message -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Message From :
                        <span id="Name"></span>
                        <br>
                        <br>
                        Email : <span id="Email"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-4">Title : <span id="Subject"></span></h6>
                    <p id="fullMessageContent"
                        style="word-wrap: break-word; word-break: break-word; white-space: pre-wrap; overflow-wrap: break-word;">
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @push('custom-js')
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('panel_assets/js/custom/feedback.js') }}"></script>
        @if (Route::is('ReviewFeedback') && request('status') == 'Rejected')
            <script>
                // Delete dialog
                const dialog = document.querySelector('#delete-dialog');
                const dialogAction = document.querySelector('#delete-link');
                const deleteRouteTemplate = "{{ route('DeleteFeedback', ':id') }}";

                function showDeleteDialog(itemId) {
                    dialogAction.href = deleteRouteTemplate.replace(':id', itemId);
                    dialog.showModal();
                }

                function closeDialog() {
                    dialog.close();
                }
            </script>
        @endif
    @endpush
</x-dash_layout>
