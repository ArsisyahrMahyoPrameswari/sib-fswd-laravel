@extends('layouts.main')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <div class="title mb-30">
                            <h1 class="text-4xl text-gray-900">Slider</h1>
                        </div>
                    </div>
                </div>
                
            </div>
            <hr class="mt-2">
            @if (Auth::user()->role->name == 'Admin')
            <a class="btn btn-primary mt-4" href="{{ route('slider.create') }}" role="button">Create New</a>
            @endif
            <div class="card mt-2">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Caption</th>
                                <th>Image</th>
                                @if (Auth::user()->role->name == 'Admin')
                                    <th>Status</th>
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->caption }}</td>
                                    
                                    <td>
                                        <img src="{{ asset('storage/slider/' . $slider->image) }}" class="img-fluid" style="max-width: 100px;"
                                            alt="{{ $slider->image }}">
                                    </td>
                                    @if (Auth::user()->role->name == 'Admin')
                                    
                                    <td id="status-{{ $slider->id }}">
                                        @if ($slider->status == 'approve')
                                            <span class="badge bg-success">Approve</span>
                                        @elseif ($slider->status == 'reject')
                                            <span class="badge bg-danger">Reject</span>
                                        @else
                                            <form id="status-form-{{ $slider->id }}" action="{{ route('slider.updateStatus', $slider->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="approve">
                                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#confirmApproveModal{{ $slider->id }}"><i class="fas fa-check"></i></button>
                                            </form>

                                            <form id="status-form-{{ $slider->id }}" action="{{ route('slider.updateStatus', $slider->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="reject">
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmRejectModal{{ $slider->id }}"><i class="fas fa-times"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        <form onsubmit="return confirm('Are you sure?');" action="{{ route('slider.destroy', $slider->id) }}" method="POST">
                                            <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>

                                    @endif
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal -->
        @foreach ($sliders as $slider)
            <div class="modal fade" id="confirmApproveModal{{ $slider->id }}" tabindex="-1" aria-labelledby="confirmApproveModalLabel{{ $slider->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmApproveModalLabel{{ $slider->id }}">Approve slider</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to approve this slider?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success" onclick="updateStatus({{ $slider->id }}, 'approve')">Approve</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="confirmRejectModal{{ $slider->id }}" tabindex="-1" aria-labelledby="confirmRejectModalLabel{{ $slider->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmRejectModalLabel{{ $slider->id }}">Reject slider</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to reject this slider?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" onclick="updateStatus({{ $slider->id }}, 'reject')">Reject</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </main>
    <script>
    function updateStatus(sliderId, status) {
        const formElement = document.getElementById(`status-form-${sliderId}`);
        formElement.querySelector('input[name="status"]').value = status;
        formElement.submit();
    }
    console.log();
    </script>
@endsection