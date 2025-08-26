    <div class="table-responsive table-container">
        <table id="CategoryTable" class="w-100 table table-striped table-bordered table-hover align-middle">
            <thead class="thead-dark">
                <tr>
                    <th>Details</th>
                    <th>Rejected by</th>
                    <th>Rejected in</th>
                    <th>Reason</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($feedbacks as $item)
                    <tr>
                        {{-- Details --}}
                        <td class="message-cell">
                            <div class="message-preview" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="{{ $item->message }}" data-message="{{ $item->message }}"
                                onclick="showMessageModal({{ $item->id }}, '{{ addslashes($item->name) }}', '{{ addslashes($item->email) }}', '{{ addslashes($item->subject) }}', '{{ addslashes($item->message) }}')">
                                <span class="tooltip-text">Tab to show</span>
                            </div>
                        </td>

                        {{-- Rejected by --}}
                        <td>{{ $item->user->name }}</td>

                        {{-- Date --}}
                        <td>{{ $item->updated_at }}</td>

                        {{-- Reason --}}
                        <td class="reason-cell">{{ $item->FeedbackCause->cause }}</td>

                        {{-- actions --}}
                        <td class="action-cell">
                            @if (auth()->user()->isOwner())
                                <div class="btn-group" role="group">
                                    <!-- Approve button -->
                                    <button type="button" class="btn btn-success btn-sm"
                                        onclick="submitForm('{{ route('ApproveFeedback', $item->id) }}')">
                                        Approve
                                    </button>
                                    <!-- Delete button -->
                                    <button class="btn btn-sm btn-danger"
                                        onclick="showDeleteDialog({{ $item->id }})">Delete</button>
                                </div>
                            @else
                                No actions allowed
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <form id="actionForm" method="POST" style="display:none;">
        @csrf
    </form>


    {{-- Delete dialog --}}
    <dialog id="delete-dialog">
        <div class="dialog-content">
            <div class="dialog-header">
                <h3 id="dialog-title">Delete Confirmation</h3>
                <button class="close-btn" onclick="closeDialog()">&times;</button>
            </div>
            <div class="dialog-body">
                <p>Are you sure you want to delete this item? This action cannot be undone.</p>
            </div>
            <div class="dialog-footer">
                <button class="btn-cancel" onclick="closeDialog()">Cancel</button>
                <a href="" id="delete-link" class="btn-delete">Delete</a>
            </div>
        </div>
    </dialog>
    {{-- End Delete dialog --}}
