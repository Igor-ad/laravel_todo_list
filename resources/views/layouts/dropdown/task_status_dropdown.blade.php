@php use App\Enums\TaskStatusEnum; @endphp

<select name="status" class="form-select mb-2" aria-label="Status">
    <option selected>{{ $viewData['task']->status }}</option>
@if($viewData['task']->status == TaskStatusEnum::TODO->value)
    <option value="{{ TaskStatusEnum::DONE->value }}">{{ TaskStatusEnum::DONE->value }}</option>
@else
    <option value="{{ TaskStatusEnum::TODO->value }}">{{ TaskStatusEnum::TODO->value }}</option>
@endif
</select>
