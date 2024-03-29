<form class="d-flex" method="post" action="{{ route('web.update', [$viewData['task']->id]) }}">
    @csrf
    <div class="row">
        <div class="row">
            <div class="col-sm-3 ">
                <input name="id" id="task-id"
                       class="form-control mb-2" type="text"
                       placeholder="{{ __('task.prop.id') }}"
                       aria-label="{{ __('task.prop.id') }}"
                       value="{{ $viewData['task']->id }}">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <input name="parent_id" id="task-parent_id"
                       class="form-control mb-2" type="text"
                       placeholder="{{ __('task.prop.parent_id') }}"
                       aria-label="{{ __('task.prop.parent_id') }}"
                       value="{{ $viewData['task']->parent_id }}">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <input name="title" id="task-title"
                       class="form-control mb-2" type="text"
                       placeholder="{{ __('task.prop.title') }}"
                       aria-label="{{ __('task.prop.title') }}"
                       value="{{ $viewData['task']->title }}">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <textarea name="description" id="task-description"
                          spellcheck="true"
                          class="form-control mb-2" rows="3" type="text"
                          placeholder="{{ __('task.prop.description') }}"
                          aria-label="{{ __('task.prop.description') }}">
{{ $viewData['task']->description }}
                </textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <input name="priority" id="task-priority"
                       class="form-control mb-2" type="text"
                       placeholder="{{ __('task.prop.priority') }}"
                       aria-label="{{ __('task.prop.priority') }}"
                       value="{{ $viewData['task']->priority }}">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.dropdown.task_status_dropdown')
            </div>
        </div>
        @include('layouts.buttons.save_task_button')
    </div>
</form>
