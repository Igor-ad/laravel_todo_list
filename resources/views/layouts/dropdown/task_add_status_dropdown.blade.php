@php use App\Enums\TaskStatusEnum; @endphp

<select name="status" class="form-select mb-2" aria-label="Status">
    <option selected>{{ __('task.help.status_select') }}</option>
    <option value="{{ TaskStatusEnum::TODO->value }}">{{ TaskStatusEnum::TODO->value }}</option>
    <option value="{{ TaskStatusEnum::DONE->value }}">{{ TaskStatusEnum::DONE->value }}</option>
</select>
