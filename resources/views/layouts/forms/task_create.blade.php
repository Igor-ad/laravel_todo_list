<form class="d-flex" method="post" action="{{ route('web.create') }}">
    @csrf
    <div class="row">
        <div class="row">
            <div class="col-sm-3">
                <input name="parent_id" id="task-parent_id"
                       class="form-control mb-2" type="text"
                       placeholder="{{ __('task.prop.parent_id') }}"
                       aria-label="{{ __('task.prop.parent_id') }}">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <input name="title" id="task-title"
                       class="form-control mb-2" type="text"
                       placeholder="{{ __('task.prop.title') }}"
                       aria-label="{{ __('task.prop.title') }}">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <textarea name="description" id="task-description"
                          spellcheck="true"
                          class="form-control mb-2" rows="3" type="text"
                          placeholder="{{ __('task.prop.description') }}"
                          aria-label="{{ __('task.prop.description') }}"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.dropdown.task_priority_dropdown')
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.dropdown.task_add_status_dropdown')
            </div>
        </div>
        @include('layouts.buttons.save_task_button')
    </div>
</form>
@include('layouts.messages.error_show')
