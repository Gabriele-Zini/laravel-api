<form action="{{ route('admin.projects.destroy', ['project' => $project->slug]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger delete-btn" data-title="{{ $project->name }}" data-bs-toggle="modal"
        data-bs-target="#delete-modal"><i class="fa-solid fa-trash-can" data-bs-toggle="tooltip" data-bs-placement="top"
        title="delete"></i></button>
</form>
