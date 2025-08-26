<div class="table-responsive table-container">
    <table id="CategoryTable" class="w-100 table table-striped table-bordered table-hover text-center align-middle">
        <thead class="thead-dark">
            <tr>
                <th>Details</th>
                <th>Approaved by</th>
                <th>Approaved in</th>
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

                    {{-- Approaved by --}}
                    <td>{{ $item->user->name }}</td>

                    {{-- Date --}}
                    <td>{{ $item->updated_at }}</td>

                    {{-- actions --}}
                    <td>
                        @if (auth()->user()->isOwner())
                            <div class="btn-group" role="group">
                                <!-- Reject button -->
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="ReasonForm('{{ $item->id }}', '{!! json_encode($item->name) !!}')">
                                    Reject
                                </button>
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

{{-- Reject Feedback dialog --}}
<dialog id="reject-dialog">
    <div class="dialog-content">
        <div class="dialog-header">
            <h3 id="dialog-title">Reject Feedback</h3>
            <button type="button" class="close-btn" onclick="closeRejectDialog()">&times;</button>
        </div>
        <div class="dialog-body">
            <form id="reject-form" action="{{ route('RejectFeedback') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="cause-select" class="form-label">Rejection Reason</label>
                    <select name="cause" id="cause-select" class="form-select" required>
                        <option value="">Select a reason...</option>
                        @foreach ($reasons as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->cause }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- Hidden fields to pass item data --}}
                <input type="hidden" name="feedback_id" id="item-id" value="">

                <div class="dialog-footer mt-3">
                    <button type="submit" class="btn btn-primary">Reject</button>
                    <button type="button" class="btn btn-secondary" onclick="closeRejectDialog()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</dialog>
